<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Product;
use App\Category;
use App\subcategory;
use App\ad;

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

        $categories = Category::all();
        $ads = ad::all();

        return view('public.index', compact('products','categories','ads'));
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
        $categories = Category::all();
       // return $allProducts;
        return view('public.show-product', compact('product','subCatProducts','allProducts','categories'));
    }

  

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */

    public function  payment_page(Request $request,$id){
       // return $id;
       $product = Product::findOrFail($id);

       $this->validate($request, [
        'amount'=> 'required|max:'.$product->amount.'|numeric',
        ]);
        $amount = $request->input('amount');
        $total =  $product->price *  $amount;
        $categories = Category::all();

       return view('public.paymnet', compact('product','amount','total','categories'));

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



     public function show_cat_products($id){

        $category = Category::findOrFail($id);
        $categories = Category::all();

        return view('public.category', compact('category','categories'));

     }




     public function show_subCat_products($id){

        $subcategory = subcategory::findOrFail($id);



        $categories = Category::all();

        return view('public.subcategory', compact('subcategory','categories'));

     }


    /*
    public function destroy($id)
    {
        Product::destroy($id);

        return redirect('public/public')->with('flash_message', 'Product deleted!');
    }*/
}

