@extends('layouts.public')
@section('content')
<div class="col-lg-9">

<form action="/api/payment/{{$product->id}}" method="post" id="payment-form">
         
         <div id="card-element">
           <!-- A Stripe Element will be inserted here. -->
         </div>

         <!-- Used to display Element errors. -->
         <div id="card-errors" role="alert" class="text-danger"></div>
   <br>
       <button class="btn btn-success">Submit Payment</button>
     </form>
  </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->



</div>
<!-- /.col-lg-9 -->



@endsection