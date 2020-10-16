@extends('layout.app')
@section('baslik')
Kullanıcılar
@endsection
@section("content")
<div id="app">
    <div class="card card-custom card-stretch gutter-b">

        <div class="card-header border-0 pt-7">
            <div class="card-title align-items-start flex-column">
                <span class="card-label font-weight-bold font-size-h4 text-dark-75">Kullanicilar</span>
            </div>
            <div class="card-toolbar">
                <ul class="nav nav-pills nav-pills-sm nav-dark">
                    <li class="nav-item ml-0"><a class="nav-link py-2 px-4 font-weight-bolder font-size-sm"
                            @click="sayfayaGit(gelenBilgi.current_page-1)"><i class="flaticon2-fast-back"></i></a>
                    </li>
                    <li class="nav-item ml-0"><a class="nav-link py-2 px-4 font-weight-bolder font-size-sm"
                            @click="sayfayaGit(gelenBilgi.current_page+1)"><i class="flaticon2-fast-next"></i></a>
                    </li>
                    <li class="nav-item ml-0"><a class="nav-link py-2 px-4 font-weight-bolder font-size-sm"
                            v-on:click="aramaAc"><i class="flaticon-search"></i></a>
                    </li>
                    <li class="nav-item ml-0"><a class="nav-link py-2 px-4 font-weight-bolder font-size-sm"
                            v-on:click="sendInfo('yeni','yeni')"><i class="flaticon-add"></i></a>
                    </li>
                    <li class="nav-item ml-0"><a class="nav-link py-2 px-4 font-weight-bolder font-size-sm"
                            v-on:click="reload"><i class="flaticon-refresh"></i></a>
                    </li>
                </ul>
            </div>
        </div>

        <content-loader v-if="!loading" :speed="2" :animate="true"></content-loader>
        <div class="card-body" v-if="loading">

            <table class="table table-borderless mb-6">
                <thead>
                    <tr>
                        <th :class="{'asc' : orderByType == 'ASC' && orderByColumn == 'id','desc' : orderByType != 'ASC' && orderByColumn == 'id'}"
                            @click="sirala('id')">ID</th>
                        <th>Role</th>
                        <th :class="{'asc' : orderByType == 'ASC' && orderByColumn == 'name','desc' : orderByType != 'ASC' && orderByColumn == 'name'}"
                            @click="sirala('name')">Adı</th>
                        <th :class="{'asc' : orderByType == 'ASC' && orderByColumn == 'email','desc' : orderByType != 'ASC' && orderByColumn == 'email'}"
                            @click="sirala('email')">Email</th>
                        <th :class="{'asc' : orderByType == 'ASC' && orderByColumn == 'created_at','desc' : orderByType != 'ASC' && orderByColumn == 'created_at'}"
                            @click="sirala('created_at')">Oluşturulma Tarihi</th>
                        <th :class="{'asc' : orderByType == 'ASC' && orderByColumn == 'updated_at','desc' : orderByType != 'ASC' && orderByColumn == 'updated_at'}"
                            @click="sirala('updated_at')">Güncellenme Tarihi</th>
                        @can('KullaniciDuzenle')
                        <th class="pr-0 text-right">İşlemler</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(bilgi,index) in gelenBilgi.data">
                        <td><a v-text="bilgi.id"></a></td>
                        <td><a v-text="roleName(bilgi.role.role_id)"></a></td>
                        <td><a v-text="bilgi.name"></a></td>
                        <td><a v-text="bilgi.email"></a></td>
                        <td><a v-text.number="bilgi.created_at"></a></td>
                        <td><a v-text.number="bilgi.updated_at"></a></td>
                        @can('KullaniciDuzenle')
                            <td class="pr-0 text-right">
                                <a v-on:click="sendInfo(bilgi,'guncelle')"
                                    class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                    <span class="svg-icon svg-icon-md svg-icon-primary">
                                        <!--begin::Svg Icon | path:../../../../../metronic/themes/metronic/theme/html/demo2/dist/assets/media/svg/icons/Communication/Write.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <path
                                                    d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z"
                                                    fill="#000000" fill-rule="nonzero"
                                                    transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)">
                                                </path>
                                                <path
                                                    d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z"
                                                    fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                </a>
                                <a v-on:click="sendInfo(bilgi,'sil')" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                    <span class="svg-icon svg-icon-md svg-icon-primary">
                                        <!--begin::Svg Icon | path:../../../../../metronic/themes/metronic/theme/html/demo2/dist/assets/media/svg/icons/General/Trash.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <path
                                                    d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                                    fill="#000000" fill-rule="nonzero"></path>
                                                <path
                                                    d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                    fill="#000000" opacity="0.3"></path>
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                </a>
                                <a v-on:click="sendInfo(bilgi,'yetki')" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2020-07-07-181510/theme/html/demo2/dist/../src/media/svg/icons/Media/Shuffle.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <path d="M18,15 L18,13.4774152 C18,13.3560358 18.0441534,13.2388009 18.1242243,13.147578 C18.3063883,12.9400428 18.622302,12.9194754 18.8298372,13.1016395 L21.7647988,15.6778026 C21.7814819,15.6924462 21.7971714,15.7081846 21.811763,15.7249133 C21.9932797,15.933015 21.9717282,16.2488631 21.7636265,16.4303797 L18.828665,18.9903994 C18.7375973,19.0698331 18.6208431,19.1135979 18.5,19.1135979 C18.2238576,19.1135979 18,18.8897403 18,18.6135979 L18,17 L16.445419,17 C14.5938764,17 12.8460429,16.1451629 11.7093057,14.6836437 L7.71198984,9.54423755 C6.95416504,8.56989138 5.7889427,8 4.55458097,8 L2,8 L2,6 L4.55458097,6 C6.40612357,6 8.15395708,6.85483706 9.29069428,8.31635632 L13.2880102,13.4557625 C14.045835,14.4301086 15.2110573,15 16.445419,15 L18,15 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                            <path d="M18,6 L18,4.4774157 C18,4.3560363 18.0441534,4.23880134 18.1242243,4.14757848 C18.3063883,3.94004327 18.622302,3.9194759 18.8298372,4.10163997 L21.7647988,6.67780304 C21.7814819,6.69244668 21.7971714,6.70818509 21.811763,6.72491379 C21.9932797,6.93301548 21.9717282,7.24886356 21.7636265,7.43038021 L18.828665,9.99039986 C18.7375973,10.0698336 18.6208431,10.1135984 18.5,10.1135984 C18.2238576,10.1135984 18,9.88974079 18,9.61359842 L18,8 L16.445419,8 C15.2110573,8 14.045835,8.56989138 13.2880102,9.54423755 L9.29069428,14.6836437 C8.15395708,16.1451629 6.40612357,17 4.55458097,17 L2,17 L2,15 L4.55458097,15 C5.7889427,15 6.95416504,14.4301086 7.71198984,13.4557625 L11.7093057,8.31635632 C12.8460429,6.85483706 14.5938764,6 16.445419,6 L18,6 Z" fill="#000000" fill-rule="nonzero"/>
                                        </g>
                                    </svg><!--end::Svg Icon--></span>
                                </a>
                            </td>
                        @endcan
                    </tr>
                </tbody>
            </table>

            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div class="d-flex flex-wrap py-2 mr-3">
                    <a @click="sayfayaGit(1)" class="btn btn-icon btn-sm btn-light mr-2 my-1"><i
                            class="ki ki-bold-double-arrow-back icon-xs"></i></a>
                    <a @click="sayfayaGit(gelenBilgi.current_page-1)" class="btn btn-icon btn-sm btn-light mr-2 my-1"><i
                            class="ki ki-bold-arrow-back icon-xs"></i></a>
                    <template v-for="page in gelenBilgi.last_page"
                        v-if="page >= gelenBilgi.current_page - 3 && page <= gelenBilgi.current_page + 3">
                        <a href="#"
                            :class="{'btn btn-icon btn-sm border-0 btn-light btn-hover-primary active mr-2 my-1' : gelenBilgi.current_page == page, 'btn btn-icon btn-sm border-0 btn-light mr-2 my-1' : gelenBilgi.current_page != page}"
                            v-text="page" @click="sayfayaGit(page)"></a>
                    </template>
                    <a @click="sayfayaGit(gelenBilgi.last_page)" class="btn btn-icon btn-sm btn-light mr-2 my-1"><i
                            class="ki ki-bold-arrow-next icon-xs"></i></a>
                    <a @click="sayfayaGit(gelenBilgi.current_page-1)" class="btn btn-icon btn-sm btn-light mr-2 my-1"><i
                            class="ki ki-bold-double-arrow-next icon-xs"></i></a>
                </div>
                <div class="d-flex align-items-center py-3">
                    <div class="d-flex align-items-center" v-if='!loading2'>
                        <div class="mr-2 text-muted">Güncelleniyor...</div>
                        <div class="spinner mr-10"></div>
                    </div>
                    <span class="text-muted">Toplam <strong v-text="gelenBilgi.total"></strong> Kayıttan <strong
                            v-text="gelenBilgi.from + ' - ' + gelenBilgi.to"></strong>
                        Arası Kayıt Gösteriliyor.</span>
                </div>
            </div>
        </div>
        <div v-if="loading" class="modal fade" id="aramaAc" tabindex="-1" role="dialog" aria-hidden="true">
            <template>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <label class="modal-title text-text-bold-600">Kullanici Arama | Önce Aramak İstediğiniz Kriteri
                                Seçiniz</label>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i aria-hidden="true" class="ki ki-close"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input ref="arama" class="form-control" v-model="aranacakKelime" type="text">
                            </div>
                            <div class="form-group">
                                <div class="radio-inline">
                                    <label class="radio radio-square">
                                    <input type="radio" v-model="aranacakSutun" name="adayAramaInput" value="name">
                                    <span></span>Adı</label>

                                    <label class="radio radio-square">
                                    <input type="radio" v-model="aranacakSutun" name="adayAramaInput" value="email">
                                    <span></span>Email</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" v-on:click="reload" class="btn btn-lg btn-block btn-danger mb-2"
                                data-dismiss="modal">Aramayı Tamamla</button>
                        </div>
                    </div>
                </div>
            </template>
        </div>
        <div v-if="loading" class="modal fade text-left show" id="modalAc" tabindex="-1" role="dialog">
            <template>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <label class="modal-title text-text-bold-600">Kullanici Formu</label>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i aria-hidden="true" class="ki ki-close"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Kullanici Adı</label>
                                <input type="text" class="form-control" v-model="secilenBilgi.adi">
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" class="form-control" v-model="secilenBilgi.email">
                            </div>
                            <div class="form-group">
                                <label for="">Şifre</label>
                                <input type="password" class="form-control" v-model="secilenBilgi.password">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn grey btn-danger" data-dismiss="modal">Kapat</button>
                            <button type="button" @click="post" class="btn btn-success" data-dismiss="modal">Kaydet</button>
                        </div>
                    </div>
                </div>
            </template>
        </div>
        <div v-if="loading" class="modal fade text-left show" id="yetkiAc" tabindex="-1" role="dialog">
            <template>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <label class="modal-title text-text-bold-600"><strong v-text="secilenBilgi.adi"></strong> Yetki Ver</label>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i aria-hidden="true" class="ki ki-close"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Rolleri</label>
                                <span class="switch switch-sm switch-icon" >
                                    <select class="form-control" v-model="secilenBilgi.role">
                                        <option v-for="role in roller" :value="role.name" v-text="role.name"></option>
                                    </select>
                                </span>
                            </div>
                            <div class="form-group">
                                <label>Yetkileri</label>
                                <span class="switch switch-sm switch-icon" v-for='izin in izinler'>
                                    <label>
                                        <input type="checkbox" :value='izin.name' v-model="secilenBilgi.permissions">
                                        <span></span>
                                        @{{izin.name}}
                                    </label>
                                </span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn grey btn-danger" data-dismiss="modal">Kapat</button>
                            <button type="button" @click="post()" class="btn btn-success" data-dismiss="modal">Kaydet</button>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    let vm = new Vue({
        el: '#app',
        components: {
            'content-loader': window.contentLoaders.ListLoader,
        },
        data: {
            loading: false,
            loading2: true,
            gelenBilgi: [],
            secilenBilgi: {},
            postUrl: "/admin/kullanicilar",
            releoadUrl: "/reload/admin/kullanicilar",
            aranacakKelime: '',
            aranacakSutun: 'name',
            orderByColumn: 'created_at',
            orderByType: 'DESC',
            page: 1,
            roller:{!! json_encode($roles) !!},
            izinler:{!! json_encode($permissions) !!},
        },
        methods: {
            async sendInfo(veri, tip) {
                if(tip == 'yeni'){
                    this.secilenBilgi={
                        tip: tip,
                        adi: '',
                        email: '',
                        password: '',
                        id: '',
                        role: 2
                    };
                    $('#modalAc').modal('show');
                }else if(tip == 'yetki'){
                    this.secilenBilgi={
                        tip: tip,
                        id: veri.id,
                        permissions: vm.izin(veri.permission),
                        role: vm.roleName(veri.role.role_id)
                    };

                    $('#yetkiAc').modal('show');
                }else if(tip == 'guncelle'){
                    this.secilenBilgi={
                        tip: tip,
                        adi: veri.name,
                        email: veri.email,
                        id: veri.id,
                        password:'',
                    };
                    $('#modalAc').modal('show');
                }
                else if(tip == 'sil'){
                    this.secilenBilgi={
                        tip: tip,
                        id: veri.id,
                    };
                    vm.post()
                }

            },
            aramaAc() {
                $('#aramaAc').modal('show');
            },
            post() {
                axios({
                    url: "#",
                    method: "POST",
                    data: this.secilenBilgi
                }).then(function (data) {
                    toastr.success ("İşlem Başarılı", "Mesaj");
                    vm.reload();
                }).catch(function (err) {
                    toastr.error("İşlem Başarısız", "Hata");
                });

            },
            sirala(sira) {
                this.orderByColumn = sira;
                this.orderByType = this.orderByType == "ASC" ? "DESC" : "ASC";
                vm.reload();
            },
            sayfayaGit(page) {
                this.page = page;
            },
            izin(dizi){
                let list=[];
                $.each(dizi, function(key, value) {
                    list.push(vm.permissionName(value.permission_id));
                });
                return list;
            },
            roleName(id){
                let listItem = this.roller.find(x => x.id == id );
                return listItem.name;
            },
            permissionName(id){
                let listItem = this.izinler.find(x => x.id == id );
                return listItem.name;
            },
            async reload() {
                $('#aramaAc').modal('hide');
                this.loading = false;
                await axios.get(this.releoadUrl + "?page=" + this.page + "&aranacakKelime=" + this
                    .aranacakKelime + "&aranacakSutun=" + this.aranacakSutun + "&orderbycolumn=" + this
                    .orderByColumn + "&orderbytype=" + this.orderByType, {}).then((response) => {
                    this.gelenBilgi = response.data;
                    this.loading = true;
                });
            }
        },
        mounted() {
            this.reload();
        },
        watch: {
            page: {
                handler: function (value) {
                    this.reload();
                }
            }
        },

    });
</script>
@endsection
@section('styles')

@endsection
