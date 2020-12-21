<?php

namespace App\Http\Controllers\Admin;

use App\Banner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BannersController extends Controller
{
    public function sortBannersIndex()
    {
        $banners = Banner::all();
        return view('admin.banners.all' , compact('banners'));
   }

    public function sortBannersUpdate(Request $request)
    {
        Banner::truncate();
        foreach ($request->all() as $banner){
            Banner::create([
                'url' => $banner['url'],
                'link' => $banner['link'],
            ]);
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::all();
        return view('admin.banners.gallery.all' , compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banners.gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'images.*.image' => 'required',
            'images.*.link' => '',
        ]);


        collect($validated)->each(function($item) {
            foreach ($item as $itm){
                Banner::create([
                    'url' => $itm['image'],
                    'link' => $itm['link'],
                ]);
            }
        });



        alert()->success('ثبت بنر با موفقیت انجام شد ');
        return redirect(route('admin.banners.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner )
    {
        return view('admin.banners.gallery.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        $validated = $request->validate([
            'url' => 'required',
            'link' => '',
        ]);

        $banner->update($validated);

        alert()->success('ویرایش بنر با موفقیت انجام شد ');
        return redirect(route('admin.banners.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        $banner->delete();
        alert()->success('حذف بنر با موفقیت انجام شد ');

        return redirect(route('admin.banners.index'));
    }
}
