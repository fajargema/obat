<?php

namespace App\Imports;

use App\Models\Medicine;
use Maatwebsite\Excel\Concerns\ToModel;

class MedicineImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Medicine([
            'kode' => $row[0],
            'nama' => $row[1],
            'satuan' => $row[2],
            'harga' => $row[3],
            'tgl_masuk' => $row[4],
            'tgl_edit' => $row[5],
            'stok' => $row[6],
            'produsen' => $row[7],
            'distributor' => $row[8],
            'categories_id' => $row[9],
            'users_id' => $row[10]
        ]);
    }
}
