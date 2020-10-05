var app = require('express')();
var http = require('http').createServer(app);
var io = require('socket.io')(http);

app.get('/', (req, res) => {
  res.sendFile(__dirname + '/index.html');
});

let KULLANICILAR = [];
let VARSAYILAN_DATA = {
    veriler: null
};

io.on('connection', (socket) => {
    kullaniciEkle(socket);
    console.log('a user connected');

    tumKullanicilaraGonder("Bir kullanıcı Bağlandı");

    socket.on('disconnect', () => {
        console.log('user disconnected');
    });

    socket.on("degistir", (data) => {
        console.log(data);
        tumKullanicilaraGonder(parse(data));
    });
});

// {
//     anasayfa: {
//         sinav: {
//             not:
//         }
//     },
//     odev_ekle: [],
// }

function parse(data) {
    return JSON.parse(data);
}

function stringify(data) {
    return JSON.stringify(data);
}

function kullaniciEkle(socket, data = null) {
    KULLANICILAR.push({ socket });
}

function tumKullanicilaraGonder(data) {
    if (typeof data === 'string'){
        data = stringify({
            ...VARSAYILAN_DATA,
            mesaj: data,
        });
    }
    else {
        data = stringify(data)
    }
    KULLANICILAR.forEach(kullanici => {
        kullanici.socket.emit("degistiMi", data);
    });
}

http.listen(3000, () => {
  console.log('listening on *:3000');
});
