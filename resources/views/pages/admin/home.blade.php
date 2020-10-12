@extends('layout.default')
@section('css')
@endsection
@section('baslik')
Admin Anasayfa
@endsection
@section('content')


    <super-datatable tur="KULLANICI" key="KULLANICI"></super-datatable>
    <super-datatable-yeni tur="KULLANICI" key="KULLANICI"></super-datatable-yeni>
@endsection

@section('js')

@endsection
@section('css')

@endsection
