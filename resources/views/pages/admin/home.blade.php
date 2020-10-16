@extends('layout.default')
@section('css')
@endsection
@section('baslik')
Admin Anasayfa
@endsection
@section('content')


<div class="row">
    <super-datatable tur="KULLANICI" key="KULLANICI" :gizle="['email']"></super-datatable>
</div>

@endsection

@section('js')

@endsection
@section('styles')

@endsection
