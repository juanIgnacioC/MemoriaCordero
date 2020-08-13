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

  function eliminarHabilidad(id){
  $("#myModalEliminarHabilidad").modal('show');
  $("#idUnidadHabilidad").val(id);
  return("0");
}

  function eliminarInstanciaUnidadHabilidad() {
    var token = $("#token").val();

    var id = $("#idUnidadHabilidad").val();
    var asignatura = $("#asignatura").val();
    var curso = $("#curso").val();

    var idInstanciaUnidad = $("#idInstanciaUnidad").val();

    var base_url = "<? echo base_url()?>";
    $.post(
      "abilities/eliminarInstanciaUnidadHabilidad",
      {
        idInstanciaUnidadHabilidad: id,
        _token:token
      },function(){
        $("#myModalEliminarHabilidad").modal('hide');
        $("#listado").hide('slow');
        //cambiar cargar datos
        cargarContents(asignatura, curso, idInstanciaUnidad);
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

  function cargarContents(curso, asignatura, idInstanciaUnidad){
    var base_url = "<? echo base_url()?>";
    console.log("id");
    console.log(idInstanciaUnidad);
    console.log(curso);
    console.log(asignatura);

    $.get(
      "contents",
      {
        curso: curso,
        asignatura: asignatura,
        id: idInstanciaUnidad
      },
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