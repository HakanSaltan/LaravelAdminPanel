@extends('layout.app')
@section("content")

<div class="content-header row">
</div>
<div class="content-body" id="app">
        <section class="todoapp">
            <header class="header">
            <h1>todos</h1>
            <input
                class="new-todo"
                autofocus
                autocomplete="off"
                placeholder="Görev Ekleyiniz ?"
                v-model="gorevAciklama"
                @keyup.enter="gorevOlustur"
            />
            </header>
            <section class="main" v-show="gorevler.length" v-cloak>
                <ul class="todo-list">
                    <li v-for="(todo,index) in filteredGorevler" class="todo" :key="todo.id"
                    :class="{ completed: todo.tamam, editing: todo == editedTodo }">
                    <div class="view">

                        <input @click="tamam(todo)" class="toggle" type="checkbox" v-model="todo.tamam"/>
                        <label @dblclick="editTodo(todo)" v-text="todo.aciklama"></label>
                        <span @click="durumDegistir(index)" class="durum" :class="{'tag tag-info' : todo.durum == '1','tag tag-warning' : todo.durum == '2','tag tag-success' : todo.durum == '3','tag tag-danger' : todo.durum == '4'}">@{{todo.durum | durumAdi}}</span>
                        <button v-if="index > 0" type="button" class="destroyazalt" @click="gorevAzalt(todo)">↑</button>
                        {{-- <button type="button" class="destroyarttir" @click="gorevArttir(todo)">↓</button> --}}
                        <button type="button" class="destroy" @click="gorevSil(todo.id)"></button>
                    </div>
                    <input class="edit" type="text" v-model="todo.aciklama" v-todo-focus="todo == editedTodo" @blur="doneEdit(todo)"
                        @keyup.enter="doneEdit(todo)" @keyup.esc="cancelEdit(todo)" />
                    </li>
                </ul>
            </section>
            <footer class="footer" v-show="gorevler.length" v-cloak>
            <span class="todo-count">
                Görev Sayısı : <strong v-text="remaining"></strong>
            </span>
            <ul class="filters">
                <li>
                <a href="#/all" :class="{ selected: visibility == 'all' }">Tümü</a>
                </li>
                <li>
                <a href="#/active" :class="{ selected: visibility == 'active' }">Tamamlanmayanlar</a>
                </li>
                <li>
                <a href="#/completed" :class="{ selected: visibility == 'completed' }">Tamamlananlar</a>
                </li>
            </ul>
            <button class="clear-completed" @click="tumunuKaldir" v-show="gorevler.length > remaining">
                Tamamlanan Görevleri Kaldır
            </button>
            </footer>
        </section>
</div>
@endsection
@section('js')
<script>
  // visibility filters
  var filters = {
        all: function (gorevler) {
        return gorevler;
        },
        active: function (gorevler) {
        return gorevler.filter(function (gorev) {
            return !gorev.tamam;
        });
        },
        completed: function (gorevler) {
        return gorevler.filter(function (gorev) {
            return gorev.tamam;
        });
        }
    };

  // app Vue instance
  let vm = new Vue({
    el: '#app',
    components: {
        'content-loader': window.contentLoaders.ListLoader,
    },
    data: {
        loading: false,
        gorevLoading: false,
        gorevler: [],
        newTodo: "",
        editedTodo: null,
        geciciTodo: null,
        visibility: "all",
        gorevOlusturUrl: '/api/gorevler',
        gorevPage: 1,
        gorevSira: '1',
        gorevBaslik: '',
        gorevAciklama: '',
        gorevOlusturan: {!! Auth::user() -> id !!}
      },

    methods: {
      limitStr () {
          let str = this.gorevAciklama;
          if (typeof str === 'string' && str.length > 10) {
              str = str.slice(0, 10) + '...';
          }
          return str;
      },
      durumDegistir(index){
        todo = vm.filteredGorevler[index];
        this.editedTodo = todo;
        this.editedTodo.durum +=1;
        this.editedTodo.durum > 4 ? this.editedTodo.durum = 1 : this.editedTodo.durum;
        this.editedTodo.durum == 3 ? this.editedTodo.tamam = 1 : this.editedTodo.tamam = 0;
        this.doneEdit(todo);
      },
      tamam: function(todo){
          this.editedTodo = todo;
          this.editedTodo.tamam == 1 ? this.editedTodo.tamam = 0 : this.editedTodo.tamam = 1;
          this.editedTodo.tamam == 1 ? this.editedTodo.durum = 3 : this.editedTodo.durum = 1;
          this.doneEdit(todo);
      },
      gorevAzalt: function(todo) {
          this.editedTodo = todo;
          this.editedTodo.sira -= 1
          if(this.editedTodo.sira <=0) this.editedTodo.sira = 1;
          this.doneEdit(todo);
      },
      gorevArttir: function(todo) {
          this.editedTodo = todo;
          this.editedTodo.sira += 1;
          this.doneEdit(todo);
      },
      gorevleriGetir() {
          axios.get(this.gorevOlusturUrl + "?page=" + this.gorevPage, {}).then((response) => {
              this.gorevler = response.data.data;
              this.gorevLoading = true;
          });
      },
      gorevOlustur() {
          vm.gorevBaslik = this.limitStr();
          let formData = new FormData();
          formData.append('sira', vm.gorevSira);
          formData.append('baslik', vm.gorevBaslik);
          formData.append('aciklama', vm.gorevAciklama);
          formData.append('olusturan_id', vm.gorevOlusturan);
          axios.post(vm.gorevOlusturUrl, formData)
              .then(function (data) {
                  vm.gorevSira="";
                  vm.gorevBaslik="";
                  vm.gorevAciklama="";
                  vm.gorevOlusturan="";
                  vm.gorevleriGetir();
              }).catch(function (error) {
                  alert(error);
              })
      },
      gorevSil(id) {
          axios.delete(vm.gorevOlusturUrl + "/" + id)
              .then(function (data) {
                  vm.gorevleriGetir();
              }).catch(function (error) {
                  alert(error);
              })
      },
      tumunuKaldir(){
          axios.post('/api/gorevler/tumunuKaldir')
              .then(function (data) {
                  vm.gorevleriGetir();
              }).catch(function (error) {
                  alert(error);
              })
      },

      editTodo: function (todo) {
          this.beforeEditCache = todo.aciklama;
          this.editedTodo = todo;
      },

      doneEdit: function (todo) {
          if (!this.editedTodo){return};
          if (!this.editedTodo.aciklama) {
              this.gorevSil(this.editedTodo.id);
          }else{
              this.geciciTodo = this.editedTodo
              this.editedTodo = null
              axios.put(vm.gorevOlusturUrl + "/" + todo.id, this.geciciTodo)
              .then(function (data) {
                  vm.gorevleriGetir();
                  this.geciciTodo = null;
                  todo.aciklama = todo.aciklama.trim();
              }).catch(function (error) {
                  alert(error);
              })
          }
      },
      cancelEdit: function (todo) {
          this.editedTodo = null;
          todo.aciklama = this.beforeEditCache;
      },
    },

    computed: {
        filteredGorevler: function () {
            return filters[this.visibility](this.gorevler);
        },
        remaining: function () {
            return filters.active(this.gorevler).length;
        },
        allDone: {
            get: function () {
            return this.remaining === 0;
            },
            set: function (value) {
            this.gorevler.forEach(function (todo) {
                todo.completed = value;
            });
            }
        }
    },
    mounted() {
        this.gorevleriGetir();
    },
    filters:{
      durumAdi: function (deger) {
        switch (deger) {
          case 0 : return "Yeni"; break;
          case 1 : return "İnceleniyor"; break;
          case 2 : return "İşlemde"; break;
          case 3 : return "Tamamlandı"; break;
          case 4 : return "İptal"; break;
          default : return "Anlayamadım"; break;
        }
      }
    },

    directives: {
      "todo-focus": function (el, binding) {
        if (binding.value) {
          el.focus();
        }
      }
    }
  });

  // handle routing
  function onHashChange() {
    var visibility = window.location.hash.replace(/#\/?/, "");
    if (filters[visibility]) {
      vm.visibility = visibility;
    } else {
      window.location.hash = "";
      vm.visibility = "all";
    }
  }

  window.addEventListener("hashchange", onHashChange);
  onHashChange();

</script>

@endsection
@section('styles')
<link rel="stylesheet" type="text/css" href="/assets/css/todo.css" />
<style>
  [v-cloak] {
    display: none;
  }
</style>
@endsection
