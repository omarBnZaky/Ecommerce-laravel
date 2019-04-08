@extends('layouts.public')
@section('content')
<div class="col-lg-9">
<div class="card mb-4" style="max-width: 540px;">
  <div class="row no-gutters">
    <div class="col-md-4">
      <img src="/uploads/products/{{ $product->img }}" class="card-img" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title">Product name:{{ $product->title }} </h5>
        <p class="card-text">Price:${{ $product->price }}</p>
        <p class="card-text">Description:{!!  $product->desc !!}.</p>
        <p class="card-text"><small class="text-muted">  {{ $product->created_at->diffForHumans() }}</small></p>
    <!-- STRIPE FORM -->
  <a href="/payment/{{$product->id}}">      
          <div class="btn btn-success">
                  Buy {{ $product->title }}
            </div>
         </a>
    <!-- END STRIPE -->

      </div>
    </div>
  </div>
</div>
</div>
</div>
        <div class= "py-3 bg-info">
              <p class="m-0 text-center text-white">Other products</p>
            </div>
            <br>
    <div class="row">
   @if(count($subCatProducts) > 0)
      @foreach($subCatProducts as $singleCatproduct)
      <div class="col-lg-4 col-md-6 mb-4">
          <div class="card h-100">
          <a href="#"><img class="card-img-top" src="/uploads/products/{{ $singleCatproduct->img }}"width="300" height="300" alt=""></a>
          <div class="card-body">
              <h4 class="card-title">
              <a href="#">Item One</a>
              </h4>
              <h5>${{ $singleCatproduct->price }}</h5>
              <p class="card-text">{!!  $singleCatproduct->desc !!}</p>
          </div>
          <div class="card-footer">
              <a href="/product/{{ $singleCatproduct->id }}" >   <div class="btn btn-info">Show Item</div> </a>
          </div>
          </div>
      </div>
      @endforeach
    @else 
      @foreach($allProducts as $singleProduct)
      <div class="col-lg-4 col-md-6 mb-4">
          <div class="card h-100">
          <a href="#"><img class="card-img-top" src="/uploads/products/{{ $singleProduct->img }}"width="300" height="300" alt=""></a>
          <div class="card-body">
              <h4 class="card-title">
              <a href="#">Item One</a>
              </h4>
              <h5>${{ $singleProduct->price }}</h5>
              <p class="card-text">{!!  $singleProduct->desc !!}</p>
          </div>
          <div class="card-footer">
              <a href="/product/{{ $singleProduct->id }}" >  <div class="btn btn-info">Show Item</div> </a>
          </div>
          </div>
      </div>
      @endforeach
     @endif  
    </div>
        <!-- /.row -->
  <!-- /.container -->
</div>
@endsection