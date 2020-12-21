<?php

namespace App\Http\Controllers\Admin;

use App\Discount;
use App\Http\Controllers\Controller;
use App\Rules\checkNull;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $discounts = Discount::latest()->paginate(30);
        return view('admin.discount.all' , compact('discounts'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('admin.discount.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
//        return $request->all();
        $validated = $request->validate([
            'code' => 'required|unique:discounts,code',
            'percent' => 'required|integer|between:1,99',
            'users' => 'nullable|array',
            'number_discount_fixed' => 'nullable',
            'max_discount_price' => 'nullable',
            'products' => 'nullable|array',
            'categories' => 'nullable|array',
            'expired_at' => 'required'
        ]);

        $discount = Discount::create($validated);

        if($request->max_discount_price != null){
            $discount->forceFill([
                'max_discount_price' => $request->max_discount_price
            ])->save();
        }

        if($request->number_discount_fixed != null){
            $discount->forceFill([
                'number_discount_fixed' => $request->number_discount_fixed,
            ])->save();
        }

        if($validated['users'][0] != 'null'){
            $discount->users()->attach($validated['users']);
        }

        if($validated['products'][0] != 'null'){
            $discount->products()->attach($validated['products']);
        }

        if($validated['categories'][0] != 'null'){
            $discount->categories()->attach($validated['categories']);
        }

        alert()->success('ثبت کد با موفقیت انجام شد ');
        return redirect(route('admin.discount.index'));
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Discount $discount)
    {
        return view('admin.discount.edit' , compact('discount'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Discount $discount)
    {
        $validated = $request->validate([
            'code' => 'required',
            'percent' => 'required|integer|between:1,99',
            'users' => 'nullable|array',
            'number_discount_fixed' => 'nullable',
            'max_discount_price' => 'nullable',
            'products' => 'nullable|array',
            'categories' => 'nullable|array',
            'expired_at' => 'required'
        ]);

        $discount->update($validated);

        if($request->max_discount_price != null){
            $discount->forceFill([
                'max_discount_price' => $request->max_discount_price
            ])->save();
        }

        if($request->number_discount_fixed != null){
            $discount->forceFill([
                'number_discount_fixed' => $request->number_discount_fixed,
            ])->save();
        }else{
            $discount->forceFill([
                'number_discount_fixed' => -1,
            ])->save();
        }

        if($validated['users'][0] != 'null'){
            $discount->users()->sync($validated['users']);
        }else{
            $discount->users()->detach();
        }

        if($validated['products'][0] != 'null'){
            $discount->products()->sync($validated['products']);
        }else{
            $discount->products()->detach();
        }

        if($validated['categories'][0] != 'null'){
            $discount->categories()->sync($validated['categories']);
        }else{
            $discount->categories()->detach();
        }

//        isset($validated['users'])
//            ? $discount->users()->sync($validated['users'])
//            : $discount->users()->detach();
//
//        isset($validated['products'])
//            ? $discount->products()->sync($validated['products'])
//            : $discount->products()->detach();
//
//        isset($validated['categories'])
//            ? $discount->categories()->sync($validated['categories'])
//            : $discount->categories()->detach();


        alert()->success('ویرایش با موفقیت انجام شد ');
        return redirect(route('admin.discount.index'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Discount $discount)
    {
       $discount->delete();
        alert()->success('حذف با موفقیت انجام شد ');
        return redirect(route('admin.discount.index'));
    }
}
