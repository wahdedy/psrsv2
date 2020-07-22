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
    url:'{{ route("mesinro.index") }}',
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

  <div class="col-lg-2">
    <a href="{{ route('mesinro.create') }}" class="btn btn-primary btn-rounded btn-fw"><i class="fa fa-plus"></i> Tambah Data</a>
  </div>

<div class="col-xs-14 col-sm-6 col-md-6 col-lg-6">
          <form action="/mesinro/import_excel" method="post" class="form-inline" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="input-group {{ $errors->has('importMesinro') ? 'has-error' : '' }}">
              <input type="file" class="form-control" name="importMesinro" required="">

              <span class="input-group-btn">
                              <button type="submit"  action="/mesinro/import_excel" class="btn btn-success" style="height: 38px;margin-left: -2px;">Import</button>
                            </span>
            </div>
          </form>
        </div>
    <div class="col-lg-12">
                  @if (Session::has('message'))
                  <div class="alert alert-{{ Session::get('message_type') }}" id="waktu2" style="margin-top:10px;">{{ Session::get('message') }}</div>
                  @endif
                  </div>

                    <div class="row input-tanggal">
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
                  <a href="{{url('format_mesinro')}}" class="btn btn-xs btn-info pull-right">Format Mesin RO</a>
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
                      </thead>
                      <tbody>
                      <?php $no = 1; ?>
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
                          <td>
                            <?php
                            if(Auth::user()->level == 'admin') {
                            ?>
                            <a href="{{route('mesinro.edit', $data->id) }}"><button>Edit</button></a> 
                            <button data-toggle="modal" data-target="#exampleModal<?=$no?>">Delete</button>
                            <?php } ?>
                          </td>
                        </tr>
                        <!-- Modal -->
                      <div class="modal fade" id="exampleModal<?=$no?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">{{$data->tanggal}}</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                            Apakah Anda Yakin Menghapus Data Ini?
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <a href="{{route('mesinro.destroy', $data->id) }}"><button type="button" class="btn btn-primary">Delete</button></a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php $no++; ?>
                      @endforeach
                      </tbody>
                    </table>
                  </div>
               {{--  {!! $mesinro->links() !!} --}}
                </div>
              </div>
            </div>
          </div>
@endsection




