<template>
    <div>
        <h3>{{ sabitler.ad }}</h3>
        <table>
            <tr>
                <th
                    v-for="(baslik, baslik_index) in basliklar"
                    :key="baslik.id + baslik_index"
                    draggable="true"
                    @dragstart="tasimaBasladi"
                >
                    {{ baslik.ad }}
                </th>
            </tr>
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
        </table>
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
                sabitler: turSabitleri[this.tur],
                gizlenecekler: this.gizle,

                datatable: null,
                basliklar: [],
                veriler: [],
                duzenlemeObjesi: {},
            }
        },
        beforeMount() {
            this.baslikSiralamasiAyarla();
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
            baslikSiralamasiAyarla() {
                let basliklar = this.sabitler.tablo.basliklar;

                // TODO Kullanıcının ayarJSON'u çekilecek
                let ayarJSON = {
                    tablo: {
                        "KULLANICI": {
                            siralama: "0,1,2"
                        }
                    }
                };

                if (!ayarJSON.tablo || !ayarJSON.tablo[this.tur] || !ayarJSON.tablo[this.tur].siralama)
                    return;

                let siralama = ayarJSON.tablo[this.tur].siralama.split(",");

                let yeniSiralanmisDizi = {};
                siralama.forEach((sira, i) => {
                    yeniSiralanmisDizi[sira] = basliklar[i];
                });

                this.sabitler.tablo.basliklar = Object.values(yeniSiralanmisDizi);
            },
            tasimaBasladi(event) {
                // TODO Başlıklar arası taşıma yapılacak
                console.log(event);
                event.dataTransfer.dropEffect = "move";
            },
        },
    }
</script>

<style scoped>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2
    }

    th {
        background-color: #4CAF50;
        color: white;
        transition: background-color .3s, color .3s;
    }

    th:hover {
        background-color: #9effa1;
        color: rgb(49, 49, 49);
        cursor: pointer;
    }
</style>