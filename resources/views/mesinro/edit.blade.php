@section('js')

<script type="text/javascript">

$(document).ready(function() {
    $(".admin").select1();
});

</script>

<script type="text/javascript">
        function readURL() {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(input).prev().attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(function () {
            $(".uploads").change(readURL)
            $("#f").submit(function(){
                // do ajax submit or just classic form submit
              //  alert("fake subminting")
                return false
            })
        })
        </script>
@stop

@extends('layouts.app')

@section('content')

<form action="/mesinro/update/{{ $mesinro->id }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('put') }}
<div class="row">
            <div class="col-md-12 d-flex align-items-stretch grid-margin">
                <div class="row flex-grow">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Edit Form MesinRo</h4>
                                <form class="forms-sample">
                            <div class="form-group{{ $errors->has('tandon') ? ' has-error' : '' }}">
                                <label for="tandon" class="col-md-4 control-label">Tandon</label>
                                <div class="col-md-4">
                                <select class="form-control" name="tandon" required="">
                                    <option value=""></option>
                                    <option value="Full"{{$mesinro->tandon === "Full" ? "selected" : ""}}>Full</option>
                                    <option value="Kosong"{{$mesinro->tandon === "Kosong" ? "selected" : ""}}>Kosong</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('ph') ? ' has-error' : '' }}">
                            <label for="ph" class="col-md-4 control-label">Ph</label>
                            <div class="col-md-4">
                                <input id="ph" type="number" step="0.01" class="form-control" name="ph" value="{{ $mesinro->ph }}" required>
                                @if ($errors->has('ph'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ph') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('feed') ? ' has-error' : '' }}">
                            <label for="feed" class="col-md-4 control-label">Feed Presure</label>
                            <div class="col-md-4">
                                <input id="feed" type="number" class="form-control" name="feed" value="{{ $mesinro->feed }}" required>
                                @if ($errors->has('feed'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('feed') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('catridge') ? ' has-error' : '' }}">
                            <label for="feed" class="col-md-4 control-label">Catridge Presure</label>
                            <div class="col-md-4">
                                <input id="catridge" type="number" class="form-control" name="catridge" value="{{ $mesinro->catridge }}" required>
                                @if ($errors->has('catridge'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('catridge') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('membran') ? ' has-error' : '' }}">
                            <label for="feed" class="col-md-4 control-label">Membran Presure</label>
                            <div class="col-md-4">
                                <input id="membran" type="number" class="form-control" name="membran" value="{{ $mesinro->membran }}" required>
                                @if ($errors->has('membran'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('membran') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('permate') ? ' has-error' : '' }}">
                            <label for="feed" class="col-md-4 control-label">Permate LPM</label>
                            <div class="col-md-4">
                                <input id="permate" type="number" class="form-control" name="permate" value="{{ $mesinro->permate }}" required>
                                @if ($errors->has('permate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('permate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('reject') ? ' has-error' : '' }}">
                            <label for="reject" class="col-md-4 control-label">Reject LPM</label>
                            <div class="col-md-4">
                                <input id="reject" type="number" class="form-control" name="reject" value="{{ $mesinro->reject }}" required>
                                @if ($errors->has('reject'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('reject') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('catridge_status') ? ' has-error' : '' }}">
                            <label for="catridge_status" class="col-md-4 control-label">Catridge Status</label>
                            <div class="col-md-6">
                                <select class="form-control" name="catridge_status" required="">
                                    <option value=""></option>
                                    <option value="Baik"{{$mesinro->catridge_status === "Baik" ? "selected" : ""}}>Baik</option>
                                    <option value="Replace"{{$mesinro->catridge_status === "Replace" ? "selected" : ""}}>Replace</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('catatan') ? ' has-error' : '' }}">
                            <label for="catatan" class="col-md-4 control-label">Catatan</label>
                            <div class="col-md-4">
                                <input id="catatan" type="text" class="form-control" name="catatan" value="{{ $mesinro->catatan }}" required>
                                @if ($errors->has('catatan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('catatan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                            <button type="submit" class="btn btn-primary" id="submit">
                                    Update
                            </button>
                            <a href="{{route('mesinro.index')}}" class="btn btn-light pull-right">Back</a>

                            </div> 
                        </div>
                    </div>               
                </div>
            </div>

</div>
</form>
@endsection