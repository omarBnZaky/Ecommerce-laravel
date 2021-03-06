<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\subcategory;
use App\Category;

use Illuminate\Http\Request;

class subcategoriesController extends Controller
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
        if(auth()->user()->id==1){

                $keyword = $request->get('search');
                $perPage = 25;

                if (!empty($keyword)) {
                    $subcategories = subcategory::where('name', 'LIKE', "%$keyword%")
                        ->orWhere('category_id', 'LIKE', "%$keyword%")
                        ->latest()->paginate($perPage);
                } else {
                    $subcategories = subcategory::latest()->paginate($perPage);
                }

                return view('admin.subcategories.index', compact('subcategories'));
            
        }else{
            return redirect('/');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        if(auth()->user()->id==1){

                $categories = Category::all();

                return view('admin.subcategories.create',compact('categories'));
        }else{
            return redirect('/');
        }
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

        $this->validate($request, [
            'name' => 'required',
        ]);
        
        $requestData = $request->all();
        
        subcategory::create($requestData);

        return redirect('admin/subcategories')->with('flash_message', 'subcategory added!');
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
        if(auth()->user()->id==1){

            $subcategory = subcategory::findOrFail($id);

            return view('admin.subcategories.show', compact('subcategory'));
        }else{
            return redirect('/');
        }
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
        if(auth()->user()->id==1){

            $categories = Category::all();
            $subcategory = subcategory::findOrFail($id);

            return view('admin.subcategories.edit', compact('subcategory','categories'));

        }else{
            return redirect('/');
        }
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
        
        $requestData = $request->all();
        
        $subcategory = subcategory::findOrFail($id);
        $subcategory->update($requestData);

        return redirect('admin/subcategories')->with('flash_message', 'subcategory updated!');
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
        $subcategory = subcategory::findOrFail($id);

        
        foreach($subcategory->products as $product){
            $product->delete();
        }

        subcategory::destroy($id);


        return redirect('admin/subcategories')->with('flash_message', 'subcategory deleted!');
    }
}
