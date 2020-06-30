<?php

namespace App\Http\Controllers;

use App\ProductsInShoppingCart;
use Illuminate\Http\Request;

class ProductsInShoppingCartController extends Controller
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
            'sc_id' => $request->sc_id,
            'quantity' => $request->quantity,
            'subtotal' => $request->subtotal,
        ];
        if(ProductInShoppingCart::create($order)){
            return 200;
        }else{
            return 400;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductsInShoppingCart  $productsInShoppingCart
     * @return \Illuminate\Http\Response
     */
    public function show(ProductsInShoppingCart $productsInShoppingCart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductsInShoppingCart  $productsInShoppingCart
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductsInShoppingCart $productsInShoppingCart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductsInShoppingCart  $productsInShoppingCart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductsInShoppingCart $productsInShoppingCart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductsInShoppingCart  $productsInShoppingCart
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProductsInShoppingCart::destroy($id);
        return 200;
    }
}
