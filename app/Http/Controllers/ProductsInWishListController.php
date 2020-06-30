<?php

namespace App\Http\Controllers;

use App\ProductsInWishList;
use Illuminate\Http\Request;

class ProductsInWishListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = [
            'user_id' => $request->user_id,
            'wl_id' => $request->wl_id,
        ];
        if(ProductInWishList::create($order)){
            return 200;
        }else{
            return 'Algo salió mal';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductsInWishList  $productsInWishList
     * @return \Illuminate\Http\Response
     */
    public function show(ProductsInWishList $productsInWishList)
    {
        $product= Product::find($id);
        return  $product;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductsInWishList  $productsInWishList
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductsInWishList $productsInWishList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductsInWishList  $productsInWishList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductsInWishList $productsInWishList)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductsInWishList  $productsInWishList
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProductsInWishList::destroy($id);
        return 200;
    }
}
