<?php

namespace App\Exports;

use App\Models\Student;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentImport implements ToModel, WithHeadingRow
{
    protected $beasiswaId;

    public function __construct($beasiswaId)
    {
        $this->beasiswaId = $beasiswaId;
    }

    public function model(array $row)
    {
        $nomorInduk = explode('/', $row['nomor_induknisn']);
        if (is_numeric($row['tgl_ajuan_loa'])) {
            $tanggalAjuan = Carbon::parse(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tgl_ajuan_loa']))->format('Y-m-d');
        } else {
            $tanggalAjuan = Carbon::createFromFormat('d/m/Y', trim($row['tgl_ajuan_loa']))->format('Y-m-d');
        }

        return new Student([
            'beasiswa_id' => $this->beasiswaId,
            'asal_sekolah' => $row['nama_asal_sekolah'],
            'nis' => trim($nomorInduk[0]) ?? '',
            'nisn' => trim($nomorInduk[1]) ?? '',
            'nama_peserta_didik' => $row['nama_peserta_didik'],
            'kelas' => $row['kelas'],
            'jurusan' => $row['jurusan'],
            'rangking' => $row['rangking'],
            'besaran_beasiswa' => $row['besaran_beasiswa_diajukan'],
            'status_loa' => $row['status_loa'],
            'status_sk_rektor' => $row['status_sk_rektor'],
            'status_pembayaran' => $row['status_pembayaran'],
            'tgl_ajuan' => $tanggalAjuan
        ]);
    }
}
