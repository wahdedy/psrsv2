@section('js')

<script type="text/javascript">

$(document).ready(function() {
    $("admin.users")select1().select2();
});

</script>
@stop
@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('mesinro.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
<div class="row">
            <div class="col-md-12 d-flex align-items-stretch grid-margin">
              <div class="row flex-grow">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Tambah Data baru</h4>

                        <div class="form-group{{ $errors->has('tandon') ? ' has-error' : '' }}">
                            <label for="tandon" class="col-md-4 control-label">Tandon</label>
                            <div class="col-md-3">
                                <select class="form-control" name="tandon" required="">
                                    <option value=""></option>
                                    <option value="Full">Full</option>
                                    <option value="Kosong">Kosong</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('ph') ? ' has-error' : '' }}">
                            <label for="ph" class="col-md-4 control-label">Ph</label>
                            <div class="col-md-3">
                                <input id="ph" type="number" step="0.01" class="form-control" name="ph" value="{{ old('ph') }}" required>
                                @if ($errors->has('ph'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ph') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('feed') ? ' has-error' : '' }}">
                            <label for="feed" class="col-md-4 control-label">Feed Presure</label>
                            <div class="col-md-3">
                                <input id="feed" type="number" class="form-control" name="feed" value="{{ old('feed') }}" required>
                                @if ($errors->has('feed'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('feed') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('catridge') ? ' has-error' : '' }}">
                            <label for="feed" class="col-md-4 control-label">Catridge Presure</label>
                            <div class="col-md-3">
                                <input id="catridge" type="number" class="form-control" name="catridge" value="{{ old('catridge') }}" required>
                                @if ($errors->has('catridge'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('catridge') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('membran') ? ' has-error' : '' }}">
                            <label for="feed" class="col-md-4 control-label">Membran Presure</label>
                            <div class="col-md-3">
                                <input id="membran" type="number" class="form-control" name="membran" value="{{ old('membran') }}" required>
                                @if ($errors->has('membran'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('membran') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('permate') ? ' has-error' : '' }}">
                            <label for="feed" class="col-md-4 control-label">Permate LPM</label>
                            <div class="col-md-3">
                                <input id="permate" type="number" class="form-control" name="permate" value="{{ old('permate') }}" required>
                                @if ($errors->has('permate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('permate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('reject') ? ' has-error' : '' }}">
                            <label for="reject" class="col-md-4 control-label">Reject LPM</label>
                            <div class="col-md-3">
                                <input id="reject" type="number" class="form-control" name="reject" value="{{ old('reject') }}" required>
                                @if ($errors->has('reject'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('reject') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('catridge_status') ? ' has-error' : '' }}">
                            <label for="catridge_status" class="col-md-4 control-label">Catridge Status</label>
                            <div class="col-md-4">
                                <select class="form-control" name="catridge_status" required="">
                                    <option value=""></option>
                                    <option value="Baik">Baik</option>
                                    <option value="Replace">Replace</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('catatan') ? ' has-error' : '' }}">
                            <label for="catatan" class="col-md-4 control-label">Catatan</label>
                            <div class="col-md-4">
                            <textarea name="catatan" class="form-control" placeholder="Catatan...."></textarea>
                                @if ($errors->has('catatan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('catatan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary float-right">Simpan</button>
                        </div>
 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection                  