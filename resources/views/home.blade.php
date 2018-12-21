@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
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

    </div>
</div>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script>
    $(document).ready(function(){
        getCalon()
    })

    function notification(message)
    {
        swal({
            title: message,
            type: "success",
            confirmButtonText: "Yes!",
        },
        function() {
            getCalon()   
        });
    }

    function setListener()
    {

        $('.btn-vote').on('click',function(){
            let id =  $(this).attr('calon-id')
            swal({
                    title: "Apakah kamu sudah yakin memilih calon ini ?",
                    type: "warning",
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes!",
                    showCancelButton: true,
                },
                function() {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "post",
                        url: "{{url('vote')}}",
                        data : {'calon_id' : id},
                        success: function (data) {
                            notification(data['message']);
                        }         
                    });
                });
        })
    }

    function getCalon()
    {
        $.ajax({
            headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
            type:'GET',
            url: "{{url('calon')}}",
            success: function(data)
            {
                $('.data-calon').html(data)
                setListener()
            }
        })
    }
</script>
@endsection