@extends('layouts.master')
@section('css')

@endsection
@section('content')
    <div class="container">
        <h1>Şirket Düzenle</h1>
        <table class="table table-bordered">
            <tbody>
            <tr>
                <th scope="col">Şirket Adı</th>
                <th scope="col"><input type="text" id="company_name" value="{{$company->name}}"></th>
            </tr>
            <tr>
                <th scope="col">İnternet Adresi</th>
                <th scope="col"><input type="text" id="companyWebAdress" value="{{$company->internet_address}}"></th>
            </tr>

            <tr>
                <th scope="col">Adresleri</th>
                <td>
                    <ul id="adressList">
                       @php $child =0; @endphp
                    @foreach($company->adresses as $adress)
                             <li id="{{$adress->id}}" style="margin-top: 5px;">{{$adress->adress}} <button class="btn btn-danger btn-sm" onclick="deleteAdress({{$adress->id}})">Sil</button></li>
                            @php $child++; @endphp
                    @endforeach
                    </ul>
                </td>
            </tr>

            </tbody>
        </table>
        <button class="btn btn-primary" onclick="update()">Güncelle</button>
    </div>
@endsection
<!-- Update Modal -->

@section('js')
    <script>
        function update(){
            var companyName = document.getElementById('company_name').value;
            var companyWebAdress = document.getElementById('companyWebAdress').value;
            axios.post('{{route('company.update')}}', {
                companyName: companyName,
                webAdres: companyWebAdress,
                companyId: {{$company->id}}
            })
                .then(function (response) {
                    // console.log(response);
                    if (response.data === "company updated"){
                        alert('Şirket bilgisi güncellendi.')
                    }else { alert('Bir hata oluştu.')}
                })
                .catch(function (error) {
                    console.log(error);
                });
        }
        /* Delete Adress */
        function deleteAdress(id) {
            var adressId = id;
            var adressList = document.getElementById('adressList');
            axios.post('{{route('company.adressDelete')}}', {
                adressId: adressId
            })
                .then(function (response) {
                    // console.log(response);
                    if (response.data === "adress deleted"){
                        // adressList.removeChild(adressList.childNodes[childElement]);
                        document.getElementById(adressId).style.display = "none";
                        alert(childElement + 'Adres Silindi.');
                    }else { alert('Bir hata oluştu.')}
                })
                .catch(function (error) {
                    console.log(error);
                });
        }






    </script>
@endsection

