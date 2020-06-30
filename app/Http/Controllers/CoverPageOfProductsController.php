<?php

namespace App\Http\Controllers;

use App\CoverPageOfProducts;
use Illuminate\Http\Request;

class CoverPageOfProductsController extends Controller
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
        $cov = [
            'product_id'=> $request->product_id,
            'image_id'=> $request->image_id,
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CoverPageOfProducts  $coverPageOfProducts
     * @return \Illuminate\Http\Response
     */
    public function show(CoverPageOfProducts $coverPageOfProducts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CoverPageOfProducts  $coverPageOfProducts
     * @return \Illuminate\Http\Response
     */
    public function edit(CoverPageOfProducts $coverPageOfProducts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CoverPageOfProducts  $coverPageOfProducts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CoverPageOfProducts $coverPageOfProducts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CoverPageOfProducts  $coverPageOfProducts
     * @return \Illuminate\Http\Response
     */
    public function destroy(CoverPageOfProducts $coverPageOfProducts)
    {
        //
    }
}
