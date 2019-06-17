<?php
namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ad;
use Illuminate\Http\Request;

class adsController extends Controller
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
            $ads = ad::where('img', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $ads = ad::latest()->paginate($perPage);
        }

        return view('admin.ads.index', compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.ads.create');
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
            'img' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);
        
            $file = $request->file('img'); //defining the input
            $adImg = time().'_'.$file->getClientOriginalExtension(); //create the name for the image
            $path = public_path().'/uploads/ads/';//the path
            $file->move($path,$adImg);//saving the file with the name to


         $ad = new ad;
         $ad->img = $adImg;
         $ad->save();

        return redirect('admin/ads')->with('flash_message', 'ad added!');
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
        $ad = ad::findOrFail($id);

        return view('admin.ads.show', compact('ad'));
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
        $ad = ad::findOrFail($id);

        return view('admin.ads.edit', compact('ad'));
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
        $ad = ad::findOrFail($id);


        
        $this->validate($request, [
            'img' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);
            
        if($request->hasFile('img')){
            
            
            $file = $request->file('img'); //defining the input
            $adImg = time().'_'.$file->getClientOriginalExtension(); //create the name for the image
            $path = public_path().'/uploads/ads/';//the path
            $file->move($path,$adImg);//saving the file with the name to


              $ad->img = $adImg;
              $ad->save();
            }

        return redirect('admin/ads')->with('flash_message', 'ad updated!');
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

        $ad = ad::findOrFail($id);
        $path = public_path().'/uploads/ads/'.$ad->img;//the path
        unlink($path);
        
        ad::destroy($id);

        return redirect('admin/ads')->with('flash_message', 'ad deleted!');
    }
}
