<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    //
    protected $table = 'nota';

    public function itens() {
        return $this->belongsToMany('App\Produto', 'nota_produto', 'nota_id', 'produto_id')->withPivot('quantidade');;
    }
}
