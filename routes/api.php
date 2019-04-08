<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

//Route::post('/payment/{id}','PublicController@buyProduct');
Route::post('/payment/{id}',function(){

// Set your secret key: remember to change this to your live secret key in production
    // See your keys here: https://dashboard.stripe.com/account/apikeys
    \Stripe\Stripe::setApiKey("sk_test_43FBvaCuBKkL7t3cKFhpOSkq");

    // Token is created using Checkout or Elements!
    // Get the payment token ID submitted by the form:
    $token = $_POST['stripeToken'];
    $charge = \Stripe\Charge::create([
        'amount' => 100,
        'currency' => 'usd',
        'description' => 'Example charge',
        'source' => $token,
    ]);

    dd('success');
});

