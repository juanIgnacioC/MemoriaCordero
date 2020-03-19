//hacer eliminar
/*$('#eliminar0').click(function() {
      planificarEx(0);
    });*/

/*$('#NuevoNombre').click(function() {
      console.log("click");
    });*/

$('#NuevoNombre').change(function() {
      console.log("click");
    });

/*$("#planificar0").click(function (e) {
    e.preventDefault();
    var idInstanciaPlaniAño = $("#id"+indice).val();

    var curso = $("#nombreCurso"+indice).val();
    var asignatura = $("#nombreAsignatura"+indice).val();
    var anio = $("#anio"+indice).val();
    var token = '{{csrf_token()}}';// ó $("#token").val() si lo tienes en una etiqueta html.
    console.log("post");
    console.log(token);
    var data={curso:curso,
        asignatura:asignatura,
        anio:anio,
        idInstanciaPlaniAño:idInstanciaPlaniAño,
        _token:token};
    $.ajax({
        type: "post",
        url: "{{route('forms.validation')}}",
        data: data,
        success: function (msg) {
                alert("Se ha realizado el POST con exito "+msg);
        }
    });
});*/

/*document.getElementById('planificar0').addEventListener('click', function() {
      console.log("holi");
    });*/

function planificar(indice){
    var idInstanciaPlaniAño = $("#id"+indice).val();

    var curso = $("#nombreCurso"+indice).val();
    var asignatura = $("#nombreAsignatura"+indice).val();
    var anio = $("#anio"+indice).val();
    var token = '{{csrf_token()}}';
    console.log(idInstanciaPlaniAño);

    $.post(
      "{{ route('forms.validation') }}",
      {
        curso:curso,
        asignatura:asignatura,
        anio:anio,
        idInstanciaPlaniAño:idInstanciaPlaniAño,
        _token:token
      },function(){
        $("#listado").hide('slow');
        //cambiar cargar datos
        //cargarDatos();
        $("#listado").show('slow');
      }
    );

  }

function planificarEx(indice){
    var idInstanciaPlaniAño = $("#id"+indice).val();

    var curso = $("#nombreCurso"+indice).val();
    var asignatura = $("#nombreAsignatura"+indice).val();
    var anio = $("#anio"+indice).val();
    //var token = '{{csrf_token()}}';
    var token = $("#token").val();
    console.log("post");
    console.log(token, curso, asignatura, anio);

    var data={curso:curso,
        asignatura:asignatura,
        anio:anio,
        idInstanciaPlaniAño:idInstanciaPlaniAño,
        _token:token};

    $.ajax({
        type: "get",
        url: "form-validation",
        data: data,
        success: function (msg) {
          console.log("Se ha realizado el GET con exito full " + msg);
          console.log("Se ha realizado el GET con exito " + msg.plani);
          /*console.log("Se ha realizado el GET con exito " + msg.data.data);
          console.log("Se ha realizado el GET con exito " + msg.data.data.url);*/

          //console.log("url" + url);
          //console.log( "d: " + data);

          //aqui cambiar de vista // ver si data se pasa correctamente//pare que si, ver instanciaPlani

          //window.location.assign("form-validation"+ "/?asignatura&" + asignatura);
          //window.location.assign(url);
          //window.location.replace(msg.url);
        }
    });

  }