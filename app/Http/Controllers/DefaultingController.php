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
        $pesuisar = NULL;
        if(array_key_exists('filtro',$_GET))
        {
            if(strlen($_GET['pesquisar']))
            {
                $pesuisar = $_GET['pesquisar'];
                $students = Student::where('name', 'like', '%' . $pesuisar . '%')
                ->orderBy('name', 'asc')
                ->get();

                $ids = [];
                foreach($students as $value):
                    array_push($ids, $value->id);
                endforeach;

                $defaultings = Defaulting::whereIn('student_id', $ids)->orderBy('student_name', 'asc')->paginate(100);
            }else{
                $defaultings = Defaulting::orderBy('student_name', 'asc')->paginate(100);
            }

        }else{
            $defaultings = Defaulting::orderBy('student_name', 'asc')->paginate(100);
        }

        $title = $this->title. " listagem";

        return view('defaultings.index', ['title' => $title, 'defaultings' => $defaultings, 'pesuisar' => $pesuisar]);
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

        $segundaFase->m_parcelas = $request->m_parcelas;
        $segundaFase->m_parcela_pg = $request->m_parcela_pg;
        $segundaFase->m_parcela_valor = $request->m_parcela_valor;

        $segundaFase->s_parcelas = $request->s_parcelas;
        $segundaFase->s_parcela_pg = $request->s_parcela_pg;
        $segundaFase->s_parcela_valor = $request->s_parcela_valor;

        $segundaFase->multa = $request->multa;

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
        $student = Student::where('id', $defaulting->student_id)->get();

        return view('defaultings.show', [
            'title' => $title,
            'defaulting' => $defaulting,
            'student' => $student,
            'estados' => $this->getEstados()
        ]);
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
        $students = Student::where('active', true)->orderBy('name', 'asc')->paginate(1000);

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

        $defaulting->m_parcelas = $request->m_parcelas;
        $defaulting->m_parcela_pg = $request->m_parcela_pg;
        $defaulting->m_parcela_valor = $request->m_parcela_valor;

        $defaulting->s_parcelas = $request->s_parcelas;
        $defaulting->s_parcela_pg = $request->s_parcela_pg;
        $defaulting->s_parcela_valor = $request->s_parcela_valor;

        $defaulting->multa = $request->multa;

        $defaulting->save();

        return redirect()->route('defaultings.show', ['defaulting' => $defaulting->id]);
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

    public function getEstados()
    {
        return [
            'AC' => 'Acre',
            'AL' => 'Alagoas',
            'AP' => 'Amapá',
            'AM' => 'Amazonas',
            'BA' => 'Bahia',
            'CE' => 'Ceará',
            'DF' => 'Distrito Federal',
            'ES' => 'Espírito Santo',
            'GO' => 'Goiás',
            'MA' => 'Maranhão',
            'MT' => 'Mato Grosso',
            'MS' => 'Mato Grosso do Sul',
            'MG' => 'Minas Gerais',
            'PA' => 'Pará',
            'PB' => 'Paraíba',
            'PR' => 'Paraná',
            'PE' => 'Pernambuco',
            'PI' => 'Piauí',
            'RJ' => 'Rio de Janeiro',
            'RN' => 'Rio Grande do Norte',
            'RS' => 'Rio Grande do Sul',
            'RO' => 'Rondônia',
            'RR' => 'Roraima',
            'SC' => 'Santa Catarina',
            'SP' => 'São Paulo',
            'SE' => 'Sergipe',
            'TO' => 'Tocantins',
        ];
    }
}
