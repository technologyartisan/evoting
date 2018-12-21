@extends('layouts.app')
@section('css')
<style>
    .image-calon {
        height: 200px
    }
    .list-calon {
        padding:10px;
        margin:25px
    }
    .img-logo {
        width: 80px;
        display : block;
        margin : auto;
    }
    .title-center {
        width: 100%;
        display : block;
        margin : auto;
    }
</style>
@endsection
@section('content')
<div class="container">
    <img class="img-logo" src="{{asset('tecart.png')}}">
        <center>
            <h3 class="title-center">Pemilihan Ketua TecArt Periode 2019</h3>
        </center>
    <div class="data-calon row justify-content-center">
        @foreach($vote as $value)
        <div class="list-calon card" style="width: 15rem;">
        <img class="image-calon card-img-top" src="{{asset("foto/$value->foto")}}" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">{{$value->name}}</h5>
            </div>
            <h6 style="text-align:center" class="card-footer">{{$value->results}} ({{$value->persen}}%)</h5>
        </div>
        @endforeach
    </div>
</div>
@endsection
@section('scripts')
    
@endsection