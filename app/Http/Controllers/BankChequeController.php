<?php

namespace App\Http\Controllers;

use App\BankCheque;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BankChequeController extends Controller
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
                $students  = BankCheque::whereIn('student_id', $ids)
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
                $students = BankCheque::whereIn('student_id', $ids)
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
                $bankCheques = BankCheque::whereIn('student_id', $ids)
                                        ->where('active', true)
                                        ->orderBy('student_name', 'asc')
                                        ->paginate(100);
            }else{
                $bankCheques = BankCheque::where('active', true)->orderBy('student_name', 'asc')->paginate(100);
            }


        }else{
            $bankCheques = BankCheque::where('active', true)->orderBy('student_name', 'asc')->paginate(100);
        }

        $title = $this->title. " listagem";

        return view('bankCheques.index', [
            'title' => $title,
            'bankCheques' => $bankCheques,
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BankCheque  $bankCheque
     * @return \Illuminate\Http\Response
     */
    public function show(BankCheque $bankCheque)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BankCheque  $bankCheque
     * @return \Illuminate\Http\Response
     */
    public function edit(BankCheque $bankCheque)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BankCheque  $bankCheque
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BankCheque $bankCheque)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BankCheque  $bankCheque
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankCheque $bankCheque)
    {
        //
    }
}
