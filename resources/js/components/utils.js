function get(tur) {
    let turler = {
        "KULLANICI": [
            { ad: "Cihat", soyad: "ŞENGÜN" }
        ],
        "ARABA": [
            { ad: "Mercedes", model: "AMG", yil: 2012 },
            { ad: "Ford", model: "Fiesta", yil: 2004 },
        ]
    };

    return turler[tur];
}

export default get;