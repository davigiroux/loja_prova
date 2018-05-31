<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class NotaController extends Controller
{
    public function index($id)
    {
        $cliente = \App\Cliente::find($id);
        return view('nota.index', compact('cliente'));
    }

    public function create($id)
    {
        $cliente = \App\Cliente::find($id);
        $produtos = \App\Produto::all();
        $nota = new \App\Nota;
        $nota->valor = 0;
        return view('nota.create', compact('cliente', 'nota', 'produtos'));
    }

    public function download($id)
    {
        $nota = \App\Nota::find($id);
        $pdf = PDF::loadView('nota.invoice', array('nota' => $nota));
         return $pdf->download('relatorio.pdf');
    }

    public function store(Request $request)
    {
        $nota = new \App\Nota;
        $nota->cliente_id = $request->cliente_id;
        $nota->total = $request->total;
        $nota->save();

        $produtos = $request->produtos;
        foreach($produtos as $produto) {
            $item = new \App\Nota_Produto;
            $item->produto_id = $produto['id'];
            $item->nota_id = $nota->id;
            $item->quantidade = $produto['quantidade'];

            $item->save();
        }

        return redirect('/nota/'.$request->cliente_id);
    }

}
