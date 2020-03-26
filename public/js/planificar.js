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
        $('#last-objective').val(li.val());
        $('#idUnidadObjetivo').val(li.val());
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
  /*! jQuery Editable Select - v2.2.5 - https://github.com/indrimuska/jquery-editable-select - (c) 2016 Indri Muska - MIT */
//+function(a){EditableSelect=function(b,c){this.options=c,this.$select=a(b),this.$input=a('<input type="text" autocomplete="off">'),this.$list=a('<ul class="es-list">'),this.utility=new EditableSelectUtility(this),["focus","manual"].indexOf(this.options.trigger)<0&&(this.options.trigger="focus"),["default","fade","slide"].indexOf(this.options.effects)<0&&(this.options.effects="default"),isNaN(this.options.duration)&&["fast","slow"].indexOf(this.options.duration)<0&&(this.options.duration="fast"),this.$select.replaceWith(this.$input),this.$list.appendTo(this.options.appendTo||this.$input.parent()),this.utility.initialize(),this.utility.initializeList(),this.utility.initializeInput(),this.utility.trigger("created")},EditableSelect.DEFAULTS={filter:!0,effects:"default",duration:"fast",trigger:"focus"},EditableSelect.prototype.filter=function(){var b=0,c=this.$input.val().toLowerCase().trim();this.$list.find("li").addClass("es-visible").show(),this.options.filter&&(b=this.$list.find("li").filter(function(b,d){return a(d).text().toLowerCase().indexOf(c)<0}).hide().removeClass("es-visible").length,this.$list.find("li").length==b&&this.hide())},EditableSelect.prototype.show=function(){if(this.$list.css({top:this.$input.position().top+this.$input.outerHeight()-1,left:this.$input.position().left,width:this.$input.outerWidth()}),!this.$list.is(":visible")&&this.$list.find("li.es-visible").length>0){var b={"default":"show",fade:"fadeIn",slide:"slideDown"},c=b[this.options.effects];this.utility.trigger("show"),this.$input.addClass("open"),this.$list[c](this.options.duration,a.proxy(this.utility.trigger,this.utility,"shown"))}},EditableSelect.prototype.hide=function(){var b={"default":"hide",fade:"fadeOut",slide:"slideUp"},c=b[this.options.effects];this.utility.trigger("hide"),this.$input.removeClass("open"),this.$list[c](this.options.duration,a.proxy(this.utility.trigger,this.utility,"hidden"))},EditableSelect.prototype.select=function(a){this.$list.has(a)&&a.is("li.es-visible:not([disabled])")&&(this.$input.val(a.text()),this.options.filter&&this.hide(),this.filter(),this.utility.trigger("select",a))},EditableSelect.prototype.add=function(b,c,d,e){var f=a("<li>").html(b),g=a("<option>").text(b),h=this.$list.find("li").length;c=isNaN(c)?h:Math.min(Math.max(0,c),h),0==c?(this.$list.prepend(f),this.$select.prepend(g)):(this.$list.find("li").eq(c-1).after(f),this.$select.find("option").eq(c-1).after(g)),this.utility.setAttributes(f,d,e),this.utility.setAttributes(g,d,e),this.filter()},EditableSelect.prototype.remove=function(a){var b=this.$list.find("li").length;a=isNaN(a)?b:Math.min(Math.max(0,a),b-1),this.$list.find("li").eq(a).remove(),this.$select.find("option").eq(a).remove(),this.filter()},EditableSelect.prototype.clear=function(){this.$list.find("li").remove(),this.$select.find("option").remove(),this.filter()},EditableSelect.prototype.destroy=function(){this.$list.off("mousemove mousedown mouseup"),this.$input.off("focus blur input keydown"),this.$input.replaceWith(this.$select),this.$list.remove(),this.$select.removeData("editable-select")},EditableSelectUtility=function(a){this.es=a},EditableSelectUtility.prototype.initialize=function(){var b=this;b.setAttributes(b.es.$input,b.es.$select[0].attributes,b.es.$select.data()),b.es.$input.addClass("es-input").data("editable-select",b.es),b.es.$select.find("option").each(function(c,d){var e=a(d).remove();b.es.add(e.text(),c,d.attributes,e.data()),e.attr("selected")&&b.es.$input.val(e.text())}),b.es.filter()},EditableSelectUtility.prototype.initializeList=function(){var b=this;b.es.$list.on("mousemove","li:not([disabled])",function(){b.es.$list.find(".selected").removeClass("selected"),a(this).addClass("selected")}).on("mousedown","li",function(c){a(this).is("[disabled]")?c.preventDefault():b.es.select(a(this))}).on("mouseup",function(){b.es.$list.find("li.selected").removeClass("selected")})},EditableSelectUtility.prototype.initializeInput=function(){var b=this;switch(this.es.options.trigger){default:case"focus":b.es.$input.on("focus",a.proxy(b.es.show,b.es)).on("blur",a.proxy(b.es.hide,b.es));break;case"manual":}b.es.$input.on("input keydown",function(a){switch(a.keyCode){case 38:var c=b.es.$list.find("li.es-visible:not([disabled])"),d=c.index(c.filter("li.selected"));b.highlight(d-1),a.preventDefault();break;case 40:var c=b.es.$list.find("li.es-visible:not([disabled])"),d=c.index(c.filter("li.selected"));b.highlight(d+1),a.preventDefault();break;case 13:b.es.$list.is(":visible")&&(b.es.select(b.es.$list.find("li.selected")),a.preventDefault());break;case 9:case 27:b.es.hide();break;default:b.es.filter(),b.highlight(0)}})},EditableSelectUtility.prototype.highlight=function(a){var b=this;b.es.show(),setTimeout(function(){var c=b.es.$list.find("li.es-visible"),d=b.es.$list.find("li.selected").removeClass("selected"),e=c.index(d);if(c.length>0){var f=(c.length+a)%c.length,g=c.eq(f),h=g.position().top;g.addClass("selected"),f<e&&h<0&&b.es.$list.scrollTop(b.es.$list.scrollTop()+h),f>e&&h+g.outerHeight()>b.es.$list.outerHeight()&&b.es.$list.scrollTop(b.es.$list.scrollTop()+g.outerHeight()+2*(h-b.es.$list.outerHeight()))}})},EditableSelectUtility.prototype.setAttributes=function(b,c,d){a.each(c||{},function(a,c){b.attr(c.name,c.value)}),b.data(d)},EditableSelectUtility.prototype.trigger=function(a){var b=Array.prototype.slice.call(arguments,1),c=[a+".editable-select"];c.push(b),this.es.$select.trigger.apply(this.es.$select,c),this.es.$input.trigger.apply(this.es.$input,c)},Plugin=function(b){var c=Array.prototype.slice.call(arguments,1);return this.each(function(){var d=a(this),e=d.data("editable-select"),f=a.extend({},EditableSelect.DEFAULTS,d.data(),"object"==typeof b&&b);e||(e=new EditableSelect(this,f)),"string"==typeof b&&e[b].apply(e,c)})},a.fn.editableSelect=Plugin,a.fn.editableSelect.Constructor=EditableSelect}(jQuery);