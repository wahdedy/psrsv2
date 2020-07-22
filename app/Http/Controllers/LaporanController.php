<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Mesinro;
use Carbon\Carbon;
use Session;
use Auth;
use DB;
use App\Exports\LaporanExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Redirect;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
	{
		$mesinro = Mesinro::all();
        return view('mesinro',['mesinro'=>$mesinro]);
        
        if(request()->ajax())
        {
         if(!empty($request->tanggal_awal))
         {
          $data = DB::table('mesinro')
            ->whereBetween('tanggal', array($request->tanggal_awal, $request->tanggal_akhir))
            ->get();
         }
         else
         {
          $data = DB::table('mesinro')
            ->get();
         }
         return datatables()->of($data)->make(true);
        }
        return view('laporan.mesinro');
	}
 
	public function export_excel()
	{
		return Excel::download(new LaporanExport, 'laporan.xlsx');
	}
    
    public function mesinro(Request $request)
    {
        
        $mesinro = Mesinro::orderBy('tanggal', 'DESC');
        //$mesinro = DB::table('mesinro')->get();
        if($request->query("tanggal")){
            $mesinro=$mesinro->where("tanggal",$request->query("tanggal"));
        }
        $mesinro=$mesinro->paginate(10);
        $parent = Mesinro::orderBy('id', 'ASC')->get();
        return view('laporan.mesinro', compact('mesinro'));

    }

    public function mesinroExcel(Request $request)
    {
        $nama = 'laporan_mesinro_'.date('Y-m-d_H-i-s');
        Excel::create($nama, function ($excel) use ($request) {
        $excel->sheet('Laporan Maintenance Mesin Ro', function ($sheet) use ($request) {
        
        $sheet->mergeCells('A1:H1');

        $sheet->setAllBorders('thin');
        $sheet->row(1, function ($row) {
            $row->setFontFamily('Roboto');
            $row->setFontSize(11);
            $row->setAlignment('center');
            $row->setFontWeight('bold');
        });

        $sheet->row(1, array('LAPORAN DATA MESIN RO'));

        $sheet->row(2, function ($row) {
            $row->setFontFamily('Roboto');
            $row->setFontSize(11);
            $row->setFontWeight('bold');
        });

       // $sheet->appendRow(array_keys($mesinro[0]));
        $sheet->row($sheet->getHighestRow(), function ($row) {
            $row->setFontWeight('bold');
        });

         $datasheet = array();
         $datasheet[0]  =   array("NO", "TANGGAL", "TANDON", "PH",  "FEED","CATRIDGE","MEMBRAN", "PERMATE", "REJECT", "CATRIDGE_STATUS", "CATATAN", "USER");
         $i=1;

        foreach ($mesinro as $data) {

           // $sheet->appendrow($data);
          $datasheet[$i] = array($i,
                        date('d/m/y', strtotime($data['tanggal'])),
                        $data['tandon'],
                        $data['ph'],
                        $data['feed'],
                        $data['catridge'],
                        $data['membran'],
                        $data['permate'],
                        $data['reject'],
                        $data['catridge_status'],
                        $data['catatan'],
                        $data['user']
                    );
          
          $i++;
        }

        $sheet->fromArray($datasheet);
    });

    })->export('xls');
    }
}
