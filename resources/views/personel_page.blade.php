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
        @if(session()->has('didSave'))
            @if(session()->has('didSave') == 1)
                <div class="alert alert-success" style="margin-top: 20px;">
                    <h4><i class="icon fa fa-check"></i> Personel Kaydedildi.</h4>
                </div>
            @endif
                @if(session()->has('didSave') == 0)
                    <div class="alert alert-danger" style="margin-top: 20px;">
                        <h4><i class="icon fa fa-check"></i> Personel Kaydedilemedi.</h4>
                    </div>
                @endif
        @endif
        @if ($errors->any())
            <div class="alert alert-danger" style="margin-top:10px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div id="personelForm">
            <h3>Çalışan Ekleme Formu</h3>
            <form action="{{route('personel.post.add')}}" method="POST">
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
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="form">
                    <label for="surname">Personel Soyadı</label>
                    <input type="text" name="surname" class="form-control">
                </div>
                <div class="form">
                    <label for="title">Ünvan</label>
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="form">
                    <label for="email">E-Posta</label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="form">
                    <label for="telephone">Telefon</label>
                    <input type="text" name="telephone" class="form-control">
                </div>
                <button class="btn btn-warning" type="submit">Kaydet</button>
            </form>
        </div>
    </div>
@endsection

