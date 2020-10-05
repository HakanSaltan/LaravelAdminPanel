@extends('layouts.app')
@section('baslik')
Roller
@endsection
@section('subheader')
<h2 class="text-white font-weight-bold my-2 mr-5">Roller</h2>
@endsection
@section('subheaderalt')
<a href="#" class="opacity-75 hover-opacity-100">
    <i class="flaticon2-shelter text-white icon-1x"></i>
</a>
<span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
<a href="" class="text-white text-hover-white opacity-75 hover-opacity-100">Roller</a>
<span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
<a href="" class="text-white text-hover-white opacity-75 hover-opacity-100">Rolleri Görüntüle</a>
@endsection
@section('content')

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>İsim:</strong>
            {{ $role->name }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Permissions:</strong>
            @if(!empty($rolePermissions))
                @foreach($rolePermissions as $v)
                    <label class="label label-success">{{ $v->name }},</label>
                @endforeach
            @endif
        </div>
    </div>
</div>

@endsection
