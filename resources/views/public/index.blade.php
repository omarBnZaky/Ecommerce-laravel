@extends('layouts.public')
@section('content')

<div class="col-lg-9">

<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
 
  <ol class="carousel-indicators">
   @foreach( $ads as $ad )
      <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
   @endforeach
  </ol>
 
  <div class="carousel-inner" role="listbox">
    @foreach( $ads as $ad )
       <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
           <img class="d-block img-fluid" src="/uploads/ads/{{ $ad->img }}" alt="{{ $ad->id }}">
              
       </div>
    @endforeach
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<div class="row">
@foreach($products as $product)
  <div class="col-lg-4 col-md-6 mb-4">
    <div class="card h-100">
      <a href="#"><img class="card-img-top" src="/uploads/products/{{ $product->img }}"width="600" height="300" alt=""></a>
      <div class="card-body">
        <h4 class="card-title">
          <a href="#">Item One</a>
        </h4>
        <h5>${{ $product->price }}</h5>
        <p class="card-text">{!!  $product->desc !!}</p>
      </div>
      <div class="card-footer">
        <a href="/product/{{ $product->id }}" >   <div class="btn btn-info">Show Item</div> </a>
      </div>
    </div>
  </div>
@endforeach

  </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->



</div>
<!-- /.col-lg-9 -->

@endsection