<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
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
                        $categories = Category::where('name', 'LIKE', "%$keyword%")
                            ->latest()->paginate($perPage);
                    } else {
                        $categories = Category::latest()->paginate($perPage);
                    }

                    

                    return view('admin.categories.index', compact('categories'));


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

        return view('admin.categories.create');


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
        
        Category::create($requestData);

        return redirect('admin/categories')->with('flash_message', 'Category added!');
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

        $category = Category::findOrFail($id);

        return view('admin.categories.show', compact('category'));
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

        $category = Category::findOrFail($id);

        return view('admin.categories.edit', compact('category'));

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
        $this->validate($request, [
            'name' => 'required',
        ]);
        
        $requestData = $request->all();
        
        $category = Category::findOrFail($id);
        $category->update($requestData);

        return redirect('admin/categories')->with('flash_message', 'Category updated!');
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
        $category = Category::findOrFail($id);

        foreach($category->subcategories as $subcategory){

            foreach($subcategory->products as $product){
                $product->delete();
            }
            $subcategory->delete();

        }
        Category::destroy($id);


        return redirect('admin/categories')->with('flash_message', 'Category deleted!');
    }
}
