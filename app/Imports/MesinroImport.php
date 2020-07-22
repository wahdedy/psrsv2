<?php

namespace App\Imports;

use App\Mesinro;
use Maatwebsite\Excel\Concerns\ToModel;

class MesinroImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Mesinro([
                'tanggal' => $row['tanggal'],
                'tandon' => $row['tandon'], 
                'ph' => $row['ph'], 
                'feed' => $row['feed'], 
                'catridge' => $row['catridge'], 
                'membran' => $row['membran'], 
                'permate' => $row['permate'], 
                'reject' => $row['reject'], 
                'catridge_status' => $row['catridge_status'], 
                'catatan' => $row['catatan'], 
                'username' => $row['username'], 

        ]);

    }

    public function import()
    {
        $headings = (new HeadingRowImport)->toArray('mesinro.xlsx');
    }
}
