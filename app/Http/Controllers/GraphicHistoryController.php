<?php

namespace App\Http\Controllers;

use App\GraphicHistory;
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
            $hora = date('Y-m-d H:i:s', strtotime("$model->created_at -180 minutes"));
            return response()->json([
                'status' => true,
                'attributes' => $model->getAttributes(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GraphicHistory  $GraphicHistory
     * @return \Illuminate\Http\Response
     */
    public function show(GraphicHistory $GraphicHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GraphicHistory  $GraphicHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(GraphicHistory $GraphicHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GraphicHistory  $GraphicHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GraphicHistory $GraphicHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GraphicHistory  $GraphicHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(GraphicHistory $GraphicHistory)
    {
        //
    }
}
