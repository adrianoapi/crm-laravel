<?php

namespace App\Http\Controllers;

use App\BankChequeHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BankChequeHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $model = new BankChequeHistory();
        $model->user_id = Auth::id();
        $model->bank_cheque_id = $request->bank_cheque_id;
        $model->observacao = $request->observacao;
        if($model->save())
        {
            return response()->json([
                'status' => true,
                'attributes' => $model->getAttributes()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\bankChequeHistory  $bankChequeHistory
     * @return \Illuminate\Http\Response
     */
    public function show(bankChequeHistory $bankChequeHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\bankChequeHistory  $bankChequeHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(bankChequeHistory $bankChequeHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\bankChequeHistory  $bankChequeHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, bankChequeHistory $bankChequeHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\bankChequeHistory  $bankChequeHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(bankChequeHistory $bankChequeHistory)
    {
        //
    }
}
