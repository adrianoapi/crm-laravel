<?php

namespace App\Http\Controllers;

use App\SegundaFase;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $segundas = SegundaFase::orderBy('dt_inadimplencia', 'desc')->paginate(100);

        return view('segundaFases.index', ['title' => $title, 'segundas' => $segundas]);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SegundaFase  $segundaFase
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, SegundaFase $segundaFase)
    {
        $segundaFase->user_id          = Auth::id();
        $segundaFase->student_id       = $request->student_id;
        $segundaFase->dt_inadimplencia = $request->dt_inadimplencia;

        $segundaFase->m_parcela = $request->m_parcela;
        $segundaFase->m_parcela_pg = $request->m_parcela_pg;
        $segundaFase->m_parcela_ab = $request->m_parcela_ab;
        $segundaFase->m_parcela_valor = $request->m_parcela_valor;
        $segundaFase->m_parcela_total = $request->m_parcela_total;

        $segundaFase->s_parcela = $request->s_parcela;
        $segundaFase->s_parcela_pg = $request->s_parcela_pg;
        $segundaFase->s_parcela_ab = $request->s_parcela_ab;
        $segundaFase->s_parcela_valor = $request->s_parcela_valor;
        $segundaFase->s_parcela_total = $request->s_parcela_total;

        $segundaFase->multa = $request->multa;
        $segundaFase->total = $request->total;

        $segundaFase->save();

        return redirect()->route('segundaFase.index');
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
