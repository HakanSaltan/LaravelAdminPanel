@extends('layout.default')
@section('css')
@endsection
@section('baslik')
Admin Anasayfa
@endsection
@section('content')
<<<<<<< HEAD


<div class="row">
    <super-datatable tur="KULLANICI" key="KULLANICI" :gizle="['email']"></super-datatable>
</div>

=======
    <super-datatable tur="KULLANICI" key="KULLANICI"></super-datatable>
>>>>>>> 45bb170dcac3c1a43db6221272b00db5d6255d2e
@endsection

@section('js')

@endsection
@section('styles')

@endsection
