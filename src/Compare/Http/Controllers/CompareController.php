<?php

namespace Tir\Store\Compare\Http\Controllers;

use Tir\Store\Compare\Compare;
use Illuminate\Routing\Controller;
use Tir\Store\Product\Entities\Product;

class CompareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Modules\Compare\Compare $compare
     * @return \Illuminate\Http\Response
     */
    public function index(Compare $compare)
    {
        return view(config('crud.front-template').'::public.compare.index', compact('compare'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Modules\Compare\Compare $compare
     * @return \Illuminate\Http\Response
     */
    public function store(Compare $compare)
    {

       if(! $this->haveAnySameFinalCategory($compare)){
           return back()->withSuccess(trans('compare::messages.doesnt_have_same_category'));
       }


        foreach ($compare->products() as $key=>$product){
            if($key == request('product_id') ){
                return back()->withSuccess(trans('compare::messages.duplicated'));
            }
        }


        $compare->store(request('product_id'));

        return back()->withSuccess(trans('compare::messages.added'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @param \Modules\Compare\Compare $compare
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Compare $compare)
    {
        $compare->remove($id);

        return back()->withSuccess(trans('compare::messages.removed'));
    }

    private function haveAnySameFinalCategory(Compare $compare)
    {
        if (count($compare->products()) == 0 )
            return true;

        //Final Categories ids
        //$ids =  $compare->products()->first()->categories()->doesntHave('categories')->pluck('id');

        $ids = $compare->products()->first()->categories()
            ->where('parent_id', null)->with('categories')->get()
            ->pluck('categories.*.id');

        $categories = Product::findOrfail(request('product_id'))->categories()->whereIn('id',$ids)->get();
        if(count($categories)> 0){
            return true;
        }
        return false;
    }
}
