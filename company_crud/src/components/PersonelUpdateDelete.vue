<template>
    <div class="container">
        <h1>Çalışanlar</h1>
        <table class="table table-bordered" id="companyList">
            <thead>
            <tr>
                <th scope="col">Personel Adı Soyadı</th>
                <th scope="col">Çalıştığı Şirket</th>
                <th scope="col">E-Posta</th>
                <th scope="col">Ünvan</th>
                <th scope="col">Telefon</th>
                <th scope="col">Güncelle</th>
                <th scope="col">Sil</th>
            </tr>
            </thead>
            <tr id="" v-for="(personel, index) in personelList" v-bind:key="index">
                <td>{{personel.name}}</td>
                <td>{{personel.company.name}}</td>
                <td>{{personel.email}}</td>
                <td>{{personel.title}}</td>
                <td>{{personel.telephone}}</td>
                <td><a href="" class="btn btn-warning" @click="getPersonelData(personel.id)" data-toggle="modal" data-target="#exampleModal">Güncelle</a></td>
                <td><button class="btn btn-danger" @click="deletePersonel(personel.id, index)" >Sil</button></td>
            </tr>
        </table>
        <div id="loading"><img v-if="isLoading" id="loadingImg" src="../assets/loading.gif"></div>
        <modal :header="header">
            <template v-slot:body>
                <div class="form">
                    <label for="name">Personel Adı</label>
                    <input type="text" name="name" class="form-control" v-model="personelData.name">
                </div>
                <div class="form">
                    <label for="surname">Personel Soyadı</label>
                    <input type="text" name="surname" class="form-control" v-model="personelData.surname">
                </div>
                <div class="form">
                    <label for="title">Ünvan</label>
                    <input type="text" name="title" class="form-control" v-model="personelData.title">
                </div>
                <div class="form">
                    <label for="email">E-Posta</label>
                    <input type="email" name="email" class="form-control" v-model="personelData.email">
                </div>
                <div class="form">
                    <label for="telephone">Telefon</label>
                    <input type="text" name="telephone" class="form-control" v-model="personelData.telephone">
                </div>
                <input type="hidden" v-model="personelData.id" name="personelId">
            </template>
            <template v-slot:save><button type="button" class="btn btn-primary" @click="save">Kaydet</button></template>
        </modal>
    </div>
</template>

<script>
    import axios from "axios";
    import Modal from "./Modal";
    export default {
        name: "PersonelUpdateDelete",
        components : {
            Modal
        },
        data(){
            return {
                header : "Kullanıcı Bilgileri Güncelle Formu",
                personelList:[],
                isLoading: true,
                showModal:false,
                personelData:[],
            }
        },
        created(){
          this.getPersonelList();
        },
        methods:{
            getPersonelList(){
                axios.get(this.baseURL+"/personel-update-delete")
                    .then(response => {
                        this.personelList = response.data;
                        this.isLoading = false;
                        console.log(response.data);
                    })
            },
            deletePersonel(personelId, index) {
                axios.get(this.baseURL+"/personel-delete/"+personelId)
                    .then(response => {
                        if(response.data === "ok"){
                            this.personelList.splice(index,1);
                        }
                    })
            },
            getPersonelData(personelId){
                axios.get(this.baseURL+'/personel-data/'+personelId)
                    .then(response => {
                        this.personelData = response.data;
                        console.log(response.data);
                    })
            },
            save(){
                axios.post(this.baseURL+"/update-personel",{
                    personelId: this.personelData.id,
                    //  company: this.personelData.id, şimdilik devre dışı
                    name: this.personelData.name,
                    surname: this.personelData.surname,
                    title: this.personelData.title,
                    email: this.personelData.email,
                    telephone: this.personelData.telephone
                }).then(response => {
                    if (response.data === "ok"){
                        alert("Eklendi");
                        this.getPersonelList();
                    } else { alert("Eklenemedi.")}
                })
            }
        }
    }
</script>

<style scoped>
    .modal-mask {
        position: fixed;
        z-index: 9998;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, .5);
        display: table;
        transition: opacity .3s ease;
    }

    .modal-wrapper {
        display: table-cell;
        vertical-align: middle;
    }

    #loading { width: 100%; }
    #loadingImg {margin-left: auto; margin-right: auto; display: block;}
</style>
