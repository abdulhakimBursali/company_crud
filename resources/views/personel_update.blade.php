@extends('layouts.master')
@section('css')
    #personelForm { background-color:#2ecc71; width:500px; height:auto;
    padding:15px; margin:20px auto; }
    .form { margin-top: 15px; }
    input[type=text] { width:100%;}
    select { width:100%;}
    .btn-warning { margin-top: 15px; }
@endsection
@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div id="personelForm">
            <h3>Çalışan Bilgileri Güncelleme Forumu</h3>
            <form action="{{route('personel.update')}}" method="POST">
                @csrf
                <div class="form">
                    <label for="company">şirket</label>
                    <select class="form-control" name="company">
                        @forelse($companies as $company)
                            <option value="{{$company->id}}">{{$company->name}}</option>
                        @empty
                            <option>Şirket Eklenmemiş</option>
                        @endforelse
                    </select>
                </div>
                <div class="form">
                    <label for="name">Personel Adı</label>
                    <input type="text" name="name" class="form-control" value="{{$personel->name}}">
                </div>
                <div class="form">
                    <label for="surname">Personel Soyadı</label>
                    <input type="text" name="surname" class="form-control" value="{{$personel->surname}}">
                </div>
                <div class="form">
                    <label for="title">Ünvan</label>
                    <input type="text" name="title" class="form-control" value="{{$personel->title}}">
                </div>
                <div class="form">
                    <label for="email">E-Posta</label>
                    <input type="email" name="email" class="form-control" value="{{$personel->email}}">
                </div>
                <div class="form">
                    <label for="telephone">Telefon</label>
                    <input type="text" name="telephone" class="form-control" value="{{$personel->telephone}}">
                </div>
                <input type="hidden" value="{{$personel->id}}" name="personelId">
                <button class="btn btn-warning" type="submit">Kaydet</button>
            </form>
        </div>
    </div>
@endsection

