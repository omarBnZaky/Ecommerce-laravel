<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Product;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $products = Product::latest()->paginate($perPage);
        } else {
            $products = Product::latest()->paginate($perPage);
        }

        return view('public.index', compact('products'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show_product($id)
    {
        $product = Product::findOrFail($id);
        $subCatProducts = Product::where('subcategory_id','=', $product->subcategory_id)
                                 ->where('id','!==',$product->id)
                                 ->get();

        $allProducts = Product::all();

       // return $allProducts;
        return view('public.show-product', compact('product','subCatProducts','allProducts'));
    }

  

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */

    public function  payment_page($id){
       // return $id;
       $product = Product::findOrFail($id);
        return view('public.paymnet', compact('product'));

    }


   /* public function  buyProduct($id){
        // Set your secret key: remember to change this to your live secret key in production
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        \Stripe\Stripe::setApiKey("sk_test_43FBvaCuBKkL7t3cKFhpOSkq");

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $_POST['stripeToken'];
        $charge = \Stripe\Charge::create([
            'amount' => 10000,
            'currency' => 'usd',
            'description' => 'Example charge',
            'source' => $token,
        ]);

    }
*/




    /*
    public function destroy($id)
    {
        Product::destroy($id);

        return redirect('public/public')->with('flash_message', 'Product deleted!');
    }*/
}

