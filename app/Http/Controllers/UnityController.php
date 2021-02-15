<?php

namespace App\Http\Controllers;

use App\Unity;
use Illuminate\Http\Request;

class UnityController extends Controller
{
    private $title  = 'Unidades';

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = $this->title. " listagem";
        $unities = Unity::where('active', true)->orderBy('name', 'asc')->paginate(100);

        return view('unities.index', ['title' => $title, 'unities' => $unities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = $this->title. " cadastar";

        return view('unities.add', ['title' => $title]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = new Unity();
        $model->name      = $request->name;
        $model->active    = true;
        $model->save();

        return redirect()->route('unidades.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Unity  $unity
     * @return \Illuminate\Http\Response
     */
    public function show(Unity $unity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Unity  $unity
     * @return \Illuminate\Http\Response
     */
    public function edit(Unity $unity)
    {
        $title = $this->title. " alterar";
        return view('unities.edit', ['title' => $title, 'unity' => $unity]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Unity  $unity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unity $unity)
    {
        $unity->name  = $request->name;
        $unity->save();

        return redirect()->route('unidades.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Unity  $unity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unity $unity)
    {
        $unity->active = false;
        $unity->save();

        return redirect()->route('unidades.index');
    }
}
