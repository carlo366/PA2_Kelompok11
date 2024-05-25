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
<div class="polaroid one">
<div class="polaroid__content">
<div class="polaroid__content-image">
<img src='https://images.unsplash.com/photo-1544568100-847a948585b9?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=400&fit=max&ixid=eyJhcHBfaWQiOjE0NTg5fQ' alt=''>
</div>
<div class="polaroid__content-caption">
<p>the good ol' boy</p>
</div>
</div>
</div>
<div class="polaroid two">
<div class="polaroid__content">
<div class="polaroid__content-image">
<img src='https://images.unsplash.com/photo-1517423440428-a5a00ad493e8?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=400&fit=max&ixid=eyJhcHBfaWQiOjE0NTg5fQ' alt=''>
</div>
<div class="polaroid__content-caption">
<p>mr i didn't do it</p>
</div>
</div>
</div>
<div class="polaroid three">
<div class="polaroid__content">
<div class="polaroid__content-image">
<img src='https://images.unsplash.com/photo-1510771463146-e89e6e86560e?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=400&fit=max&ixid=eyJhcHBfaWQiOjE0NTg5fQ' alt=''>
</div>
<div class="polaroid__content-caption">
<p>do you want a flower?</p>
</div>
</div>
</div>
<div class="polaroid four">
<div class="polaroid__content">
<div class="polaroid__content-image">
<img src='https://images.unsplash.com/photo-1507146426996-ef05306b995a?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=400&fit=max&ixid=eyJhcHBfaWQiOjE0NTg5fQ' alt=''>
</div>
<div class="polaroid__content-caption">
<p>im cute and i know it</p>
</div>
</div>
</div>
<div class="polaroid five">
<div class="polaroid__content">
<div class="polaroid__content-image">
<img src='https://images.unsplash.com/photo-1530281700549-e82e7bf110d6?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=400&fit=max&ixid=eyJhcHBfaWQiOjE0NTg5fQ' alt=''>
</div>
<div class="polaroid__content-caption">
<p>let's play!</p>
</div>
</div>
</div>
<div class="polaroid six">
<div class="polaroid__content">
<div class="polaroid__content-image">
<img src='https://images.unsplash.com/photo-1548199973-03cce0bbc87b?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=400&fit=max&ixid=eyJhcHBfaWQiOjE0NTg5fQ' alt=''>
</div>
<div class="polaroid__content-caption">
<p>nothin' can stop us!</p>
</div>
</div>
</div>
<div class="polaroid seven">
<div class="polaroid__content">
<div class="polaroid__content-image">
<img src='https://images.unsplash.com/photo-1552053831-71594a27632d?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=400&fit=max&ixid=eyJhcHBfaWQiOjE0NTg5fQ' alt=''>
</div>
<div class="polaroid__content-caption">
<p>please forgive me?</p>
</div>
</div>
</div>
<div class="polaroid eight">
<div class="polaroid__content">
<div class="polaroid__content-image">
<img src='https://images.unsplash.com/photo-1518717758536-85ae29035b6d?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=400&fit=max&ixid=eyJhcHBfaWQiOjE0NTg5fQ' alt=''>
</div>
<div class="polaroid__content-caption">
<p>i give you kiss? plz?</p>
</div>
</div>
</div>
<div class="polaroid nine">
<div class="polaroid__content">
<div class="polaroid__content-image">
<img src='https://images.unsplash.com/photo-1535930891776-0c2dfb7fda1a?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=400&fit=max&ixid=eyJhcHBfaWQiOjE0NTg5fQ' alt=''>
</div>
<div class="polaroid__content-caption">
<p>study buddy</p>
</div>
</div>
</div>
<div class="polaroid ten">
<div class="polaroid__content">
<div class="polaroid__content-image">
<img src='https://images.unsplash.com/photo-1504595403659-9088ce801e29?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=400&fit=max&ixid=eyJhcHBfaWQiOjE0NTg5fQ' alt=''>
</div>
<div class="polaroid__content-caption">
<p>we're glad ur home!</p>
</div>
</div>
</div>
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
