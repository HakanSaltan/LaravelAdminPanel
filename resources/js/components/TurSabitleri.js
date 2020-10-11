const turSabitleri = {
    "KULLANICI": {
        // Bileşenin başlık kısmında görünür
        ad: "Kullanıcılar",
        kod: "KULLANICI",
        // Hangi URL'ye Post, Get, Delete vb. isteklerin atılacağını tutar
        url: "/islem/kullanicilar",
        tablo: {
            basliklar: [
                /**
                 * id -> Veritabanındaki alan adı
                 * ad -> Tablo başlığında görünmesi gereken ad
                 */
                { id: "name", ad: "Ad" },
                { id: "email", ad: "E-posta" },
                { id: "islem", ad: "İşlemler" },
            ],
            /**
             * Hangi başlığın gizleneceğini belirler
             * Veritabanındaki alan adı (yani id) yazılması yeterli
             * Örnek; ["name", "email"]
             */
            gizlenecekler: [],

            /**
             * Veritabanındaki benzersiz ID'yi temsil eder
             * Güncelleme veya silme fonksiyonları için kullanılır
             * Amaç dinamik yapı kurmak
             */
            birincilId: "id",
        }
    },
    "ARACLAR": {
        // Bileşenin başlık kısmında görünür
        ad: "Araçlar",
        kod: "ARACLAR",
        // Hangi URL'ye Post, Get, Delete vb. isteklerin atılacağını tutar
        url: "/islem/araclar",
        tablo: {
            basliklar: [
                /**
                 * id -> Veritabanındaki alan adı
                 * ad -> Tablo başlığında görünmesi gereken ad
                 */
                { id: "marka", ad: "Marka" },
                { id: "model", ad: "Model" },
                { id: "plaka", ad: "Plaka" },
            ],
            /**
             * Hangi başlığın gizleneceğini belirler
             * Veritabanındaki alan adı (yani id) yazılması yeterli
             * Örnek; ["name", "email"]
             */
            gizlenecekler: [],

            /**
             * Veritabanındaki benzersiz ID'yi temsil eder
             * Güncelleme veya silme fonksiyonları için kullanılır
             * Amaç dinamik yapı kurmak
             */
            birincilId: "marka",
        }
    },
};


export { turSabitleri };
