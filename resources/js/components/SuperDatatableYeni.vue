<template>
    <div class="card card-custom card-stretch gutter-b">

        <div class="card-header border-0 pt-7">
            <div class="card-title align-items-start flex-column">
                <span class="card-label font-weight-bold font-size-h4 text-dark-75">{{ sabitler.ad }}</span>
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
        <div class="card-body">

            <table class="table table-borderless mb-6">
                <thead>
                    <tr>
                        <th v-for="(baslik, baslik_index) in basliklar" :key="baslik.id + baslik_index">{{ baslik.ad }}</th>
                    </tr>
                </thead>
                <tbody>
                   <tr v-for="(veri, veri_index) in veriler" :key="veri_index">
                    <td v-for="(baslik, baslik_index) in basliklar" :key="baslik.id + baslik_index + veri_index">
                        <div v-if="duzenlemeObjesi[baslik.id + baslik_index + veri_index] && duzenlemeObjesi[baslik.id + baslik_index + veri_index].acik" key="acik">
                            <input
                                type="text"
                                v-model="duzenlemeObjesi[baslik.id + baslik_index + veri_index].model"
                                @blur="kaydet({ tekil: true, id: baslik.id, veri_index, key: baslik.id + baslik_index + veri_index })"
                                @keyup.enter="kaydet({ tekil: true, id: baslik.id, veri_index, key: baslik.id + baslik_index + veri_index })"
                                autofocus
                            />
                        </div>
                        <div
                            v-else
                            @dblclick.stop="duzenlemeAc(baslik.id + baslik_index + veri_index, veri[baslik.id])"
                            key="kapali"
                        >
                            {{ veri[baslik.id] }}
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>

            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div class="d-flex flex-wrap py-2 mr-3">
                    <a @click="sayfayaGit(1)" class="btn btn-icon btn-sm btn-light mr-2 my-1"><i
                            class="ki ki-bold-double-arrow-back icon-xs"></i></a>
                    <a @click="sayfayaGit(veriler.current_page-1)" class="btn btn-icon btn-sm btn-light mr-2 my-1"><i
                            class="ki ki-bold-arrow-back icon-xs"></i></a>
                    <!-- <template v-for="page in veriler.last_page"
                        v-if="page >= veriler.current_page - 3 && page <= veriler.current_page + 3">
                        <a href="#" :class="{'btn btn-icon btn-sm border-0 btn-light btn-hover-primary active mr-2 my-1' : veriler.current_page == page, 'btn btn-icon btn-sm border-0 btn-light mr-2 my-1' : veriler.current_page != page}"
                            v-text="page" @click="sayfayaGit(page)"></a>
                    </template> -->
                    <a @click="sayfayaGit(veriler.last_page)" class="btn btn-icon btn-sm btn-light mr-2 my-1"><i
                            class="ki ki-bold-arrow-next icon-xs"></i></a>
                    <a @click="sayfayaGit(veriler.current_page-1)" class="btn btn-icon btn-sm btn-light mr-2 my-1"><i
                            class="ki ki-bold-double-arrow-next icon-xs"></i></a>
                </div>
                <div class="d-flex align-items-center py-3">
                    <div class="d-flex align-items-center" v-if='!loading2'>
                        <div class="mr-2 text-muted">Güncelleniyor...</div>
                        <div class="spinner mr-10"></div>
                    </div>
                    <span class="text-muted">Toplam <strong v-text="veriler.total"></strong> Kayıttan <strong
                            v-text="veriler.from + ' - ' + veriler.to"></strong>
                        Arası Kayıt Gösteriliyor.</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { turSabitleri } from "./TurSabitleri";
    import { get, json, post } from "./utils";

    export default {
        props: {
            tur: {
                type: String,
                required: true
            },
            gizle: {
                type: Array,
                default() {
                    return []
                }
            }
        },
        data() {
            return {
                loading: false,
                loading2: true,
                page:1,
                aranacakKelime: '',
                aranacakSutun: 'name',
                orderByColumn: 'created_at',
                orderByType: 'DESC',
                page: 1,

                sabitler: turSabitleri[this.tur],
                gizlenecekler: this.gizle,

                datatable: null,
                basliklar: [],
                veriler: [],
                duzenlemeObjesi: {},
            }
        },
        beforeMount() {
            this.basliklar = this.sabitler.tablo.basliklar;
            let gizlenecekler = this.sabitler.tablo.gizlenecekler;
            if (gizlenecekler.length > 0) {
                gizlenecekler.forEach(ist => {
                    let index = this.basliklar.findIndex(y => y.id == ist);
                    if (index > -1) {
                        this.basliklar.splice(index, 1);
                    }
                });
            }
            else if (this.gizlenecekler.length > 0) {
                this.gizlenecekler.forEach(ist => {
                    let index = this.basliklar.findIndex(y => y.id == ist);
                    if (index > -1) {
                        this.basliklar.splice(index, 1);
                    }
                });
            }

            this.verileriGetir();
        },
        mounted() {},
        methods: {
            verileriGetir() {
                return get(this.tur).then(donen => {
                    this.veriler = donen.data.veriler;
                });
            },
            kaydet(parametreler = {}) {
                let gonderilecekVeriler = {};

                // Eğer sadece bir alan çift tıklayarak düzeltildiyse
                if (parametreler.tekil) {
                    let { key, id, veri_index } = parametreler;

                    // Eğer değerler aynıysa post atmadan eski haline döndürdük
                    if (this.veriler[veri_index][id] === this.duzenlemeObjesi[key].model) {
                        delete this.duzenlemeObjesi[key];
                        this.duzenlemeObjesi = json(this.duzenlemeObjesi);
                        return;
                    }

                    gonderilecekVeriler[id] = this.duzenlemeObjesi[key].model;

                    gonderilecekVeriler[this.sabitler.tablo.birincilId] = this.veriler[veri_index][this.sabitler.tablo.birincilId];
                    gonderilecekVeriler.birincilId = this.sabitler.tablo.birincilId;
                }
                else {
                    gonderilecekVeriler = parametreler.veri;
                }

                return post(this.tur, gonderilecekVeriler).then(donen => {
                    console.log("İŞLEM BAŞARILI");
                    if (parametreler.tekil) {
                        this.veriler[parametreler.veri_index][parametreler.id] = json(this.duzenlemeObjesi[parametreler.key].model);
                        delete this.duzenlemeObjesi[parametreler.key];
                        this.duzenlemeObjesi = json(this.duzenlemeObjesi);
                    }
                });
            },

            duzenlemeAc(key, veri) {
                this.duzenlemeObjesi[key] = {
                    acik: true,
                    model: veri
                };

                this.duzenlemeObjesi = json(this.duzenlemeObjesi);
            },
        },
        watch: {
            page: {
                handler: function (value) {
                    this.reload();
                }
            }
        },
    }
</script>

