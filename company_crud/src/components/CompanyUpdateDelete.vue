<template>
    <div class="container">
        <h1>Şirket Düzenle Sil</h1>
        <table class="table table-bordered" id="companyList">
            <thead>
            <tr>
                <th scope="col">Şirket Adı</th>
                <th scope="col">Adresi</th>
                <th scope="col">Web Adresi</th>
                <th scope="col">Thumbnail</th>
                <th scope="col">Düzenle</th>
                <th scope="col">Sil</th>
            </tr>
            </thead>
            <tbody>
            <tr id="" v-for="(item, index) in companyList" v-bind:key="index">
                <td>{{item.name}}</td>
                <td>
                    <ul>
                        <li v-for="adress in item.adresses" v-bind:key="adress">{{adress.adress}}</li>
                    </ul>
                </td>
                <td>{{item.internet_address}}</td>
                <td>Resim URL</td>
                <td><a href="" class="btn btn-warning" @click="getCompanyData(item.id)" data-toggle="modal" data-target="#exampleModal">Güncelle</a></td>
                <td><button class="btn btn-danger" @click="deleteCompany(item.id, index)">Sil</button> </td>
            </tr>
            </tbody>
        </table>
        <div id="loading"><img v-if="isLoading" id="loadingImg" src="../assets/loading.gif"></div>
        <!--<h3>{{company[0].name}}</h3>-->
        <!--<h3>{{company[0].internet_address}}</h3>-->
        <!--<div v-for="(adres, index) in company[0].adresses" v-bind:key="index">-->
            <!--<h3>{{adres.adress}}</h3>-->
        <!--</div>-->
        <modal :header="header">
            <template v-slot:body>
                <div class="form">
                    <label for="company_name">Şirket Adı</label> <input type="text" v-model="companyName" name="company_name" id="company_name" class="form-control">
                </div>
                <table class="table table-bordered">
                    <caption style="caption-side:top; text-align:center">Önceden Eklenmiş adresler</caption>
                    <tr v-for="(adress, index) in company[0].adresses" v-bind:key="index">
                        <td>{{adress.adress}}</td>
                        <td><span @click="deleteAdress(adress.id,index)" id="deleteAdress">Sil</span></td>
                    </tr>
                </table>
                <div class="form">
                    <div id="locationField">
                        <label for="autocomplete">Şirket Adresi</label>
                        <button class="btn btn-danger btn-sm" id="newAdress" @click="newField">Yeni Adres Ekle +</button>
                        <div class="adresses" v-for="(input, index) in  inputs" v-bind:key="index">
                            <input id="autocomplete" name="adress_field[]" onFocus="geolocate()" type="text" class="adress form-control"/>
                        </div>
                        <div id="deleteFields" v-show="inputs.length > 1">
                            <button class="btn btn-warning btn-sm" id="deleteAdressField" @click="deleteField(index)">Alan Sil -</button>
                            <hr id="hr">
                        </div>
                    </div>
                </div>
                <div class="form">
                    <label for="companyWebAdress">Web Adresi</label>
                    <input type="text" name="companyWebAdress"  v-model="webAdress"  id="companyWebAdress" class="form-control">
                </div>
            </template>
            <template v-slot:save><button type="button" class="btn btn-primary" @click="updateCompany">Kaydet</button></template>
        </modal>
    </div>
</template>

<script>
   import axios from "axios";
   import Modal from "./Modal";
    export default {
        name: "CompanyUpdateDelete",
        components :{
          Modal
        },
        data () {
            return {
                header: "Şirket Bilgileri Güncelleme Formu",
                companyList : [],
                companyData : [],
                isLoading : true,
                companyId: "",
                company:"",
                inputs: [{name:""}],
                companyName:"",
                webAdress:"",
            }
        },
        created(){
            this.fetchData();
        },
        methods : {
            fetchData(){
                axios.get(this.baseURL+"/company-update-delete")
                    .then(response => {
                        this.companyList = response.data;
                        console.log(response.data);
                        this.isLoading = false;
                    });
           },
            getCompanyData(companyId){
                this.company = this.companyList.filter(company => company.id === companyId);
               //console.log("BURDA"+this.company[0].adresses[0].adress);
                this.companyName = this.company[0].name;
                this.webAdress =this.company[0].internet_address;
            },
            newField(){
                this.inputs.push({name:""});
                console.log(this.inputs);
            },
            deleteField(index){
                this.inputs.splice(index, 1);
            },
            deleteAdress(adressId,index){
                axios.post(this.baseURL+"/delete-adress", {
                    adressId: adressId
                }).then(response => {
                    if (response.data === "ok"){
                        this.company[0].adresses.splice(index,1);
                    }
                });
            },
            updateCompany(){
                let inputValues = "";
                let input = document.getElementsByName('adress_field[]');
                for(var i = 0; i < input.length; i++){
                    var element = input[i];
                    inputValues = inputValues + "#" + element.value;
                }
                axios.post(this.baseURL+"/company-update", {
                    companyId: this.company[0].id,
                    companyName: this.companyName,
                    webAdres: this.webAdress,
                    companyAdresses: inputValues
                })
                    .then(response => {
                        if (response.data === "company updated"){ alert('Şirket Bilgileri Güncellendi'); this.fetchData();} else { alert('Şirket Bilgileri Güncellenemedi.')}
                    })
            },
            deleteCompany(companyId,index){
                axios.post(this.baseURL+"/company-delete",{
                    companyId:companyId
                }).then(response => {
                    if (response.data==="company deleted"){ this.companyList.splice(index,1)}
                })
            }

        }
    }
</script>

<style scoped>
    .addCompany { width:500px; height:auto; background-color:#1abc9c; padding:15px; margin:20px auto;}
    input[type=text] { width:100%;}
    .form { margin-top: 15px; }
    .anotherAdresses > input[type=text] { margin-top:10px;}
    .adressFields { margin-top: 15px; }
    #autocomplete { margin-top: 15px; padding-right: 40px;}
    #hr { clear: right; }
    #deleteAdress { text-decoration:underline; color:navy; cursor: pointer;}
    #newAdress { float: right;}
    #deleteAdressField { float: right; margin-top:10px; margin-bottom:10px;}
    #loading { width: 100%; }
    #loadingImg {margin-left: auto; margin-right: auto; display: block;}
</style>

