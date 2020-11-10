@extends('layouts.master')
@section('css')

@endsection
@section('content')
    <div class="container">
        <h1>Çalışanlar</h1>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
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
            @forelse($personels as $personel)
                <tr id="{{$personel->id}}">
                    <td>{{$personel->name." ".$personel->surname}}</td>
                    <td>{{$personel->company->name}}</td>
                    <td>{{$personel->email}}</td>
                    <td>{{$personel->title}}</td>
                    <td>{{$personel->telephone}}</td>
                    <td><a href="{{route('personel.updatePage', ['id'=> $personel->id])}}" class="btn btn-warning">Güncelle</a></td>
                    <td><button class="btn btn-danger" onclick="deletePersonel({{$personel->id}})">Sil</button></td>
                </tr>
            @empty
                <h3>Henüz Çalışan Eklenmemiş</h3>
            @endforelse
        </table>
    </div>
@endsection
<!-- Update Modal -->

@section('js')
    <script>
        function deletePersonel(personelId){
            var row = document.getElementById(personelId);
            axios.post('{{route('personel.delete')}}', {
                personelId: personelId,
            })
                .then(function (response) {
                    //console.log(response);
                    if (response.data === "personel deleted"){
                        row.parentElement.removeChild(row);
                        alert('Personel Silindi.')
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
        }

    </script>
@endsection

