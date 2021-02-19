<?php

namespace App\Http\Controllers;

use App\Defaulting;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DefaultingController extends Controller
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
        $defaultings = Defaulting::orderBy('dt_inadimplencia', 'desc')->paginate(100);

        return view('defaultings.index', ['title' => $title, 'defaultings' => $defaultings]);
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

        return view('defaultings.add', ['students' => $students, 'title' => $title]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $segundaFase = new Defaulting();
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

        return redirect()->route('defaultings.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Defaulting  $defaulting
     * @return \Illuminate\Http\Response
     */
    public function show(Defaulting $defaulting)
    {
        $title = $this->title. " negociar";

        return view('defaultings.show', ['title' => $title, 'defaulting' => $defaulting]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Defaulting  $defaulting
     * @return \Illuminate\Http\Response
     */
    public function edit(Defaulting $defaulting)
    {
        $title = $this->title. " alterar";
        $students = Student::where('active', true)->orderBy('name', 'asc')->paginate(100);

        return view('defaultings.edit', ['title' => $title, 'students' => $students, 'defaulting' => $defaulting]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Defaulting  $defaulting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Defaulting $defaulting)
    {
        $defaulting->student_id       = $request->student_id;
        $defaulting->dt_inadimplencia = $request->dt_inadimplencia;

        $defaulting->m_parcela = $request->m_parcela;
        $defaulting->m_parcela_pg = $request->m_parcela_pg;
        $defaulting->m_parcela_ab = $request->m_parcela_ab;
        $defaulting->m_parcela_valor = $request->m_parcela_valor;
        $defaulting->m_parcela_total = $request->m_parcela_total;

        $defaulting->s_parcela = $request->s_parcela;
        $defaulting->s_parcela_pg = $request->s_parcela_pg;
        $defaulting->s_parcela_ab = $request->s_parcela_ab;
        $defaulting->s_parcela_valor = $request->s_parcela_valor;
        $defaulting->s_parcela_total = $request->s_parcela_total;

        $defaulting->multa = $request->multa;
        $defaulting->total = $request->total;

        $defaulting->save();

        return redirect()->route('defaultings.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Defaulting  $defaulting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Defaulting $defaulting)
    {
        $defaulting->delete();
        return redirect()->route('defaultings.index');
    }
}
