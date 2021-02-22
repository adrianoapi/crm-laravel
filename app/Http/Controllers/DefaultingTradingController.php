<?php

namespace App\Http\Controllers;

use App\DefaultingTrading;
use Illuminate\Http\Request;

class DefaultingTradingController extends Controller
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
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DefaultingTrading  $defaultingTrading
     * @return \Illuminate\Http\Response
     */
    public function show(DefaultingTrading $defaultingTrading)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DefaultingTrading  $defaultingTrading
     * @return \Illuminate\Http\Response
     */
    public function edit(DefaultingTrading $defaultingTrading)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DefaultingTrading  $defaultingTrading
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DefaultingTrading $defaultingTrading)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DefaultingTrading  $defaultingTrading
     * @return \Illuminate\Http\Response
     */
    public function destroy(DefaultingTrading $defaultingTrading)
    {
        //
    }
}
