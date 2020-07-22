<?php

namespace App\Exports;

use App\Mesinro;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class LaporanExport implements FromCollection, WithHeadings, ShouldAutoSize,WithHeadingRow
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Mesinro::all();
    }

    public function actions(Request $request)
    {
        return [
            (new ExportToExcel)
                ->onSuccess(function() {
                    return Action::message('Export Data Telah Berhasil :)');
                })->onFailure(function() {
                     return Action::danger('Export Data Tidak Berhasil... Mohon Cek Data Kembali');
                }),
        ];

        return [
            (new DownloadExcel)->withFilename('users-' . time() . '.xlsx'),
        ];

        return [
            (new DownloadExcel)->withWriterType(\Maatwebsite\Excel\Excel::CSV),
        ];

    }
    public function headings(): array
    {
                return [
                'ID',
                'Tanggal',
                'Tandon', 
                'PH' , 
                'Feed Pressure' , 
                'Catridge Pressure', 
                'Membran Pressure', 
                'Permate LPM', 
                'Reject LPM ', 
                'Catridge Status', 
                'Catatan', 
                'Username', 
                ];
     
    }
}


