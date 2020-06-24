$('.select-all').change(function() {
    console.log("change");
    if($(this).is(':checked')) {
        //seleccionar todos check
        $('[name="check[]"]').each(function(){
        console.log("enab For");
        //$(this).addClass("checked");
        //$(this).prop('checked', true);
        /*console.log($(this).val());
        console.log($(this).chequed);
        console.log($(this).chequed());
        $(this).checked = true;*/

        var check = $(this).prop('checked');
        console.log("check: " + check);
        console.log("END!!!!!");
        if(check == false) {
            $('.checker').find('span').addClass('checked');
            $('.checkbox').prop('checked', true);
        }
        });
    } else {
        //seleccionar todos un-check
        $('[name="check[]"]').each(function(){
            console.log("disab For");

            var check = $(this).prop('checked');
            console.log("check: " + check);
            console.log("END!!!!!");
            if(check == true) {
                $('.checker').find('span').removeClass('checked');
                $('.checkbox').prop('checked', false);
            }
        });
    }
});

function jsonAls() {
  var inputs = $('[name="check[]"]');
  var localVal;
  var array = [];
  var json;
  for (var i = 0; i < inputs.length; i++) {
    var check = $($('[name="check[]"]')[i]).prop('checked');
    if(check == true) {
        localVal = ($($('[name="check[]"]')[i]).val() + '||true');
    }
    else{
        localVal = ($($('[name="check[]"]')[i]).val() + '||false');
    }

    array.push(localVal);
  }

  json = JSON.stringify(array); 
  console.log(json);

  $('#Alumnosjson').val(json);

  return "0";
}

//abrir modal docente ver retroalimentaciones
function retroalimentaciones(unidad, clase) {
  console.log("unidad");
  console.log(unidad);

  var rowUnidad = $("#unidad"+unidad).val();
  var json = JSON.parse(rowUnidad);
  console.log(json['clases']);

  console.log("retros");
  arrayRetroalimentaciones = json['clases'][clase]['retroalimentaciones'];
  console.log(arrayRetroalimentaciones);


  //for retroalimentaciones -> tabla
  var table = $('#tableModal');
  table.find("tbody tr").remove();
  arrayRetroalimentaciones.forEach(function (retro) {
      table.append("<tr><td>" + retro.name + "</td><td>" + retro.puntuacion + "</td><td>" + retro.comentario + "</td></tr>");
  });

  $("#myModal1").modal('show');
  return("0");
}


//abrir modal retroalimentación clase
function retroalimentar(indice) {
  console.log("retro")
  console.log(indice);
  var row = $("#row"+indice).val();
  var json = JSON.parse(row);
  console.log(json);
  //console.log(json['id']);
  //console.log(json['start']);
  var check = $('input[name="radios"]:checked').val();
  if(check){
    $('#check'+check).show();
    //prev
    $('#previous').val(check);
    console.log("radioPRessedexistst: " + check);
    //deshabilitar checkboxes
  }
  else{
    console.log("radioPRessedNOT: " + check);
  }

  $("#idInstanciaClase").val(json['id']);
  $("#idInstanciaPlaniAnio").val(json['idInstanciaPlaniAño']);
  
  $("#myModal1").modal('show');
  return("0");
}

//radiobutton de puntuación cambia
$('input[name="radios"]').change(function() {
  console.log("cambia");
  var check = $('input[name="radios"]:checked').val();
  var previous = $('#previous').val();
  if(check){
    console.log("radioPRessedexistCHANGE: " + check);
    console.log("PreviousCHANGE: " + previous);
    //si son distintos deshabilitar checkboxes
    $('#check'+previous).hide();
    $('#check'+check).show();
    $('#previous').val(check);
  }
});

  function guardarRetroalimentacion() {
    var puntuacion = $('input[name="radios"]:checked').val();
    //var comentario = $("#nombreEdit").val();
    var idInstanciaClase = $("#idInstanciaClase").val();
    var idInstanciaPlaniAnio = $("#idInstanciaPlaniAnio").val();
    var asignatura = $("#asignatura").val();
    //var token = '{{csrf_token()}}';
    var token = $("#token").val();

    var inputs = $('[name="check'+ puntuacion + '[]"]');
    var localVal;
    var array = [];
    var json;

    for (var i = 0; i < inputs.length; i++) {
      var check = $($('[name="check'+ puntuacion + '[]"]')[i]).prop('checked');
      if(check == true) {
        console.log("true");
        localVal = ($($('[name="check'+ puntuacion + '[]"]')[i]).val());
        array.push(localVal);

      }
    }

    json = JSON.stringify(array); 
    console.log(json);

    $('#ComentariosJson').val(json);

    var base_url = "<? echo base_url()?>";
    $.post(
      "retroalimentar",
      {
        puntuacion:puntuacion,
        idInstanciaClase: idInstanciaClase,
        idInstanciaPlaniAnio: idInstanciaPlaniAnio,
        ComentariosJson: json,
        asignatura: asignatura,
        _token:token
      },function(){
        $("#myModal1").modal('hide');
        $("#listado").hide('slow');
        //cambiar cargar datos
        cargarClases();
        $("#listado").show('slow');
      }
    );
  }


  function cargarClases(){
    var base_url = "<? echo base_url()?>";
    var idInstanciaPlaniAnio = $("#idInstanciaPlaniAnio").val();
    var asignatura = $("#asignatura").val();
    console.log("obtenerClases");
    console.log(asignatura);
    $.get(
      "clases",
      {
        asignatura: asignatura,
        idInstanciaPlaniAnio: idInstanciaPlaniAnio
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