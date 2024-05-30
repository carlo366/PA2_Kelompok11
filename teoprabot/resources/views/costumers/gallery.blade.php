@extends('costumers.layouts.template')
@section('main-content')
@section('css')
<style>

.container__items {
display: flex;
justify-content: center;
align-items: center;
flex-wrap: wrap;
}
.polaroid {
margin: 30px;
width: 250px;
height: 350px;
background-color: white;
padding: 1rem;
box-shadow: 0 0.2rem 1.2rem rgba(0, 0, 0, 0.2);
}
.polaroid__content-image {
height: 250px;
width: 100%;
overflow: hidden;
}
.polaroid__content-image > img {
height: 100%;
width: 100%;
display: block;
object-fit: cover;
}
.polaroid__content-caption {
display: flex;
justify-content: center;
align-items: center;
font-size: 25px;
}
</style>
@endsection
<div class="container">
<div class="container__items">
@foreach ($gallery as $gal)

<div class="polaroid one">
    <div class="polaroid__content">
        <div class="polaroid__content-image">
            <img src='{{asset($gal->image)}}' alt=''>
        </div>
        <div class="polaroid__content-caption">
            <p>{{$gal->name}}</p>
        </div>
    </div>
</div>
@endforeach

</div>
</div>

@endsection
@section('js')
<script>
    var polaroids = document.querySelectorAll('.polaroid');
polaroids.forEach(item => {
const randomRotation = Math.floor(Math.random() * (6 - -6 + 1) + -6);
item.style.transform = `rotate(${randomRotation}deg)`
})
</script>
@endsection
