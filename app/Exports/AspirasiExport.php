<?php

namespace App\Exports;

use App\Models\InputAspirasi;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths; // <-- Tambah library ini
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class AspirasiExport implements FromQuery, WithHeadings, WithMapping, WithDrawings, WithStyles, WithColumnWidths
{
    protected $tanggalMulai;
    protected $tanggalSelesai;
    protected $status;
    private $currentRow = 1;

    public function __construct($tanggalMulai = null, $tanggalSelesai = null, $status = null)
    {
        $this->tanggalMulai = $tanggalMulai;
        $this->tanggalSelesai = $tanggalSelesai;
        $this->status = $status;
    }

    public function query()
    {
        $query = InputAspirasi::with(['siswa', 'kategori', 'aspirasi']);

        if ($this->tanggalMulai && $this->tanggalSelesai) {
            $query->whereBetween('created_at', [
                $this->tanggalMulai . ' 00:00:00', 
                $this->tanggalSelesai . ' 23:59:59'
            ]);
        }

        if ($this->status && $this->status !== 'Semua Status') {
            $query->whereHas('aspirasi', function ($q) {
                $q->where('status', $this->status);
            });
        }

        return $query->latest();
    }

    public function headings(): array
    {
        return [
            'No',
            'Tanggal Pengaduan',
            'Nama Siswa',
            'NIS',
            'Kategori Barang',
            'Lokasi',
            'Deskripsi Kerusakan',
            'Foto Pengaduan',
            'Status'
        ];
    }

    public function map($row): array
    {
        static $no = 1;
        
        $statusLaporan = $row->aspirasi->status ?? 'menunggu';

        // Mengambil username dari tabel siswa
        $namaSiswa = $row->siswa->username ?? 'Siswa';

        // Mengambil ket_kategori dari tabel kategori
        $kategoriBarang = $row->kategori->ket_kategori ?? $row->id_kategori;

        return [
            $no++,
            $row->created_at->format('d/m/Y H:i'),
            $namaSiswa, 
            $row->nis,
            $kategoriBarang, 
            $row->lokasi, 
            $row->ket,
            '', // Kosong untuk gambar otomatis
            strtoupper($statusLaporan),
        ];
    }

    public function drawings()
    {
        $drawings = [];
        $row = 1;

        $data = $this->query()->get();

        foreach ($data as $item) {
            $row++;
            
            if ($item->foto && $item->foto !== 'default.png' && file_exists(public_path('uploads/aspirasi/' . $item->foto))) {
                $drawing = new Drawing();
                $drawing->setName('Foto Pengaduan');
                $drawing->setPath(public_path('uploads/aspirasi/' . $item->foto));
                $drawing->setHeight(65); // Tinggi gambar disesuaikan dikit (65px)
                $drawing->setOffsetX(10); // Kasih jarak pas di tengah kotak kolom H
                $drawing->setOffsetY(5);
                $drawing->setCoordinates('H' . $row);
                $drawings[] = $drawing;
            }
        }

        return $drawings;
    }

    // 1. ATUR LEBAR KOLOM BIAR GAK KEPOTONG (WithColumnWidths)
    public function columnWidths(): array
    {
        return [
            'A' => 6,   // No
            'B' => 22,  // Tanggal Pengaduan
            'C' => 20,  // Nama Siswa
            'D' => 15,  // NIS
            'E' => 20,  // Kategori Barang
            'F' => 20,  // Lokasi
            'G' => 45,  // Deskripsi Kerusakan (Lebih lebar karena teks panjang)
            'H' => 22,  // Foto Pengaduan (Dilebarin biar gambar pas masuk kotak)
            'I' => 15,  // Status
        ];
    }

    // 2. ATUR PENALISAN BIAR RAPI DAN TINGGI BARIS (WithStyles)
    public function styles(Worksheet $sheet)
    {
        // Tebalkan judul kolom (baris 1) dan ratakan tengah
        $sheet->getStyle('A1:I1')->getFont()->setBold(true);
        $sheet->getStyle('A1:I1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getRowDimension(1)->setRowHeight(30);

        // Menghitung total data query biar looping barisnya pas
        $totalRows = $this->query()->count() + 1;

        if ($totalRows > 1) {
            // Semua teks data otomatis vertikalnya di tengah (center)
            $sheet->getStyle('A2:I' . $totalRows)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
            $sheet->getStyle('G2:G' . $totalRows)->getAlignment()->setWrapText(true); // Deskripsi bungkus teks

            // Kolom tertentu rata tengah
            $sheet->getStyle('A2:A' . $totalRows)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('B2:B' . $totalRows)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('D2:D' . $totalRows)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('I2:I' . $totalRows)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

            // CRITICAL: Memaksa setiap baris data memiliki tinggi 80 biar muat foto
            for ($i = 2; $i <= $totalRows; $i++) {
                $sheet->getRowDimension($i)->setRowHeight(80);
            }
        }
    }
}