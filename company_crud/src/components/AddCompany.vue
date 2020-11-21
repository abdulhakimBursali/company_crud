<template>
    <div class="addCompany">
        <h1>Yeni Şirket Ekleme Formu</h1>
        <div class="form">
            <label for="company_name">Şirket Adı</label> <input type="text" v-model="companyName" name="company_name" id="company_name" class="form-control">
        </div>
        <div class="form">
            <div id="locationField">
                <label for="autocomplete">Şirket Adresi</label>
                <button class="btn btn-danger btn-sm" @click="newField">Yeni Alan Ekle +</button>
                <div class="adresses" v-for="(input, index) in  inputs" v-bind:key="index">
                    <input id="autocomplete" name="adress_field[]" onFocus="geolocate()" type="text" class="adress form-control"/>
                </div>
                <div id="deleteFields" v-show="inputs.length > 1">
                     <button class="btn btn-warning btn-sm" @click="deleteField(index)">Alan Sil -</button>
                     <hr id="hr">
                </div>
            </div>
        </div>
        <div class="form">
            <label for="companyWebAdress">Web Adresi</label>
            <input type="text" name="companyWebAdress"  v-model="webAdress"  id="companyWebAdress" class="form-control">
        </div>
        <br><button class="btn btn-primary" @click="addCompany"> Ekle</button>
    </div>
</template>
<script>
    import axios from "axios";
    export default {
        name: "AddCompany",
        data(){
            return {
                companyName: "",
                webAdress: "",
                inputs: [{name:""}],
            }
        },
        methods: {
            newField(){
                this.inputs.push({name:""});
                console.log(this.inputs);
            },
            deleteField(index){
                this.inputs.splice(index, 1);
            },
            addCompany(){
                let inputValues = "";
                let input = document.getElementsByName('adress_field[]');
                for(var i = 0; i < input.length; i++){
                    var element = input[i];
                    inputValues = inputValues + "#" + element.value;
                }
                axios.post(this.baseURL+"/company-add", {
                        companyName: this.companyName,
                        webAdres: this.webAdress,
                        companyAdresses: inputValues
                })
                    .then(response => {
                        if (response.data === "company added"){ alert('Şirket Eklendi')} else { alert('Şirket Eklenemedi.')}
                        console.log(response.data);
                    });
            }
        }
    }
</script>

<style scoped>
    .addCompany { width:500px; height:auto; background-color:#1abc9c; padding:15px; margin:20px auto;}
    input[type=text] { width:100%;}
    .form { margin-top: 15px; }
    .btn-primary { margin-top: 10px; }
    .btn-sm { float: right; }
    .anotherAdresses > input[type=text] { margin-top:10px;}
    .adressFields { margin-top: 15px; }
    #autocomplete { margin-top: 15px; padding-right: 40px;}
    .btn-warning { margin-top: 10px;   margin-bottom: 10px;}
    #hr { clear: right; }
</style>
