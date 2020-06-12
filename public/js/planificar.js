//hacer eliminar
/*$('#eliminar0').click(function() {
      planificarEx(0);
    });*/

/*$('.NuevoNombre.es-input').change(function() {
      console.log("click");
    });*/


$('#editable-select').editableSelect({
  effects: 'slide',
  duration: 200,
  appendTo: 'body'
});
/*$('#select').on('hide.editable-select', function (e, li) {
        $('#last-selected').html(
            li.val() + '. ' + li.text()
        );
    });*/

$('#NuevoNombre')
    .editableSelect({ filter: false, effects: 'slide' })
    .on('select.editable-select', function (e, li) {
        $('#last-selected').html(
            li.val() + '. ' + li.text()
        );
        $('#last-selected').val(li.val());
        $('#idUnidadFK').val(li.val());
        mostrarTodos();
        filtrar(li.val());
    });

//no se selecciona ninguna opcion de nombres o se modifica
$('#NuevoNombre').change(function() {
  console.log("click");
  mostrarTodos();
  filtrar($('#last-selected').val());

  if($('#NuevoNombre').val() == ""){
    mostrarTodos();
    $('#last-selected').text("");
    $('#last-selected').val("");
  }
  //console.log(li.val());
});

/*$('#objetivoGeneral').on('show.editable-select', function (e, li) {
  if($('#NuevoNombre').val() == ""){
    mostrarTodos();
  }
});*/

function filtrar(value){
  if(value != ""){
    var opciones = $($(".es-list")[1]).children();
    largo = opciones.length;

    var localOpcion;
    var localValor;

    console.log(opciones, largo);
    for (var i = 0; i < largo ; i++) {
      localOpcion = opciones[i];
      console.log(localOpcion);

      localValor = $(localOpcion).val();
      console.log(localValor, $(localOpcion).text(), value);

      if(localValor != value){
        $(localOpcion).hide();
      }
    }
  }
}

function mostrarTodos(){
  var opciones = $($(".es-list")[1]).children();
  largo = opciones.length;

  var localOpcion;
  var localValor;

  for (var i = 0; i < largo ; i++) {
    localOpcion = opciones[i];

    localValor = $(localOpcion).val();

    $(localOpcion).show();
  }
}

$('#objetivoGeneral')
    .editableSelect({ filter: false, effects: 'slide' })
    .on('select.editable-select', function (e, li) {
        /*$('#last-selected2').html(
            li.val() + '. ' + li.text()
        );
        $('#last-selected2').val(li.val());*/
        //$('#idUnidadFK').val(li.val());
    });


$('#nombreAbility')
    .editableSelect({ filter: false, effects: 'slide' })
    .on('select.editable-select', function (e, li) {
        /*$('#last-ability').html(
            li.val() + '. ' + li.text()
        );*/
        $('#last-ability').val(li.val());
        //$('#idHabilidadFK').val(li.val());
        //mostrarTodos();
        //filtrar(li.val());
    });


$('#nombreObjetivo')
    .editableSelect({ filter: false, effects: 'slide' })
    .on('select.editable-select', function (e, li) {
        /*$('#last-objective').html(
            li.val() + '. ' + li.text()
        );*/
        
        //console.log("vallsls");
        //console.log(li.val());
        
        var id = $('#id'+li.val() ).val();
        var idObj = $('#idObj'+li.val() ).val();
        //console.log("id");
        //console.log(id);
        //console.log(idObj);

        $('#last-objective').val(idObj);
        $('#idUnidadObjetivo').val(id);
        $('#idObj').val(idObj);
        //mostrarTodos();
        //filtrar(li.val());
    });

$('#nombreConocimiento')
    .editableSelect({ filter: false, effects: 'slide' })
    .on('select.editable-select', function (e, li) {
        /*$('#last-ability').html(
            li.val() + '. ' + li.text()
        );*/
        //$('#last-objective').val(li.val());
        //$('#idHabilidadFK').val(li.val());
        //mostrarTodos();
        //filtrar(li.val());
    });

$('#indicador')
    .editableSelect({ filter: false, effects: 'slide' })
    .on('select.editable-select', function (e, li) {
        /*$('#last-ability').html(
            li.val() + '. ' + li.text()
        );*/
        //$('#last-objective').val(li.val());
        //$('#idHabilidadFK').val(li.val());
        //mostrarTodos();
        //filtrar(li.val());
    });

$('#evaluacion')
    .editableSelect({effects: 'slide' })
    .on('select.editable-select', function (e, li) {
        /*$('#last-ability').html(
            li.val() + '. ' + li.text()
        );*/
        //$('#last-objective').val(li.val());
        //$('#idHabilidadFK').val(li.val());
        //mostrarTodos();
        //filtrar(li.val());
    });



//no se selecciona ninguna opcion de nombres o se modifica
/*$('#nombreAbility').change(function() {
  console.log("click");
  mostrarTodos();
  filtrar($('#last-ability').val());

  if($('#nombreAbility').val() == ""){
    mostrarTodos();
    $('#last-ability').text("");
    $('#last-ability').val("");
  }
  //console.log(li.val());
});*/

//$('#newAbility').addEventListener('click', onClickCreateAbility);
/*document.getElementById("frmSubmit").onsubmit = function onSubmit(form) {
  console.log("submit");
  return;
}*/

function jsonH() {
  var inputs = $('input#nombreAbility');
  var localVal;
  var array = [];
  var json;
  for (var i = 0; i < inputs.length; i++) {
    localVal = ($($('input#nombreAbility')[i]).val() );
    array.push(localVal);
  }

  json = JSON.stringify(array); 
  console.log(json);

  $('#Habilidadesjson').val(json);

  return "0";
  }

  function jsonA() {
  var inputs = $('input#nombreAbility');
  var localVal;
  var array = [];
  var json;
  for (var i = 0; i < inputs.length; i++) {
    localVal = ($($('input#nombreAbility')[i]).val() );
    array.push(localVal);
  }

  json = JSON.stringify(array); 
  console.log(json);

  $('#Actitudesjson').val(json);

  return "0";
  }

function jsonO() {
  var conocimientos = $('input#nombreConocimiento');
  var indicadores = $('input#indicador');
  var localVal;

  var arrayConocimientos = [];
  var arrayIndicadores = [];
  var json;
  var json2;

  //conocimientos json
  for (var i = 0; i < conocimientos.length; i++) {
    localVal = ($($('input#nombreConocimiento')[i]).val() );
    arrayConocimientos.push(localVal);
  }
  //indicadores json
  for (var i = 0; i < indicadores.length; i++) {
    localVal = ($($('input#indicador')[i]).val() );
    arrayIndicadores.push(localVal);
  }

  json = JSON.stringify(arrayConocimientos); 
  json2 = JSON.stringify(arrayIndicadores); 
  console.log(json);
  console.log(json2);

  $('#Conocimientosjson').val(json);
  $('#Indicadoresjson').val(json2);

  return "0";
}

$('#newAbility').click(function() {
      onClickCreateAbility();

      //ingresar opciones nuevo dropdown
      ($('select')).editableSelect({ filter: false, effects: 'slide' });
      var opciones = $($('.es-list')[0]).html();
      var posNuevo = $('.es-list').length - 1;
      $($('.es-list')[posNuevo]).html(opciones);
});


function onClickCreateAbility() {
  //console.log("clickNewHabilidad");
  //var button    = event.target,
  var container = document.querySelector('#listado'),
      component;

  component = createAbilityComponent();
  container.appendChild(component);
}

function createAbilityComponent() {

  var elements    = [],
      rootElement = document.createElement('div');
      rootElement.className = "control-group";

  //elements.push('<div class="control-group">');
  //var nuevo = $($('.control-group')[0]).editableSelect({ filter: false, effects: 'slide' });
  //nuevo = $(nuevo).html();
  
  //var dropdown = ('<select id="nombreAbility" name="nombreAbility"><option value=""></option></select>');
  /*var dropdown = document.createElement("select");
  dropdown.id = "nombreAbility";
  dropdown.name = "nombreAbility";
  console.log(dropdown);*/

  //dropdown.editableSelect({ filter: false, effects: 'slide' });

  elements.push('<label class="control-label">Nombre</label>');
  //elements.push('<div class="controls">');
  elements.push('<div class="controls"><select id="nombreAbility" name="nombreAbility"></select></div>');
  //elements.push(dropdown);
  elements.push('</div>');
  //elements.push(nuevo);

  rootElement.innerHTML = elements.join('');
  
  return rootElement;
}


$('#newConocimiento').click(function() {
      onClickCreateConocimiento();

      //ingresar opciones nuevo dropdown
      ($('select#nombreConocimiento')).editableSelect({ filter: false, effects: 'slide' });
      var opciones = $($('.es-list')[2]).html();
      var posNuevo = $('.es-list').length - 1;
      $($('.es-list')[posNuevo]).html(opciones);
});


function onClickCreateConocimiento() {
  //console.log("clickNewHabilidad");
  //var button    = event.target,
  var container = document.querySelector('#listado'),
      component;

  component = createConocimientoComponent();
  container.appendChild(component);
}

function createConocimientoComponent() {

  var elements    = [],
      rootElement = document.createElement('div');
      rootElement.className = "control-group";


  elements.push('<label class="control-label">Conocimiento Previo</label>');
  //elements.push('<div class="controls">');
  elements.push('<div class="controls"><select id="nombreConocimiento" name="nombreConocimiento"></select></div>');
  //elements.push(dropdown);
  elements.push('</div>');
  //elements.push(nuevo);

  rootElement.innerHTML = elements.join('');
  
  return rootElement;
}



$('#newIndicador').click(function() {
      onClickCreateIndicador();

      //ingresar opciones nuevo dropdown
      ($('select#indicador')).editableSelect({ filter: false, effects: 'slide' });
      var opciones = $($('.es-list')[3]).html();
      var posNuevo = $('.es-list').length - 1;
      $($('.es-list')[posNuevo]).html(opciones);
});


function onClickCreateIndicador() {
  //console.log("clickNewHabilidad");
  //var button    = event.target,
  var container = document.querySelector('#listado'),
      component;

  component = createIndicadorComponent();
  container.appendChild(component);
}

function createIndicadorComponent() {

  var elements    = [],
      rootElement = document.createElement('div');
      rootElement.className = "control-group";


  elements.push('<label class="control-label">Indicador Evaluación</label>');
  //elements.push('<div class="controls">');
  elements.push('<div class="controls"><select id="indicador" name="indicador"></select></div>');
  //elements.push(dropdown);
  elements.push('</div>');
  //elements.push(nuevo);

  rootElement.innerHTML = elements.join('');
  
  return rootElement;
}


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

/*$('#agregarHabilidad').click(function() {
      agregarHabilidad();
    });*/

function modalObjetivo(indice) {
    console.log("modalObjetivo");
    console.log(indice);
    var row = $("#RowObjetivo"+indice).val();
    var json = JSON.parse(row);
    console.log(json);
    //console.log(json['nombreObjetivo']);
    //console.log(json['nombreObjetivo']['idObj']);
    //console.log(row['nombreObjetivo']->idObj);
    //console.log(row);
    $("#nombreObjetivoEdit").val(json['nombreObjetivo']['NuevoNombre']);
    $("#actividadesEdit").val(json['actividades']['nombre']);

    var conocimientos = json['conocimientos'];
    //console.log(conocimientos);
    for (var i = 0; i < conocimientos.length; i++) {
      localCon = conocimientos[i]['nuevoNombre'];
      //console.log(localCon);
      //arrayConocimientos.push(localVal);
      $("#conocimientosEdit").val(localCon);
      //$("#conocimientosEdit").val($("#conocimientosEdit").val() + localCon); ver append p, o mejor nuevo input, para pasar a form..json?
    }
    //indicadoresEdit For
    var indicadores = json['indicadores'];
    //console.log(indicadores);
    for (var i = 0; i < indicadores.length; i++) {
      localIndicador = indicadores[i]['nuevoNombre'];
      //console.log(localIndicador);
      //arrayConocimientos.push(localVal);
      $("#indicadoresEdit").val(localIndicador);
      //$("#conocimientosEdit").val($("#conocimientosEdit").val() + localCon); ver append p, o mejor nuevo input, para pasar a form..json?
    }
    
    $("#evaluacionEdit").val(json['evaluacion']['nombre']);
    
    /*$("#nombreEdit").val($("#nombreUsuario"+indice).val());
    $("#correoEdit").val($("#correoUsuario"+indice).val());
    $("#tipoEdit").val($("#tipoUsuario"+indice).val());*/
    $("#myModal1").modal('show');
    return("0");
  }

function editarUsuario(indice) {
    console.log("editar")
    console.log(indice);
    $("#idEdit").val($("#id"+indice).val());
    $("#nombreEdit").val($("#nombreUsuario"+indice).val());
    $("#correoEdit").val($("#correoUsuario"+indice).val());
    $("#tipoEdit").val($("#tipoUsuario"+indice).val());
    $("#myModal1").modal('show');
    return("0");
  }

  function guardarCambios() {
    var id    = $("#idEdit").val();
    var name = $("#nombreEdit").val();
    var email = $("#correoEdit").val();
    var type  = $("#tipoEdit").val();
    //var token = '{{csrf_token()}}';
    var token = $("#token").val();

    var base_url = "<? echo base_url()?>";
    $.post(
      "guardarCambios",
      {
        id:id,
        name: name,
        email: email,
        type: type,
        _token:token
      },function(){
        $("#myModal1").modal('hide');
        $("#listado").hide('slow');
        //cambiar cargar datos
        cargarDatos();
        $("#listado").show('slow');
      }
    );
  }

  function cargarDatos(){
    var base_url = "<? echo base_url()?>";
    $.get(
      "users",
      {},
      function(url,data){
        $("#listado").html(url,data);
      }
    );
  }

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
        //probando en editar asincronia
        $.when(cargarDatos()).done(function(){
          $("#listado").show('slow');
        });
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

