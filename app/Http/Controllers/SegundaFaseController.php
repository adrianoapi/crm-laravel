<?php

namespace App\Http\Controllers;

use App\SegundaFase;
use App\Student;
use Illuminate\Http\Request;

class SegundaFaseController extends Controller
{
    private $title  = 'Segunda Fase';

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

        return view('segundaFases.index', ['title' => $title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = $this->title. " cadastrar";
        $students = Student::where('active', true)->orderBy('name', 'asc')->paginate(100);

        return view('segundaFases.add', ['students' => $students, 'title' => $title]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SegundaFase  $segundaFase
     * @return \Illuminate\Http\Response
     */
    public function show(SegundaFase $segundaFase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SegundaFase  $segundaFase
     * @return \Illuminate\Http\Response
     */
    public function edit(SegundaFase $segundaFase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SegundaFase  $segundaFase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SegundaFase $segundaFase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SegundaFase  $segundaFase
     * @return \Illuminate\Http\Response
     */
    public function destroy(SegundaFase $segundaFase)
    {
        //
    }
}
