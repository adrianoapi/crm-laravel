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

        return view('students.add', ['unities' => $unities, 'title' => $title]);
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
        $model->name        = $request->name;
        $model->cpf_cnpj    = $request->cpf_cnpj;
        $model->responsavel = $request->responsavel;
        $model->unity_id    = $request->unity_id;
        $model->unity_id    = $request->unity_id;
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

        return view('students.edit', ['title' => $title, 'student' => $student, 'unities' => $unities]);
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
        $student->name        = $request->name;
        $student->cpf_cnpj    = $request->cpf_cnpj;
        $student->responsavel = $request->responsavel;
        $student->unity_id    = $request->unity_id;
        $student->unity_id    = $request->unity_id;
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
}
