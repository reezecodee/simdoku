<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DataController extends Controller
{
    public function getDummyData()
    {
        $data = collect([
            ['id' => 1, 'name' => 'John Doe', 'email' => 'john.doe@example.com', 'created_at' => '2025-01-01'],
            ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane.smith@example.com', 'created_at' => '2025-01-02'],
            ['id' => 3, 'name' => 'Alice Brown', 'email' => 'alice.brown@example.com', 'created_at' => '2025-01-03'],
            ['id' => 4, 'name' => 'Bob Johnson', 'email' => 'bob.johnson@example.com', 'created_at' => '2025-01-04'],
        ]);

        return DataTables::of($data)
            ->addIndexColumn() // Tambahkan nomor urut otomatis
            ->addColumn('action', function ($row) {
                return '<button class="btn btn-primary btn-sm">Detail</button>';
            }) // Tambahkan kolom aksi
            ->rawColumns(['action']) // Beri tahu DataTables bahwa kolom 'action' berisi HTML
            ->make(true); // Generate response JSON
    }
}
