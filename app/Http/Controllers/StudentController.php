<?php

namespace App\Http\Controllers;

use App\Student;
use App\Unity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    private $title  = 'Alunos';

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
        $students = Student::where('active', true)->orderBy('name', 'asc')->paginate(100);
        $unities = Unity::where('active', true)->orderBy('name', 'asc')->paginate(100);

        return view('students.index', ['title' => $title, 'students' => $students, 'unities' => $unities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = $this->title. " cadastrar";
        $unities = Unity::where('active', true)->orderBy('name', 'asc')->paginate(100);

        return view('students.add', ['unities' => $unities, 'title' => $title, 'estados' => $this->getEstados()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = new Student();
        $model->user_id     = Auth::id();
        $model->unity_id    = $request->unity_id;
        $model->name        = $request->name;
        $model->responsavel = $request->responsavel;
        $model->cpf_cnpj    = $request->cpf_cnpj;
        $model->ctr = $request->ctr;
        $model->telefone = $request->telefone;
        $model->celular = $request->celular;
        $model->email = $request->email;
        $model->cep = $request->cep;
        $model->endereco = $request->endereco;
        $model->numero = $request->numero;
        $model->complemento = $request->complemento;
        $model->bairro = $request->bairro;
        $model->cidade = $request->cidade;
        $model->estado = $request->estado;
        $model->observacao = $request->observacao;
        $model->save();

        return redirect()->route('alunos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        $title = $this->title. " alterar";
        $unities = Unity::where('active', true)->orderBy('name', 'asc')->paginate(100);

        return view('students.edit', ['title' => $title, 'student' => $student, 'unities' => $unities, 'estados' => $this->getEstados()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $student->user_id     = Auth::id();
        $student->unity_id    = $request->unity_id;
        $student->name        = $request->name;
        $student->responsavel = $request->responsavel;
        $student->cpf_cnpj    = $request->cpf_cnpj;
        $student->ctr = $request->ctr;
        $student->telefone = $request->telefone;
        $student->celular = $request->celular;
        $student->email = $request->email;
        $student->cep = $request->cep;
        $student->endereco = $request->endereco;
        $student->numero = $request->numero;
        $student->complemento = $request->complemento;
        $student->bairro = $request->bairro;
        $student->cidade = $request->cidade;
        $student->estado = $request->estado;
        $student->observacao = $request->observacao;
        $student->save();

        return redirect()->route('alunos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->active = false;
        $student->save();

        return redirect()->route('alunos.index');
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
