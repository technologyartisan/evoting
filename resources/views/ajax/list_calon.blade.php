@foreach($calon as $value)
<div class="list-calon card" style="width: 15rem;">
    <img class="image-calon card-img-top" src="{{asset("foto/$value->foto")}}" alt="Card image cap">
    <div class="card-body">
        <h5 class="card-title">{{$value->name}}</h5>
    </div>
    @if(is_null(Auth::user()->calon_id) || Auth::user()->calon_id == "0")
        <a href="#" calon-id="{{$value->id}}" class="btn-vote btn btn-block btn-primary">Vote</a>
    @else
        <a href="#" class="disabled btn-vote btn btn-block btn-success">Kamu Sudah Voting</a>
    @endif
</div>
@endforeach