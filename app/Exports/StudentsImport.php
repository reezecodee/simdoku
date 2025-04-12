<?php

namespace App\Exports;

use App\Models\Student;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToModel, WithHeadingRow
{
    protected $beasiswaId;

    public function __construct($beasiswaId)
    {
        $this->beasiswaId = $beasiswaId;
    }

    public function model(array $row)
    {
        $tglAjuan = Carbon::createFromFormat('Y/m/d', trim($row['tgl_ajuan_loa']))->format('Y-m-d');

        $nomorInduk = explode('/', $row['nomor_induknisn']);

        return new Student([
            'beasiswa_id' => $this->beasiswaId,
            'asal_sekolah' => trim($row['nama_asal_sekolah']),
            'nis' => isset($nomorInduk[0]) ? trim($nomorInduk[0]) : null,
            'nisn' => isset($nomorInduk[1]) ? trim($nomorInduk[1]) : null,
            'nama_peserta_didik' => trim($row['nama_peserta_didik']),
            'kelas' => trim($row['kelas']),
            'jurusan' => trim($row['jurusan']),
            'rangking' => (int) $row['rangking'],
            'besaran_beasiswa' => (float) str_replace('%', '', trim($row['besaran_beasiswa_diajukan'])),
            'status_loa' => trim($row['status_loa']),
            'status_sk_rektor' => trim($row['status_sk_rektor']),
            'status_pembayaran' => trim($row['status_pembayaran']),
            'tgl_ajuan' => $tglAjuan,
        ]);
    }
}
