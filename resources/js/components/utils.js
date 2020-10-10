// function get(tur) {
//     let turler = {
//         "KULLANICI": [
//             { ad: "Cihat", soyad: "ŞENGÜN" }
//         ],
//         "ARABA": [
//             { ad: "Mercedes", model: "AMG", yil: 2012 },
//             { ad: "Ford", model: "Fiesta", yil: 2004 },
//         ]
//     };

//     return turler[tur];
// }

import { turSabitleri } from "./TurSabitleri";
import axios from "axios";

function get(tur, parametreler = {}) {
    let sabitBilgi = turSabitleri[tur];
    let sorgu = axios.get(sabitBilgi.url, {
        params: parametreler
    });

    sorgu.then(donen => {
        if (!donen.data)
            hata("Data gelmedi");

        if (!donen.data.sonuc)
            hata("Sonuç false");
    })
    .catch(e => {
        console.log("HATA: ");
        hata(e);
    });

    return sorgu;
}

function post(tur, parametreler = {}) {
    let sabitBilgi = turSabitleri[tur];
    let sorgu = axios.post(sabitBilgi.url, parametreler);

    sorgu.then(donen => {
        if (!donen.data)
            hata("Data gelmedi");

        if (!donen.data.sonuc)
            hata("Sonuç false");
    })
    .catch(e => {
        console.log("HATA: ");
        hata(e);
    });

    return sorgu;
}

function hata(e) {
    console.error(e);
}

function json(veri) {
    return JSON.parse(JSON.stringify(veri));
}

export { get, json, hata, post };