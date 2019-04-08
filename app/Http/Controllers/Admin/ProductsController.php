<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Product;
use App\Category;
use App\subcategory;
use Illuminate\Http\Request;
use Iluminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

class ProductsController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        if(auth()->user()->id="1"){
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $products = Product::where('title', 'LIKE', "%$keyword%")
                    ->orWhere('desc', 'LIKE', "%$keyword%")
                    ->orWhere('price', 'LIKE', "%$keyword%")
                    ->orWhere('subcategory_id', 'LIKE', "%$keyword%")
                    ->latest()->paginate($perPage);
            } else {
                $products = Product::latest()->paginate($perPage);
            }

            return view('admin.products.index', compact('products'));
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create',compact('categories'));
    }

    public function subcategories(Request $request){

        $cat_id = $request->input('cat_id');
        $subcategories = subcategory::where('category_id', '=' , $cat_id)->get();
        return Response::json($subcategories);
 
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
       // return $request->file('img');

        $this->validate($request, [
            'title' => 'required|max:10',
            'desc' => 'required|max:255',
            'price'=> 'required|numeric',
            'amount'=> 'required|numeric',

            'subcategory_id'=> 'required|not_in:0',
            'img' => 'required|image|mimes:jpeg,png,jpg|max:2048',

        ]);

        $product = new Product;
        $product->title =$request->input('title');
        $product->desc = $request->input('desc');
        $product->price = $request->input('price');
        $product->amount  = $request->input('amount');

        $product->subcategory_id = $request->input('subcategory_id');
        //saving file steps:-
            $file = $request->file('img'); //defining the input
            $productImg = time().'_'.$file->getClientOriginalExtension(); //create the name for the image
            $path = public_path().'/uploads/products/';//the path
            $file->move($path,$productImg);//saving the file with the name to
       

        $product->img = $productImg;
        $product->save();
 
       return redirect('admin/products')->with('flash_message', 'Product added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('admin.products.edit', compact('categories','product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $this->validate($request, [
            'title' => 'required|max:10',
            'desc' => 'required|max:255',
            'price'=> 'required|numeric',
            'amount'=> 'required|numeric',

        ]);
           if($request->hasfile('filename'))
                {
                    
                    $this->validate($request, [
                        'title' => 'required|max:10',
                        'img' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                    ]);

                }
        $requestData = $request->all();
        
        $product = Product::findOrFail($id);

        $product->title =$request->input('title');
        $product->desc = $request->input('desc');
        $product->price = $request->input('price');
        $product->amount  = $request->input('amount');

        if($request->input('subcategory_id')){
            $product->subcategory_id = $request->input('subcategory_id');
        }
        
        if($request->hasFile('img')){

            $file = $request->file('img'); //defining the input
            $productImg = time().'_'.$file->getClientOriginalExtension(); //create the name for the image
            $path = public_path().'/uploads/products/';//the path
            $file->move($path,$productImg);//saving the file with the name to
            $product->img = $productImg;

        }
        $product->update();

        return redirect('admin/products')->with('flash_message', 'Product updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Product::destroy($id);

        return redirect('admin/products')->with('flash_message', 'Product deleted!');
    }
}
