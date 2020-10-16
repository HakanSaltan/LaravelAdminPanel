@extends('layout.default')
@section('baslik')
Profil
@endsection
@section("content")
<div class="flex-row-fluid ml-lg-8">
    <!--begin::Card-->
    <div class="card card-custom">
        <!--begin::Header-->
        <div class="card-header py-3">
            <div class="card-title align-items-start flex-column">
                <h3 class="card-label font-weight-bolder text-dark">Hesap Bilgileri</h3>
                <span class="text-muted font-weight-bold font-size-sm mt-1">Hesap ayarlarınızı değiştirin</span>
            </div>
            <div class="card-toolbar">
                <button v-on:click="kullaniciUp" type="submit" class="btn btn-success mr-2">Ayarları Uygula</button>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Form-->
            <div class="card-body">
                <!--begin::Heading-->
                <!--begin::Form Group-->
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">Kullanıcı Adı</label>
                    <div class="col-lg-9 col-xl-6">
                        <input class="form-control form-control-lg form-control-solid" type="text" v-model='kullaniciAdi'>

                       <!-- <div class="spinner spinner-sm spinner-success spinner-right">

                        </div>-->
                    </div>
                </div>
                <!--begin::Form Group-->
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">Mail Adres</label>
                    <div class="col-lg-9 col-xl-6">
                        <div class="input-group input-group-lg input-group-solid">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="la la-at"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control form-control-lg form-control-solid" v-model='kullaniciMail' placeholder="Email">
                        </div>
                    </div>
                </div>
                <!--begin::Form Group-->
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">Şifre</label>
                    <div class="col-lg-9 col-xl-6">
                        <input type="text" class="form-control form-control-lg form-control-solid" v-model='kullaniciSifre' placeholder="Şifre">
                    </div>
                </div>
            </div>

        <!--end::Form-->
    </div>
    <!--end::Card-->
</div>
@endsection

@section('js')
<script>
    let vm = new Vue({
        el: '#app',
        data: {
            kullaniciId:'{{$profil->id}}',
            kullaniciAdi:'{{$profil->name}}',
            kullaniciMail:'{{$profil->email}}',
            kullaniciSifre:'',
            postUrl: "#"
        },
        methods: {
            kullaniciUp(){
                let formData = new FormData();
                    formData.append('id',vm.kullaniciId);
                    formData.append('adi',vm.kullaniciAdi);
                    formData.append('email',vm.kullaniciMail);
                    formData.append('sifre',vm.kullaniciSifre);
                    formData.append('tip','guncelle');

                    axios.post(this.postUrl,formData)
                    .then(function (data) {
                        toastr.success ("İşlem Başarılı", "Mesaj");

                    }).catch(function (err) {
                        toastr.error("İşlem Başarısız", "Hata");
                        console.log(err);
                    });
                 }
        },

    });

</script>

@endsection
@section('styles')

@endsection
