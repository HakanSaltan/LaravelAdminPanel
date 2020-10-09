<template>
    <div>
        <h3>{{ sabitler.ad }}</h3>
        <table>
            <tr>
                <th v-for="(baslik, baslik_index) in basliklar" :key="baslik.id + baslik_index">{{ baslik.ad }}</th>
            </tr>
            <tr v-for="(veri, veri_index) in veriler" :key="veri_index">
                <td v-for="(yapi, yapi_index) in basliklar" :key="yapi.id + yapi_index">{{ veri[yapi.id] }}</td>
            </tr>
        </table>
    </div>
</template>

<script>
    import turSabitleri from "./TurSabitleri";
    import get from "./utils";

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
            }
        },
        beforeMount() {
            this.basliklar = this.sabitler.tablo.yapi;
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
        },
        mounted() {
            // console.log(turSabitleri);
            this.veriler = this.verileriGetir();
        },
        methods: {
            verileriGetir() {
                return get(this.tur);
            }
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
    }
</style>