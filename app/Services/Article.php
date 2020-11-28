<?php

namespace App\Services;
use App\Models\ArticuloStock;

class Article
{
    public function get()
    {
        $articulostock=ArticuloStock::get();
        $articulostockarray['']="Seleccione un articulo";
        foreach($articulostock as $article)
        {
            $articulostockarray[$article->idarticulos]= $article->nombrearticulo;
        }
        return $articulostockarray;
    }
}

