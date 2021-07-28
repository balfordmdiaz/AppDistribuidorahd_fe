<?php

namespace App\Http\Controllers;

use App\Models\clienteBD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
        public function articulo(Request $request)
        {
            $term = $request->get('term');
    
            $querys = DB::table('tbl_articulostock')
                            //->select('tbl_articulostock.idarticulos','tbl_articulostock.idlarticulos','tbl_articulostock.nombrearticulo')
                            ->select('tbl_articulostock.idarticulos', DB::raw("CONCAT(tbl_articulostock.idlarticulos,' - ',tbl_articulostock.nombrearticulo) as Articulo")) //busqueda mediante id y nombre
                            ->where('tbl_articulostock.idlarticulos', 'LIKE', '%' . $term . '%')
                            ->orWhere('tbl_articulostock.nombrearticulo', 'LIKE', '%' . $term . '%')
                            ->orderBy('tbl_articulostock.idlarticulos', 'ASC')
                            ->get();
           // $querys = ArticuloStock::where('tbl_articulostock.nombrearticulo', 'LIKE', '%' . $term . '%')->get();         
    
            $data = [];
    
            foreach ($querys as $query) {
    
                $data[] = [
                    'label' => $query->Articulo
                ];
    
            }
    
            return $data;
        }

        public function cliente(Request $request)
        {
            $term = $request->get('term');
    
            $querys = DB::table('tbl_clientes')
                            ->select('tbl_clientes.idcliente', DB::raw("CONCAT(tbl_clientes.idlcliente, ' - ', tbl_clientes.nombrecompleto, ' - ', tbl_clientes.departamento) as Cliente")) //busqueda mediante id y nombre
                            ->where('tbl_clientes.idlcliente', 'LIKE', '%' . $term . '%')
                            ->orWhere('tbl_clientes.nombrecompleto', 'LIKE', '%' . $term . '%')
                            ->orWhere('tbl_clientes.departamento', 'LIKE', '%' . $term . '%')
                            ->get();
           //$querys = clienteBD::where('tbl_clientes.nombre', 'LIKE', '%' . $term . '%')->get();         
    
            $data = [];
    
            foreach ($querys as $query) {
    
                $data[] = [
                    'label' => $query->Cliente
                ];
    
            }
    
            return $data;
        }

        
}
