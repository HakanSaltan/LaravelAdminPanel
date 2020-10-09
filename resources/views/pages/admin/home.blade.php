@extends('layout.default')
@section('css')
@endsection
@section('baslik')
Admin Anasayfa
@endsection
@section('content')


<div class="row">
    <super-datatable :tur="tur" :key="tur"></super-datatable>
</div>

@endsection

@section('js')

@endsection
@section('css')

@endsection
