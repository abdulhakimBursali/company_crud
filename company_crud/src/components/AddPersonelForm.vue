<template>
    <div id="personelForm">
        <h3>Çalışan Ekleme Formu</h3>
            <div class="form">
                <label for="company">şirket</label>
                <select class="form-control" name="company" v-model="company">
                    <option disabled value="">Seçiniz</option>
                    <option  v-for="company in companies"  v-bind:value="company.id" v-bind:key="company.id" >{{company.name}}</option>
                </select>
            </div>
            <div class="form">
                <label for="name">Personel Adı</label>
                <input type="text" name="name" class="form-control" v-model="name">
            </div>
            <div class="form">
                <label for="surname">Personel Soyadı</label>
                <input type="text" name="surname" class="form-control" v-model="surname">
            </div>
            <div class="form">
                <label for="title">Ünvan</label>
                <input type="text" name="title" class="form-control" v-model="title">
            </div>
            <div class="form">
                <label for="email">E-Posta</label>
                <input type="email" name="email" class="form-control" v-model="email">
            </div>
            <div class="form">
                <label for="telephone">Telefon</label>
                <input type="text" name="telephone" class="form-control" v-model="telephone">
            </div>
            <button class="btn btn-warning" type="submit" @click="addPersonel">Kaydet</button>
    </div>
</template>

<script>
    import axios from "axios";
    export default {
        name: "AddPersonelForm",

        data(){
            return {
                companies: [], name:"", surname:"", title:"", telephone:"",company:"",email:""
            }
        },
        created() {
            this.getCompanies();
        },
        methods : {
            getCompanies() {
                axios.get(this.baseURL+'/personel-add')
                    .then(response => {
                        this.companies = response.data;
                        //console.log(this.companies);
                    })
            },
            addPersonel(){
                axios.post(this.baseURL+'/personel-add', {
                    company : this.company,
                    name : this.name,
                    surname : this.surname,
                    title : this.title,
                    telephone : this.telephone,
                    email : this.email,
                })
                    .then(response => {
                        if (response.data === "ok"){
                            alert('Eklendi.');
                        } else { alert('Eklenmedi.')}
                    })
            }
        }
    }
</script>

<style scoped>
    #personelForm { background-color:#2ecc71; width:500px; height:auto;
        padding:15px; margin:20px auto; }
    .form { margin-top: 15px; }
    input[type=text] { width:100%;}
    select { width:100%;}
    .btn-warning { margin-top: 15px; }
</style>
