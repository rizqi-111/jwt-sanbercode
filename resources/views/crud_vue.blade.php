<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"></meta>
    <title>Document</title>
</head>
<body>
    <div id="app">
        <h3>CRUD Buku dengan VUE + Laravel</h3>
        <h4>Tambah Buku </h4>
        
        <form @submit.prevent="addBook()">
            <div class="form-group">
              <label>Judul</label>
              <input
                type="textfield"
                class="form-control"
                placeholder="Masukkan Judul Buku"
                v-model="form.judul"
                required
              >
            </div>
            <div class="form-group">
              <label>Nama Pengarang</label>
              <input
                type="text"
                class="form-control"
                placeholder="Masukkan Nama Pengarang Buku"
                v-model="form.pengarang"
                required
              >
            </div>
            <div class="form-group">
              <label>Tahun Terbit</label>
              <input
                type="date"
                class="form-control"
                placeholder="Masukkan Tahun Terbit"
                v-model="form.tahun_terbit"
                required
              >
            </div>
            <button class="btn btn-primary">Tambah</button>
          </form> 
        
        <ul>
            <li v-for="(book,index) in books">
                <span>@{{ book.judul }} || @{{ book.pengarang }} || @{{ book.tahun_terbit }}</span>
                <button type="button" v-on:click="editBook(book,index)">Edit</button>
                <button type="button" v-on:click="remove(book,index)">Delete</button>
            </li>
        </ul>

        <br>

        <component :is="currentView" :books="books"></component>
    </div>

    <template id="edit-template">
        <form @submit.prevent="updateBook()">
            <div class="form-group">
              <label>Judul</label>
              <input
                type="textfield"
                class="form-control"
                placeholder="Masukkan Judul Buku"
                v-model="form.judul1"
                required
              >
            </div>
            <div class="form-group">
              <label>Nama Pengarang</label>
              <input
                type="text"
                class="form-control"
                placeholder="Masukkan Nama Pengarang Buku"
                v-model="form.pengarang1"
                required
              >
            </div>
            <div class="form-group">
              <label>Tahun Terbit</label>
              <input
                type="date"
                class="form-control"
                placeholder="Masukkan Tahun Terbit"
                v-model="form.tahun_terbit1"
                required
              >
            </div>
            <button class="btn btn-primary">Ubah</button>
        </form> 
    </template>

    <template id="notif">
        <h5>Berhasil Ubah Data Buku</h5>
    </template>

<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>
<script>
    new Vue({
        el: "#app",
        data : {
            newBook : '',
            books : [],
            form : {id:'',judul:'',pengarang:'',tahun_terbit:''},
            currentView: ''
        },
        mounted(){
            this.$http.get('/api/read').then(response => {
                    let result = response.body
                    this.books = result
                });
        },
        methods : {
            addBook() {
                bookInput = this.form.judul.trim();

                if(bookInput){
                    // POST /someUrl
                    this.$http.post('/api/addbook', {
                        judul : this.form.judul,
                        pengarang : this.form.pengarang,
                        tahun_terbit : this.form.tahun_terbit
                    }).then(response => {
                        let result = response.body
                        this.books.push({
                            id: response.body.id,
                            judul : response.body.judul,
                            pengarang : response.body.pengarang,
                            tahun_terbit : response.body.tahun_terbit
                        })
                    });
                }
            },
            remove(book,index) {
                if(confirm("Apakah Anda yakin Menghapus Buku '"+book.judul+"'")){
                    this.$http.delete('/api/destroy/' + book.id, {
                    
                    }).then(response => {
                        this.books.splice(index,1)
                    });
                }
            },
            editBook(book,index) {
                this.currentView = ''
                Vue.component('edit',{
                    template: '#edit-template',
                    data: function(){
                        return {
                            form : {
                                judul1: book.judul, 
                                pengarang1: book.pengarang, 
                                tahun_terbit1: book.tahun_terbit
                            },
                        }
                    },
                    methods: {
                        updateBook(){
                            this.$http.put('/api/update/'+book.id, {
                                judul : this.form.judul1,
                                pengarang : this.form.pengarang1,
                                tahun_terbit : this.form.tahun_terbit1
                            }).then(response => {
                                updateBook = response.body
                                id = this.$parent.books.findIndex(x => x.id == book.id)
                                this.$parent.books[id].judul = updateBook.judul
                                this.$parent.books[id].pengarang = updateBook.pengarang
                                this.$parent.books[id].tahun_terbit = updateBook.tahun_terbit
                                this.$parent.currentView = ''
                            });
                        }
                    },
                })
                this.currentView = 'edit'
            }
        }
    })
</script>
</body>
</html>