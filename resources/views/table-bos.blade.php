@extends('layout.app')
@section("content")

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
                        v-on:click="aramaAc"><i class="flaticon-search"></i></a></li>
                <li class="nav-item ml-0"><a class="nav-link py-2 px-4 font-weight-bolder font-size-sm"
                        v-on:click="sendInfo('yeni','yeni')"><i class="flaticon-add"></i></a></li>
                <li class="nav-item ml-0"><a class="nav-link py-2 px-4 font-weight-bolder font-size-sm"
                        v-on:click="reload"><i class="flaticon-refresh"></i></a></li>
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
                    <th :class="{'asc' : orderByType == 'ASC' && orderByColumn == 'name','desc' : orderByType != 'ASC' && orderByColumn == 'name'}"
                        @click="sirala('name')">Adı</th>
                    <th :class="{'asc' : orderByType == 'ASC' && orderByColumn == 'email','desc' : orderByType != 'ASC' && orderByColumn == 'email'}"
                        @click="sirala('email')">Email</th>
                    <th :class="{'asc' : orderByType == 'ASC' && orderByColumn == 'created_at','desc' : orderByType != 'ASC' && orderByColumn == 'created_at'}"
                        @click="sirala('created_at')">Oluşturulma Tarihi</th>
                    <th :class="{'asc' : orderByType == 'ASC' && orderByColumn == 'updated_at','desc' : orderByType != 'ASC' && orderByColumn == 'updated_at'}"
                        @click="sirala('updated_at')">Güncellenme Tarihi</th>
                    <th class="pr-0 text-right">İşlemler</th>

                </tr>
            </thead>
            <tbody>
                <tr v-for="(bilgi,index) in gelenBilgi.data">
                    <td><a v-text="bilgi.id"></a></td>
                    <td><a v-text="bilgi.name"></a></td>
                    <td><a v-text="bilgi.email"></a></td>
                    <td><a v-text.number="bilgi.created_at"></a></td>
                    <td><a v-text.number="bilgi.updated_at"></a></td>
                    <td class="pr-0 text-right">
                        <a v-on:click="sendInfo(bilgi,bilgi.id)"
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
                    </td>
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
                    <div class="mr-2 text-muted">Loading...</div>
                    <div class="spinner mr-10"></div>
                </div>
                {{-- <select class="form-control form-control-sm font-weight-bold mr-4 border-0 bg-light"
                            style="width: 75px;">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select> --}}
                <span class="text-muted">Toplam <strong v-text="gelenBilgi.total"></strong> Kayıttan <strong
                        v-text="(((gelenBilgi.current_page - 1) * gelenBilgi.per_page)+1) + ' - ' + (gelenBilgi.current_page) * gelenBilgi.per_page"></strong>
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
                        <div class="row">
                            <div class="col-md-3">
                                <label class="container">
                                    <input type="radio" v-model="aranacakSutun" name="adayAramaInput" value="name">
                                    <span class="checkmark">Adı</span>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label class="container">
                                    <input type="radio" v-model="aranacakSutun" name="adayAramaInput" value="email">
                                    <span class="checkmark">Email</span>
                                </label>
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
            postUrl: "/admin/kullanicilar",
            releoadUrl: "/reload/admin/kullanicilar",
            aranacakKelime: '',
            aranacakSutun: 'name',
            orderByColumn: 'created_at',
            orderByType: 'DESC',
            page: 1,
        },
        methods: {
            sirala(sira) {
                this.orderByColumn = sira;
                this.orderByType = this.orderByType == "ASC" ? "DESC" : "ASC";
                vm.reload();
            },
            sayfayaGit(page) {
                this.page = page;
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
            },
        },
        mounted() {
            this.reload();
            setInterval(function () {
                this.loading2 = false;
                axios.get(this.releoadUrl + "?page=" + this.page + "&aranacakSutun=" + this
                    .aranacakSutun + "&orderbycolumn=" + this
                    .orderByColumn + "&orderbytype=" + this.orderByType, {}).then((response) => {
                    this.gelenBilgi = response.data;
                    this.loading2 = true;
                }).catch((error) => {
                    alert('Lütfen Sayfayı Yenileyiniz');
                });
            }.bind(this), 10000);
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
