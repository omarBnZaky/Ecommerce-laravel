@extends('layouts.public')
@section('content')

<div class="col-lg-9">

  @if(count($category->subcategories)>0)
     @foreach($category->subcategories as $subcategory)

\
                 <div class="row">
                        @foreach($subcategory->products as $product)
                        <div class="col-lg-4 col-md-6 mb-4">
          <div class="card h-100">
          <a href="#"><img class="card-img-top" src="/uploads/products/{{ $product->img }}"width="300" height="300" alt=""></a>
          <div class="card-body">
              <h4 class="card-title">
              <a href="#">Item One</a>
              </h4>
              <h5>${{ $product->price }}</h5>
              <p class="card-text">{!!  $product->desc !!}</p>
          </div>
          <div class="card-footer">
              <a href="/product/{{ $product->id }}" >  <div class="btn btn-info">Show Item</div> </a>
          </div>
          </div>
      </div>
                        @endforeach
                </div>
                    <!-- /.row -->



        @endforeach

    @else
        No products in this category right now
    @endif


  </div>
  <!-- /.container -->


</div>
<!-- /.col-lg-9 -->
</div>

@endsection