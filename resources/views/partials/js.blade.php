   
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{asset('static/js/jquery-2.1.1.min.js')}}"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{asset('static/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('static/js/wow.min.js')}}"></script>
    <script src="{{asset('static/js/jquery.easing.1.3.js')}}"></script>
    <script src="{{asset('static/js/jquery.isotope.min.js')}}"></script>
    <script src="{{asset('static/js/jquery.bxslider.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('static/js/fliplightbox.min.js')}}"></script>
    <script src="{{asset('static/js/functions.js')}}"></script>


 


<script type="text/javascript">
  function comprobar(obj)
  {   
     if (obj.checked)
     {
        document.getElementById('boton').style.display = "";
        document.getElementById('mas_iva').style.display = "";


     } else
     {
        document.getElementById('boton').style.display = "none";
        document.getElementById('mas_iva').style.display = "none";
      
        
     }     
  } 

  function comprobarDescuento(obj)
  {   
     if (obj.checked)
     {
        document.getElementById('descuento').style.display = "";
        document.getElementById('mas_descuento').style.display = "";
     } else
     {
        document.getElementById('descuento').style.display = "none";
        document.getElementById('mas_descuento').style.display = "none";
     }     
  } 

  
</script>

