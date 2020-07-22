@section('js')
<script type="text/javascript">
  $(document).ready(function() {
    $('#table').DataTable({
      "iDisplayLength": 50
    });

} );
</script>
<script>
$('.datepicker').datepicker({
  inline: true;
});

 load_data();

 function load_data(tanggal_awal = '', tanggal_akhir = '')
 {
  $('#mesinro_table').DataTable({
   processing: true,
   serverSide: true,
   ajax: {
    url:'{{ route("laporan.mesinro") }}',
    data:{tanggal_awal:tanggal_awal, tanggal_akhir:tanggal_akhir}
   },
   columns: [
    {
     data:'tanggal',
     name:'tanggal'
    },
    {
     data:'tandon',
     name:'tandon'
    },
    {
     data:'ph',
     name:'ph'
    },
    {
     data:'feed',
     name:'feed'
    },
    {
     data:'catridge',
     name:'catridge'
    },
    {
     data:'membran',
     name:'membran'
    },
    {
     data:'permate',
     name:'permate'
    },
    {
     data:'reject',
     name:'reject'
    },
    {
     data:'catridge_status',
     name:'catridge_status'
    },
    {
     data:'catatan',
     name:'catatan'
    },
    {
     data:'username',
     name:'username'
    }
   ]
  });
 }

 $('#search').click(function(){
  var tanggal_awal = $('#tanggal_awal').val();
  var tanngal_akhir = $('#tanggal_akhir').val();
  if(tanggal_awal != '' &&  tanggal_akhir != '')
  {
   $('#mesinro_table').DataTable().destroy();
   load_data(from_date, to_date);
  }
  else
  {
   alert('Kedua Tanggal Awal Dan Akhir Harus Di Isi');
  }
 });

 $('#refresh').click(function(){
  $('#tanggal_awal').val('');
  $('#tanggal_akhir').val('');
  $('#mesinro_table').DataTable().destroy();
  load_data();
 });

});
</script>
@stop
@extends('layouts.app')

@section('content')
<div class="row">
<div class="col-md-2 pull-left">
     <a href="{{ url('/laporan/export_excel') }}" class="btn btn-success btn-rounded btn-fw">
     <b><i class="fa fa-download"></i> Export EXCEL</a></b>
</div>
                    <div class="row input-daterange">
                              <div class="col-md-4">
                                <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control" placeholder="Tanggal Awal">
                              </div>
                              <div class="col-md-4">
                                <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" placeholder="Tanggal Akhir">
                              </div>
                      <div class="col-md-4">
                        <button type="button" name="search" id="search" class="btn btn-primary">Search</button>
                      </div>
                    </div>
</div>
<div class="row" style="margin-top: 20px;">
<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title pull-left">Form Laporan Peralatan Dan Pemeriksaan Mesin RO RSIA PB Tabanan</h4>
                  <div class="table-responsive">
                    <table class="table table-striped" id="table">
                      <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Tandon</th>
                            <th>Ph</th>
                            <th>Feed Pressure</th>
                            <th>Catridge Pressure</th>
                            <th>Membran Pressure</th>
                            <th>Permate LPM</th>
                            <th>Reject LPM</th>
                            <th>Catridge Status</th>
                            <th>Catatan</th>
                            <th>User</th>
                            <th>Aksi</th>
                        </tr>
                        @foreach($mesinro as $data)
                        <tr>
                          <td>{{$data->tanggal}}</td>
                          <td>{{$data->tandon}}</td>
                          <td>{{$data->ph}}</td>
                          <td>{{$data->feed}}</td>
                          <td>{{$data->catridge}}</td>
                          <td>{{$data->membran}}</td>
                          <td>{{$data->permate}}</td>
                          <td>{{$data->reject}}</td>
                          <td>{{$data->catridge_status}}</td>
                          <td>{{$data->catatan}}</td>
                          <td>{{$data->username}}</td>
                        </tr>
                      @endforeach
                      </thead>
                    </table>
                  </div>
               {{--  {!! $mesinro->links() !!} --}}
                </div>
              </div>
            </div>
          </div>
@endsection
