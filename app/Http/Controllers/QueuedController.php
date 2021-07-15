<?php

namespace App\Http\Controllers;

use App\Queued;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QueuedController extends Controller
{
    private $title  = 'CHEQUE - IMPORTAÇÃO';

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
        $tile = "Importação";
        $modeulo = 'cheque';
        if(array_key_exists('modulo',$_GET))
        {
            $modeulo = $_GET['modulo'];

        }

        $queued = Queued::where('module', $modeulo)->get();

        return view('queueds.index', ['title' => $tile, 'queued' => $queued]);
    }

    public function upload(Request $request)
    {
        $handle  = fopen($_FILES['filename']['tmp_name'], "r");
        $headers = fgetcsv($handle, 1000, ",");
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
        {
            $row = explode(';', $data[0]);

            if(!empty($row[7]))
            {
                # Vai construrir as parcelas
                $plots = [];
                $i = 0; # 0 => 8 // separa as parcelas do cheque
                $j = 0; # 0 => 5 // faz a contagem dentro das parcelas
                $k = 0; # indice que nao zera nunca dentro do while
                foreach($row as $value):

                    if( $i > 8)
                    {
                        if(!empty($row[$i])){
                            $plots[$k][$this->setLabel($j)] = ($j == 4) ? $this->setDate($row[$i]) : $row[$i];
                            $j++;
                            if($j > 5){
                                $k++;
                                $j=0;
                            }
                        }
                    }
                    $i++;

                endforeach;

                $arrayBody[] = [
                    'students' => [
                                    'cod_unidade' => $row[0],
                                    'cod_curso' => $row[1],
                                    'ctr' => $row[2],
                                    'cpf_cnpj' => $row[3],
                                    'telefone' => $row[4],
                                    'telefone_com' => $row[5],
                                    'celular' => $row[6],
                                    'name' => $row[7],
                    ],
                    'bank_cheques' => [
                                    'user_id' => 1,
                                    'student_id' => NULL,
                                    'valor' => $row[8],
                    ],
                    'bank_cheque_plots' => $plots,

                ];
            }

        }
        fclose($handle);

        $model = new Queued();
        $model->module = 'cheque';
        $model->body   = json_encode($arrayBody);
        var_dump($model->save());

    }

    private function setDate($date)
    {
        $newDate = $date;
        if(strpos($date,"/"))
        {
            $date    = explode('/', $date);
            $newDate = $date[2].'-'.$date[1].'-'.$date[0];
        }
        return $newDate;
    }

    private function setLabel($string)
    {
        switch ($string) {
            case 0:
                $label = 'banco';
                break;
            case 1:
                $label = 'agencia';
                break;
            case 2:
                $label = 'conta';
                break;
            case 3:
                $label = 'cheque';
                break;
            case 4:
                $label = 'vencimento';
                break;
            default:
                $label = 'valor';
                break;
        }

        return $label;
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
     * @param  \App\Queued  $queued
     * @return \Illuminate\Http\Response
     */
    public function show(Queued $queued)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Queued  $queued
     * @return \Illuminate\Http\Response
     */
    public function edit(Queued $queued)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Queued  $queued
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Queued $queued)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Queued  $queued
     * @return \Illuminate\Http\Response
     */
    public function destroy(Queued $queued)
    {
        //
    }
}
