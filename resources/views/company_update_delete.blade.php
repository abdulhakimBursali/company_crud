@extends('layouts.master')
@section('content')
<div class="container">
    <h1>Şirket Düzenle Sil</h1>
    <table class="table table-bordered" id="companyList">
        <thead>
        <tr>
            <th scope="col">Şirket Adı</th>
            <th scope="col">Adresi</th>
            <th scope="col">Web Adresi</th>
            {{--<th scope="col">Thumbnail</th>--}}
            <th scope="col">Düzenle</th>
            <th scope="col">Sil</th>
        </tr>
        </thead>
        <tbody>
        @foreach($companies as $company)
            @php $html = $company->web_page_source_code; @endphp
            <tr id="{{$company->id}}">
                <td>{{$company->name}}</td>
                <td>@if(count($company->adresses) > 0)
                        <ul>
                        @foreach($company->adresses as $adress)
                            <li>{{$adress->adress}}</li>
                        @endforeach
                        </ul>
                    @endif
                </td>
                <td>{{$company->internet_address}}</td>
                {{--<td></td>--}}
                <td><a href="{{route('company.updatePage', ['id' => $company->id])}}" class="btn btn-warning" >Güncelle</a></td>
                <td><button class="btn btn-danger" onclick="deleteCompany({{$company->id}})">Sil</button> </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>



















    <script>
        function deleteCompany(companyId){
            var row = document.getElementById(companyId);
        axios.post('{{route('company.delete')}}', {
                companyId: companyId,
            })
                .then(function (response) {
                    //console.log(response);
                    if (response.data === "company deleted"){
                        row.parentElement.removeChild(row);
                        alert('şirket silindi.')
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
        }

    </script>
@endsection

