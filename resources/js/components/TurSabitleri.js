const turSabitleri = {
    "KULLANICI": {
        ad: "Kullanıcılar",
        kod: "KULLANICI",
        url: "/kullanici",
        tablo: {
            yapi: [
                { id: "ad", ad: "Ad" },
                { id: "soyad", ad: "Soyad" },
                { id: "islem", ad: "İşlemler" },
            ],
            gizlenecekler: []
        }
    },
    "ARABA": {
        ad: "Arabalar",
        kod: "ARABA",
        url: "/arabalar",
        tablo: {
            yapi: [
                { id: "ad", ad: "Ad" },
                { id: "model", ad: "Model" },
                { id: "yil", ad: "Yıl" },
                { id: "islem", ad: "İşlemler" },
            ],
            gizlenecekler: []
        }
    },
};


export default turSabitleri;