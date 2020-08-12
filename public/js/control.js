function eliminarClase(id){
  $("#myModal1").modal('show');
  $("#idClase").val(id);
  return("0");
}
function eliminarInstanciaPlaniAnio() {
    var token = $("#token").val();
    var id = $("#idClase").val();

    var base_url = "<? echo base_url()?>";
    $.post(
      "eliminarInstanciaPlaniAnio",
      {
        idInstanciaPlaniAnio: id,
        _token:token
      },function(){
        $("#myModal1").modal('hide');
        $("#listado").hide('slow');
        //cambiar cargar datos
        cargarPlanificaciones();
        $("#listado").show('slow');
      }
    );
  }


  function cargarPlanificaciones(){
    var base_url = "<? echo base_url()?>";
    
    $.get(
      "planifications",
      {},
      function(url, data){
        //$("#listado").html(url,data);

        //var html = $.parseHTML(data);
        //alert(url);
        var x = document.createElement('div');
          x.innerHTML = url;

        var clases = x.querySelector('#listado').innerHTML;
        document.querySelector('#listado').innerHTML = clases;
        
      }
    )
  }