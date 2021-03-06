<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use DB;

class RelatorioController extends Controller
{
    public function index() {
        $clientes = \App\Cliente::all();
        return view('relatorio.index', compact('clientes'));
    }

    public function download(Request $request) {
        $clientes = \App\Cliente::all();
        $cliente_id = $request->cliente_id;
        if($request->cliente_id != 0) {
            $clientes = collect([\App\Cliente::find($cliente_id)]);
        }

        $dataInicio = $request->dataInicio;
        $dataFim = $request->dataFim;

        if($dataInicio && $dataFim ) {

            $dataInicio = str_replace("/", "-", $dataInicio);
            $dataFim = str_replace("/", "-", $dataFim);


            $dataInicio = date("Y-m-d", strtotime($dataInicio) );
            $dataFim = date("Y-m-d", strtotime($dataFim) );

            foreach($clientes as $cliente) {
                $cliente->notas = DB::table('nota')->select('*')
                ->whereRaw('DATE(created_at) BETWEEN "'.$dataInicio.'" AND "'.$dataFim.'"')
                ->whereRaw('cliente_id = '.$cliente->id)
                ->get();
            }

        }


        $clientes = $clientes->reject(function ($cliente, $key) {
            return $cliente->notas->isEmpty();
        });

        foreach($clientes as $cliente) {
            foreach($cliente->notas as $nota) {
                $notaAux = \App\Nota::find($nota->id);
                $nota->itens = $notaAux->itens;
            }
        }


        $request->valor_inicial = str_replace(",",".",$request->valor_inicial);
        $request->valor_final = str_replace(",",".",$request->valor_final);

        if(is_numeric($request->valor_inicial) && is_numeric($request->valor_final)) {
            foreach($clientes as $cliente) {
                $notasAux = collect();
                foreach($cliente->notas as $nota) {
                    if($nota->total >= $request->valor_inicial && $nota->total <= $request->valor_final) {
                        $notasAux->push($nota);
                    }
                }
                $cliente->notas = $notasAux;
            }
        }
        $pdf = PDF::loadView('relatorio.invoice', array('clientes' => $clientes, 'dataInicio' => $dataInicio, 'dataFim' => $dataFim));
         return $pdf->download('relatorio.pdf');
    }
}
