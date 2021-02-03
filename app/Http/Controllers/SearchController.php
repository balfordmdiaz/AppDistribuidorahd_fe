<?php

namespace App\Http\Controllers;

use App\Models\ArticuloStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
        public function articulo(Request $request)
        {
            $term = $request->get('term');
    
            $querys = DB::table('tbl_articulostock')
                            ->select('tbl_articulostock.idarticulos','tbl_articulostock.idlarticulos','tbl_articulostock.nombrearticulo')
                            ->where('tbl_articulostock.nombrearticulo', 'LIKE', '%' . $term . '%')->get();
           // $querys = ArticuloStock::where('tbl_articulostock.nombrearticulo', 'LIKE', '%' . $term . '%')->get();         
    
            $data = [];
    
            foreach ($querys as $query) {
    
                $data[] = [
                    'label' => $query->nombrearticulo
                ];
    
            }
    
            return $data;
        }


}
