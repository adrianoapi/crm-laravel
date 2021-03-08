<?php

namespace App\Http\Controllers;

use App\Graphic;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GraphicController extends Controller
{
    private $title  = 'GRAFICA - ENNT';

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
        $ids = [];
        $unidade = NULL;
        $ctr = NULL;
        $students = NULL;
        $pesuisar = NULL;
        $negociado = '';
        $boleto = '';

        if(array_key_exists('filtro',$_GET))
        {

            if(strlen($_GET['pesquisar']))
            {
                $pesuisar = $_GET['pesquisar'];
                $students = Student::where('name', 'like', '%' . $pesuisar . '%')
                ->where('active', true)
                ->orWhere('cpf_cnpj', 'like', '%' . $pesuisar . '%')
                ->orderBy('name', 'asc')
                ->get();

                $ids = [];
                foreach($students as $value):
                    array_push($ids, $value->id);
                endforeach;
            }else{
                $students  = Student::where('active', true)->get();
                $ids = [];
                foreach($students as $value):
                    array_push($ids, $value->id);
                endforeach;
            }

            if(strlen($_GET['unidade']))
            {
                $unidade = $_GET['unidade'];
                $students = Student::whereIn('id', $ids)
                ->where('cod_unidade', 'like', '%' . $unidade . '%')
                ->where('active', true)
                ->orderBy('name', 'asc')
                ->get();

                $ids = [];
                foreach($students as $value):
                    array_push($ids, $value->id);
                endforeach;
            }
            if(strlen($_GET['ctr']))
            {
                $ctr = $_GET['ctr'];
                $students = Student::whereIn('id', $ids)
                ->where('ctr', 'like', '%' . $ctr . '%')
                ->where('active', true)
                ->orderBy('name', 'asc')
                ->get();

                $ids = [];
                foreach($students as $value):
                    array_push($ids, $value->id);
                endforeach;
            }

           if(strlen($_GET['negociado']))
            {
                $negociado = $_GET['negociado'] == 'sim' ? true : false;
                $students  = Graphic::whereIn('student_id', $ids)
                ->where('negociado', $negociado)
                ->where('active', true)
                ->get();

                $ids = [];
                foreach($students as $value):
                    array_push($ids, $value->student_id);
                endforeach;

                $negociado = $_GET['negociado'];
            }



            if(strlen($_GET['boleto']))
            {
                $boleto = $_GET['boleto'] == 'sim' ? true : false;
                $students = Graphic::whereIn('student_id', $ids)
                ->where('boleto', $boleto)
                ->where('active', true)
                ->get();

                $ids = [];
                foreach($students as $value):
                    array_push($ids, $value->student_id);
                endforeach;

                $boleto = $_GET['boleto'];
            }

            if(!empty($ids))
            {
                $graphics = Graphic::whereIn('student_id', $ids)
                                        ->where('active', true)
                                        ->orderBy('student_name', 'asc')
                                        ->paginate(100);
            }else{
                $graphics = Graphic::where('active', true)->orderBy('student_name', 'asc')->paginate(100);
            }


        }else{
            $graphics = Graphic::where('active', true)->orderBy('student_name', 'asc')->paginate(100);
        }

        $title = $this->title. " listagem";


        return view('graphics.index', [
            'title' => $title,
            'graphics' => $graphics,
            'pesuisar' => $pesuisar,
            'negociado' => $negociado,
            'boleto' => $boleto,
            'unidade' => $unidade,
            'ctr' => $ctr,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = $this->title. " cadastrar";
        $students = Student::where('active', true)->orderBy('name', 'asc')->paginate(100000);

        return view('graphics.add', ['students' => $students, 'title' => $title]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $student = Student::where('id', $request->student_id)->get();
        $segundaFase = new Graphic();
        $segundaFase->user_id       = Auth::id();
        $segundaFase->student_id    = $request->student_id;
        $segundaFase->student_name  = $student[0]->name;
        $segundaFase->dt_vencimento = $request->dt_vencimento;

        $segundaFase->valor   = $request->valor;
        $segundaFase->parcela = $request->parcela;
        $segundaFase->total   = $request->total;

        $segundaFase->save();

        return redirect()->route('graphics.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Graphic  $graphic
     * @return \Illuminate\Http\Response
     */
    public function show(Graphic $graphic)
    {
        $title = $this->title. " negociar";
        $student = Student::where('id', $graphic->student_id)->get();

        return view('graphics.show', [
            'title' => $title,
            'graphic' => $graphic,
            'student' => $student,
            'estados' => $this->getEstados()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Graphic  $graphic
     * @return \Illuminate\Http\Response
     */
    public function edit(Graphic $graphic)
    {
        $title = $this->title. " alterar";
        $students = Student::where('active', true)->orderBy('name', 'asc')->paginate(1000);

        return view('graphics.edit', [
            'title' => $title,
            'students' => $students,
            'graphic' => $graphic
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Graphic  $graphic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Graphic $graphic)
    {
        $graphic->student_id       = $request->student_id;
        $graphic->dt_vencimento = $request->dt_vencimento;

        $graphic->valor = $request->valor;
        $graphic->parcela = $request->parcela;
        $graphic->total = $request->total;

        $graphic->save();

        return redirect()->route('graphics.show', ['graphic' => $graphic->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Graphic  $graphic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Graphic $graphic)
    {
        $graphic->active = false;
        $graphic->save();
        return redirect()->route('graphics.index');
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
