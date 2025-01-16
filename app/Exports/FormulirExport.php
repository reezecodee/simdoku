<?php

namespace App\Exports;

use App\Models\Formulir;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class FormulirExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function collection()
    {
        return Formulir::all();
    }
}
