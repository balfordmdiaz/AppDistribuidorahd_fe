@extends('layoutpdf')

@section('title',$facturabd->idlfactura)

@section('content')


   <div id="datos_empresa" >
      <h2>Distribuidora Variedades Hermanos Diaz</h2>
      <p><label>Telefono:</label> 
         {{ $telefonoemp = DB::table('tbl_empleado')->where('idempleado', $facturabd->idempleado)->value('telefono')  }} 
      </p>
   </div>

   <div id="datos_empleado" style="">
      <p> 
         {{ $nombreemp = DB::table('tbl_empleado')->where('idempleado', $facturabd->idempleado)->value('nombre')  }} 
         {{ $apellidoemp = DB::table('tbl_empleado')->where('idempleado', $facturabd->idempleado)->value('apellido') }}
      </p>

   </div>

   <div id="datos_factura" >
      <h3>Factura</h3>
      Nro. Factura:{{$facturabd->idlfactura}}
      <br>
      Fecha:{{$facturabd->fechafactura}}
   </div>

   <div id="datos_cliente" style="">
      <h3 style="text-decoration: underline">Facturar a:</h3>
      <p><label> Cliente:</label> 
         {{ $nombreclient = DB::table('tbl_clientes')->where('idcliente', $facturabd->idcliente)->value('nombre')  }} 
         {{ $apellidoclient = DB::table('tbl_clientes')->where('idcliente', $facturabd->idcliente)->value('apellido') }}</p>
      <p><label>Departemanto:</label> 
         {{ $departamentoclient = DB::table('tbl_clientes')->where('idcliente', $facturabd->idcliente)->value('departamento') }}</p>
   </div>


<table id="tabladetalle">
    <thead>
         <tr>
            <th scope="col">Articulo</th>
            <th scope="col">Talla</th>
            <th scope="col">Prec</th>
            <th scope="col">Cant</th>
            <th scope="col">Monto</th>
         </tr>
    </thead>

   @forelse($detalle = DB::table('tbl_facturadetalle')
                          ->join('tbl_articulovariante', 'tbl_facturadetalle.idarticulov', '=', 'tbl_articulovariante.idarticulov')
                          ->join('tbl_factura', 'tbl_facturadetalle.idfactura', '=', 'tbl_factura.idfactura')
                          ->join('tbl_articulostock', 'tbl_articulovariante.idarticulos', '=', 'tbl_articulostock.idarticulos')
                          ->select('tbl_articulostock.nombrearticulo','tbl_articulovariante.talla','tbl_facturadetalle.precio','tbl_facturadetalle.cantidad','tbl_facturadetalle.monto')
                          ->where('tbl_facturadetalle.idfactura', $facturabd->idfactura)
                          ->get()  as $detalleItem)    
     <tbody>
      <tr>                 
         <td>{{ $detalleItem->nombrearticulo }}</td>  
         <td>{{ $detalleItem->talla }}</td>  
         <td>{{ $detalleItem->precio}}</td>  
         <td>{{ $detalleItem->cantidad }}</td>  
         <td>{{ $detalleItem->monto }} C$</td>
      </tr>        
   @empty
    <tr>
      <td colspan="5"><p style="text-align: center">No hay articulos para mostrar</p> </td>
    </tr>  
    </tbody>
   @endforelse

   
   <tr>
      
      <th style="text-decoration: underline">Subtotal</th>
      <td colspan="4">{{ $facturabd->subtotal }} C$</td>
   </tr>

   <tr>
      
      <th style="text-decoration: underline">Iva</th>
      <td colspan="4">{{ $facturabd->iva }} C$</td>
   </tr>

   <tr>
      
      <th style="text-decoration: underline">Descuento</th>
      <td colspan="4">{{ $facturabd->descuento }} C$</td>
   </tr>

   <tr>
      
      <th style="text-decoration: underline">Total</th>
      <td colspan="4">{{ $facturabd->total }} C$</td>
   </tr>

</table>

<div>
   <h6 style="text-align: center; font-style: italic">¡Gracias por su compra!</h6>
</div>


<div id="salir">
   <a href=" {{ route('factura.index') }} ">Salir</a>
</div>


<div class="w-33">
   <div class="center" id="btnimprimir">
           <button id="imprimir_pdf" onclick="imprimir()">Imprimir</button>
   </div>
</div>

@endsection

<script type="text/javascript">
   function imprimir()
   {   
      btnimprimir.style.visibility = 'hidden';//Desahabilita los botones al imprimir
      salir.style.visibility = 'hidden';
      window.print();   
   } 
</script>





INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (, '', '', 1),


INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (24, '19', 'BOXER P/LARGA MONSTER JUVENILE', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (25, '21', 'BOXER INFANTIL NINA FYLING', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (26, '23', 'BOXER SENADOR DE NIÑA/ NIÑO', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (27, '26', 'BLUMER JUVENIL LOVABLE', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (28, '27', 'BLUMER INFANTILITO ISAGUARA', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (29, '30', 'BLUMER DE DAMA LOVABLE', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (30, '31', 'BLUMER DE SENORA DE ALGODON', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (31, '35', 'BIKIN DE ALGODON LOVABLE', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (32, '42', 'CALCETA ALTA DE TRIYON', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (33, '43', 'CALCETA SPORT ALTA', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (34, '44', 'CALCETIN DE CAJA', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (35, '45', 'CALCETA DE FUTBALL', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (36, '48', 'PLANTIA DE DAMA HOT LOVE', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (37, '49', 'TOBILLERA DE DAMA ALICRADA', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (38, '50', 'TOBILLERA ALICRADA DE HOMBRE', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (39, '51', 'TOBILLERA JUVENIL DE NIÑOS, niñas', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (40, '55', 'CAMISOLA GENESIS DE NINAS 2 Y 4', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (41, '58', 'GABACHITA PARA BEBE', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (42, '60', 'PILLAMITA PATROL', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (43, '61', 'PILLAMITA DISNEY', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (44, '62', 'PILLAMITA LISA', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (45, '63', 'MAMELUCO DE ALGODON', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (46, '64', 'MAMELUCO DE LANA', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (47, '65', 'BABERO METER', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (48, '67', 'FAJERO ALGODON', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (49, '70', 'GORRITO DE LANA OJITOS (RAYADO)', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (50, '74', 'ZAPATO DE LANA', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (51, '82', 'CALCETIN PAYASITO', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (52, '83', 'CALCETIN CAMILA VUELO GRANDE', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (53, '84', 'COLCHITA ROKITA', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (54, '85', 'BOLSO PANALERO', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (55, '86', 'TOALLA PARA BEBE FINA', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (56, '88', 'PAÑAL BLANCO BARATO', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (57, '92', 'COLCHA CRISTAL DE ROLLO', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (58, '93', 'BRASSIER YH/QY WZ-107', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (59, '98', 'PAÑOLETA DE ALGODÓN', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (60, '99', 'TOALLA DE COCINA', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (61, '102', 'TOALLA CIMA', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (62, '105', 'BOLSA NORMAL MEDIANA', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (63, '106', 'BOLSA NORMAL GRANDE', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (64, '107', 'BOLSA REFORZADA PEQUENA', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (65, '108', 'BOLSA REFORZADA MEDIANA', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (66, '109', 'BOLSA REFORZADA GRANDE', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (67, '111', 'MOSKITERO DE ARO', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (68, '112', 'MOSKITERO CUADRADO', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (69, '114', 'SOMBRILLAS MINI FION', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (70, '115', 'SOMBRILLAS JUMBO', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (71, '116', 'BOXER DE NINO INFANTIL FIBRA', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (72, '120', 'BOXER P/LARGA TRIYON', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (73, '122', 'CALCETIN CAMILA VUELO PEQUEÑO', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (74, '125', 'TOALLA FACIAL CARIBE', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (75, '128', 'CAMISETA TRICO CUELLO REDONDO S, M, L ', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (76, '129', 'CAMISETA TRICO CUELLO V S, M, L ', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (77, '135', 'TOALLA GIMNASIO PREMIER', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (78, '139', 'VESTIDO NIÑA NACIONAL # 1', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (79, '140', 'VESTIDO NIÑA NACIONAL # 2', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (80, '141', 'VESTIDO NIÑA NACIONAL # 3', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (81, '144', 'COLCHITA CON ALMOHADA', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (82, '146', 'TOALLA TROFEO', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (83, '149', 'GORRITO DE AMARRE', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (84, '150', 'BRASIER FINO JV LISA SECRET', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (85, '151', 'BRASIER LISA 2240', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (86, '154', 'BIKIN 215 FIND ROAD ', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (87, '155', 'BIKIN 20471 PANTY', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (88, '158', 'BIKIN ALGODÓN HANA 3296', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (89, '160', 'CALCETA  JOLTER', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (90, '161', 'CALCETA PATRIOT', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (91, '163', 'CACHETERO BRENDA COLOR', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (92, '164', 'LICRA COLOR', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (93, '165', 'LICRA NEGRA', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (94, '171', 'GORRA CHOLA', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (95, '172', 'MASCARILLAS QUIRURJICAS', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (96, '173', 'LATEX RUBBER BAND (HULITOS)', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (97, '174', 'PIRAÑAS  X', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (98, '176', 'PAQUETE DE LIGAS MEDIANOS', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (99, '177', 'PAQUETES DE LIGAS GRANDES', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (100, '180', 'PEINE GRANDE', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (101, '181', 'PEINE MEDIANO/DUO', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (102, '182', 'PEINE FINO', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (103, '183', 'RISTRA DE LAZOS', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (104, '196', 'CAMISOLA KIMO DE NIÑO', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (105, '197', 'TOBILLERA KAMINATA ', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (106, '198', 'TOALLAS DE MANO FINATEX', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (107, '199', 'TOALLA DE MANO P20D', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (108, '200', 'BIKIN LOVABLE ', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (109, '202', 'PINTURA DE UÑA EN GEL (CAIRUO CR)', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (110, '204', 'ACETONA (CAIRUO CR)', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (111, '205', 'PIRAÑITAS (100)', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (112, '207', 'PRENSA PELO CUCARACHA', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (113, '209', 'BLUSA SURTIDA', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (114, '210', 'TALLADOR', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (115, '214', 'TOBILLERA TALCO', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (116, '215', 'BOXER ROSE DANA 2053', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (117, '223', 'TINTE SURTIDO', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (118, '224', 'BIKIN 824', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (119, '227', 'BIKIN 071', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (120, '228', 'CALCETA COLEGIAL DE NIÑAS', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (121, '229', 'BLUMMER ROSE DANA 3998', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (122, '232', 'MARBELLIN Y LINEADOR', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (123, '234', 'LAPIZ PARA OJO', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (124, '235', 'PESTAÑAS', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (125, '238', 'BLUMER LIANBMENGNI 5838', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (126, '239', 'BOXER ALGODÓN H&L', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (127, '242', 'CAMISETA BONDI JUVENIL', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (128, '243', 'CAMISETA BONDI INFANTIL', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (129, '244', 'TOALLA DISNEY', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (130, '245', 'QUIMONA', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (131, '246', 'BABY DOLL', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (132, '247', 'BIKIN OUSEY', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (133, '248', 'CORPIÑO BRENDA', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (134, '249', 'BRASSIER HOT LOVE 9930', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (135, '251', 'TACONERA MEDIAS BRENDA', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (136, '252', 'CALZONCILLO TANGA', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (137, '253', 'BLUMERCITO HAPPY GIRL', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (138, '254', 'BLUMERCITO DANA', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (139, '256', 'BLUMER MARY DAVIS', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (140, '260', 'LIMA METAL', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (141, '261', 'LIMA COLOR', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (142, '262', 'LIMA NEGRA', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (143, '264', 'BLUMER HENGWEIFUSUI 3003', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (144, '266', 'SHORES NIKE', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (145, '267', 'CONJUNTO NIKE', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (146, '268', 'LICRA NIKE', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (147, '269', 'BLUMERCITA BRENDA', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (148, '270', 'PANTALETA CON BLONDA', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (149, '272', 'BLUSA PARA NIÑA', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (150, '274', 'BRASSIER MIS LUNA 192018', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (151, '275', 'BRASSIER LISA SECRET 1035', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (152, '276', 'BOXER PROBOX', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (153, '277', 'BIKIN UO KIN 3034', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (154, '278', 'BLUMER MORT LOVE 2146', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (155, '279', 'BIKIN HL ', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (156, '280', 'BIKIN DANA 071', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (157, '281', 'BIKIN LUEN ROSE 2617', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (158, '283', 'POLVO COMPACTO P&W', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (159, '284', 'PANTALON LEVIS 28-34', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (160, '285', 'BLUMMER SIN COSTURA DAILEISHA ', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (161, '286', 'BRASIER SHENYUZI W131', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (162, '287', 'CAMISETA BONDI ADULTO', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (163, '288', 'TOBILLERA MARVIN SPORT', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (164, '289', 'CALSETA JUVENIL PUMA ', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (165, '290', 'BLUMER SEÑORA FIBRA', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (166, '291', 'CONJUNTITO NIÑA', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (167, '292', 'BOLSA DE EMPAQUE GRANDE', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (168, '293', 'BOLSA EMPAQUE MEDIANA', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (169, '294', 'MANGAS', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (170, '295', 'MEDIA PERRITO', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (171, '296', 'CALCETA COLEGIAL AZUL', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (172, '297', 'BRASSIER MIS LUNA 89033', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (173, '298', 'CAMISETA GILDAN INFANTIL', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (174, '299', 'CAMISETA GILDAN JUVENIL', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (175, '300', 'CAMISETA GILDAN ADULTO', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (176, '301', 'BLUSAS C/MANGAS', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (177, '302', 'BLUSAS VARIADAS DESCOTADA/ CON BOLSA', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (178, '303', 'PANTALON TOMMY DE NIÑO', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (179, '304', 'BUZO COLEGIAL INFANTIL', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (180, '305', 'BUZO COLEGIAL JUVENIL', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (181, '306', 'BOXERE P/CORTA AGRESIVO', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (182, '307', 'BRASIER LA NENA SIN ALAMBRE 2532', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (183, '308', 'CARTON UÑA', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (184, '309', 'CAJA UÑA JHOSELIN', 1),
INSERT INTO `tbl_articulostock` (`idarticulos`, `idlarticulos`, `nombrearticulo`, `idcategoria`) VALUES (185, '310', 'PLATOS', 1),




































































































































































