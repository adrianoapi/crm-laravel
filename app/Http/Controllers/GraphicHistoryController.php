<?php

namespace App\Http\Controllers;

use App\graphicHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GraphicHistoryController extends Controller
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
        $model = new GraphicHistory();
        $model->user_id = Auth::id();
        $model->graphic_id = $request->graphic_id;
        $model->observacao = $request->observacao;
        if($model->save())
        {
            return response()->json([
                'status' => true,
                'attributes' => $model->getAttributes()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\graphicHistory  $graphicHistory
     * @return \Illuminate\Http\Response
     */
    public function show(graphicHistory $graphicHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\graphicHistory  $graphicHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(graphicHistory $graphicHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\graphicHistory  $graphicHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, graphicHistory $graphicHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\graphicHistory  $graphicHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(graphicHistory $graphicHistory)
    {
        //
    }
}
