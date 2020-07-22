<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Auth;
use App\User;
use App\Mesinro;
use Session;
use Alert;
use App\Imports\MesinroImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class MesinroController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $mesinro = Mesinro::orderBy('tanggal', 'ASC');
        //$mesinro = DB::table('mesinro')->get();
        if($request->query("tanggal")){
            $mesinro=$mesinro->where("tanggal",$request->query("tanggal"));
        }
        $mesinro=$mesinro->paginate(10);
        $parent = Mesinro::orderBy('id', 'ASC')->get();
        return view('mesinro.index', compact('mesinro'));

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
        return view('mesinro.index');
    }

    public function create()
    {
        $mesinro = Mesinro::orderBy('id', 'DESC')->get();
        return view('mesinro.create', compact('mesinro'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'feed' => 'required',
            'catridge' => 'required',
            'membran' => 'required', 
            'permate' => 'required',
            'reject' => 'required']);

        Mesinro::create([
                'tanggal' => now(),
                'tandon' => $request->tandon,
                'ph' => $request->ph,
                'feed' => $request->feed,
                'catridge' => $request->catridge,
                'membran' => $request->membran,
                'permate' => $request->permate,
                'reject' => $request->reject,
                'catridge_status' => $request->catridge_status,
                'catatan' => $request->catatan,
                'username'  => Auth()->user()->username,

            ]);
            alert()->success('Berhasil.','Data telah ditambahkan!');

        return redirect()->route('mesinro.index');
    }

    public function edit($id)
    {
        $mesinro = Mesinro::findOrFail($id);
        return view('mesinro.edit', compact('mesinro'));
    }

    public function update(Request $request, $id)
    {
            
            $mesinro = Mesinro::find($id)->update([
                'tanggal' => now(),
                'tandon' => $request->get("tandon"),
                'ph' => $request->get("ph"),
                'feed' => $request->get("feed"),
                'catridge' => $request->get("catridge"),
                'membran' => $request->get("membran"),
                'permate' => $request->get("permate"),
                'reject' => $request->get("reject"),
                'catridge_status' => $request->get("catridge_status"),
                'catatan' => $request->get("catatan"),
                'username'  => Auth()->user()->username,
        ]);
                alert()->success('Berhasil.','Data telah diubah!');
            return redirect()->route('mesinro.index');
    }

    public function destroy($id)
    {
        Mesinro::find($id)->delete();
        alert()->success('Berhasil.','Data telah dihapus!');
        return redirect()->route('mesinro.index');
    }
    public function format()

    {
        $data = [['tanggal' => null, 'tandon' => 'Full/Kosong', 'ph' => null, 'feed' => null, 'catridge' => null, 'membran' => null, 'permate' => null, 'reject' => null, 'catridge_status' =>'Baik/Replace', 'catatan' => null, 'username' => null]];
            $fileName = 'format-mesinro';
            

        $export = Excel::create($fileName.date('Y-m-d_H-i-s'), function($excel) use($data){
            $excel->sheet('mesinro', function($sheet) use($data) {
                $sheet->fromArray($data);
            });
        });

        return $export->download('xlsx');
    }

    public function import_excel(Request $request) 
	{
		// validasi
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
 
		// menangkap file excel
		$file = $request->file('file');
 
		// membuat nama file unik
		$nama_file = rand().$file->getClientOriginalName();
 
		// upload ke folder file_mesinro di dalam folder public
		$file->move('file_mesinro',$nama_file);
 
		// import data
		Excel::import(new MesinroImport, public_path('/file_mesinro/'.$nama_file));
 
		// notifikasi dengan session
		Session::flash('sukses','Data Mesinro Berhasil Diimport!');
 
		// alihkan halaman kembali
		return redirect('mesinro.index');
    }
    
    
}
    
