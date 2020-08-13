
$(document).ready(function(){
	var promesa1 =	$.ajax({
	        url: 'https://www.googleapis.com/calendar/v3/calendars/es.cl%23holiday%40group.v.calendar.google.com/events?key=AIzaSyAJmdGvoVv9ZMZq5N_-3yQZmobkeG0Dzus',
	        type: 'GET',
	        datatype: 'json',
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }, success: function (response, callback) {
	            /*var feriados = [];
	            console.log("query");
	            /*console.log($(response['items']));
	            console.log($(response['items']['0'])  );


	            $(response['items']).each(function (i, val) {
	        	//console.log(i + val['start']['date']);
	            feriados.push({
	                id: val['id'],
	                title: val['summary'],
	                start: val['start']['date'],
	                end: val['end']['date']
	            });
	        });
	            console.log("envets");
	            var json = JSON.stringify(feriados);
	            $('#feriados').val(json).trigger('change');
	            console.log(feriados);
	            return feriados;*/
	    }
	});

	//console.log("waiting");
	$.when (promesa1).done(function (response) {
	            var feriados = [];
	            //console.log("query");
	            /*console.log($(response['items']));
	            console.log($(response['items']['0'])  );*/


	            $(response['items']).each(function (i, val) {
	        	//console.log(i + val['start']['date']);
	            feriados.push({
	                id: val['id'],
	                title: val['summary'],
	                start: val['start']['date'],
	                allDay: true,
	                overlap: false
	            });
	        });
	            //console.log("envets!!!!!");
	            var json = JSON.stringify(feriados);
	            $('#feriados').val(json).trigger('change');
	            //console.log(feriados);



	            maruti.init(feriados);
	
				$('#add-event-submit').click(function(){
					maruti.add_event();
				});
				
				$('#event-name').keypress(function(e){
					if(e.which == 13) {	
						maruti.add_event();
					}
				});

	            return feriados;
	    })
	//var fds = await iniciarCalendario();
	//console.log(fds);
	//console.log("go");

		
});

maruti = {
	
	// === Initialize the fullCalendar and external draggable events === //
	init: function(feriados) {	
		// Prepare the dates
		var date = new Date();

		/*var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();	

		var h = date.getHours();	
		var min = date.getMinutes();	
		var s = date.getSeconds();	

		console.log("parse date");
		console.log(d);
		console.log(m);
		console.log(y);
		console.log(h);
		console.log(min);
		console.log(s);

		console.log("dateN");
		var dateN = String(`${y}-${m}-${d} ${h}:${min}:${s}`);
		console.log(dateN);*/

		var clasesBD = $("#clases").val();
		var clasesJson = JSON.parse(clasesBD);
		//.log("clasesBD");
		//console.log(clasesBD);
		//console.log(clasesJson);
		//var events = [];
      	/*events.push({
	        title: $(this).attr('title'),
	        start: $(this).attr('start') // will be parsed
      	});*/
		
		$('#fullcalendar').fullCalendar({
			slotDuration: '00:15:00',
            minTime: '08:00:00',
            maxTime: '20:00:00',
            defaultView: 'month',
            handleWindowResize: true,
			header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay,listWeek'
            },
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar !!!
            eventLimit: true, // allow "more" link when too many events
            selectable: true,

            //googleCalendarApiKey: 'AIzaSyAJmdGvoVv9ZMZq5N_-3yQZmobkeG0Dzus',
            //Leer BD
            //events:
            //events: 'es.cl#holiday@group.v.calendar.google.com',

            eventSources: [
		    {
	            //Eventos clases BD
		        events: clasesJson
		    },

		    {
		        events: feriados,
		        color: 'green',
		        overlap: false,
		        editable: false,
		        startEditable: false,
		        resourceEditable: false,
		        durationEditable: false,
		        eventOverlap: false,
		    }

			],
            //events: clasesJson,

            //Al soltar un evento desde la lista
			drop: function(date, allDay) { 
				//Guardar BD
				// retrieve the dropped element's stored Event Object
				var originalEventObject = $(this).data('eventObject');
					
				// we need to copy it, so that multiple events don't have a reference to the same object
				var copiedEventObject = $.extend({}, originalEventObject);
					
				// assign it the date that was reported
				copiedEventObject.start = date;
				copiedEventObject.allDay = allDay;


				//console.log("copiedEvent");
				//console.log(copiedEventObject);

				//Guardar BD Ajax
				json = copiedEventObject['json'];
				//console.log(json);

				var token = $("#token").val();
				//var idFc = json[]
				var start = copiedEventObject.start;
				var end = copiedEventObject.end;
				///console.log("startPrev");
				///console.log(start);
				//console.log(start.toISOString());
				//console.log(start.toGMTString());

				var d = start.getDate();
				var m = start.getMonth() + 1;
				var y = start.getFullYear();	

				var h = start.getHours();	
				var min = start.getMinutes();	
				var s = start.getSeconds();	

				/*console.log("parse date");
				console.log(d);
				console.log(m);
				console.log(y);
				console.log(h);
				console.log(min);
				console.log(s);*/

				//console.log("dateN");
				var dateN = String(`${y}-${m}-${d} ${h}:${min}:${s}`);
				//console.log(dateN);
				start = dateN;


				/*start = start.toISOString().
				  replace(/T/, ' ').      // replace T with a space
				  replace(/\..+/, '')     // delete the dot and everything after*/

				//console.log("start");
				//console.log(start);

				var title = copiedEventObject.title;
				var description = copiedEventObject.description;

				var allDay = copiedEventObject.allDay;
				//console.log(allDay);
				if(allDay ==false){
					allDay = 0;
				}
				else{
					allDay = 1;
				}

				var idInstanciaUnidad = json['idInstanciaUnidad'];
				var idInstanciaUnidadObjetivo = json['evaluacion']['idInstanciaUnidadObjetivo'];

				copiedEventObject.idInstanciaUnidad = idInstanciaUnidad;
				copiedEventObject.idInstanciaUnidadObjetivo = idInstanciaUnidadObjetivo;



			    var base_url = "<? echo base_url()?>";
			    $.post(
			      "createClase",
			      {
			        start: start,
			        end: end,
			        title: title,
			        description: description,
			        allDay: allDay,
			        idInstanciaUnidad: idInstanciaUnidad,
			        idInstanciaUnidadObjetivo: idInstanciaUnidadObjetivo,
			        _token:token
			      },function(url, data){

			      	//Actualizar id interfaz calendar con id clase BD
			      	//console.log(url);
			      	var idInstanciaNuevaClase = url['id'];

			      	copiedEventObject.id = idInstanciaNuevaClase;
			      	copiedEventObject._id = idInstanciaNuevaClase;
			      	$('#fullcalendar').fullCalendar('updateEvent', copiedEventObject);
			      	$('#fullcalendar').fullCalendar('renderEvent', copiedEventObject, true);

			        //$("#myModal1").modal('hide');
			        //$("#listado").hide('slow');
			        //cambiar cargar datos
			        /////cargarDatos();
			        //$("#listado").show('slow');
			      }
			    );
					
				// render the event on the calendar
				// the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
				$('#fullcalendar').fullCalendar('updateEvent', copiedEventObject);
				$('#fullcalendar').fullCalendar('renderEvent', copiedEventObject, true);
					
				// is the "remove after drop" checkbox checked?
				
					// if so, remove the element from the "Draggable Events" list
					//comentado para no remover
					//$(this).remove(); 
				
			},
			//Renderizado para evento, evento al pasar el mouse por encima
			eventRender: function(eventObj, $el) {
            	console.log("render");
            	//console.log(eventObj);
            	$el.popover({
            		title: eventObj.title,
			        content: eventObj.description,
			        trigger: 'hover',
			        placement: 'bottom',
			        container: 'body'
		      	});
		    },

		    //Se arrastra evento y se suelta
			eventDrop: function(event, delta, revertFunc) {
				//Actualizar BD
			    ///console.log("drop drag");
			    ///console.log(event);
			    //console.log(delta);
			    //console.log(revertFunc);

				var token = $("#token").val();

				//Parse dates
				var start = event.start;
				var end = event.end;

				var d = start.getDate();
				var m = start.getMonth() + 1;
				var y = start.getFullYear();	

				var h = start.getHours();	
				var min = start.getMinutes();	
				var s = start.getSeconds();	

				var dateN = String(`${y}-${m}-${d} ${h}:${min}:${s}`);

				//Parse date
				//var dateN = this.parseDate(start);
				//var dateEnd = this.parseDate(end);

				//console.log(dateN);
				start = dateN;

				if(end != null){
					var d = end.getDate();
					var m = end.getMonth() + 1;
					var y = end.getFullYear();	

					var h = end.getHours();	
					var min = end.getMinutes();	
					var s = end.getSeconds();	

					var dateEnd = String(`${y}-${m}-${d} ${h}:${min}:${s}`);
					//console.log(dateEnd);
					
					end = dateEnd;
				}

				var title = event.title;
				var description = event.description;

				var allDay = event.allDay;
				//console.log(allDay);
				if(allDay == false){
					allDay = 0;
				}
				else if(allDay == true){
					allDay = 1;
				}

				var idInstanciaUnidad = event.idInstanciaUnidad;
				var idInstanciaUnidadObjetivo = event.idInstanciaUnidadObjetivo;
				var idInstanciaClase = event.id;

			    var base_url = "<? echo base_url()?>";
			    $.post(
			      "updateClase",
			      {
			      	idInstanciaClase: idInstanciaClase,
			        start: start,
			        end: end,
			        title: title,
			        description: description,
			        allDay: allDay,
			        idInstanciaUnidad: idInstanciaUnidad,
			        idInstanciaUnidadObjetivo: idInstanciaUnidadObjetivo,
			        _token:token
			      },function(){
			        //$("#myModal1").modal('hide');
			        //$("#listado").hide('slow');
			        //cambiar cargar datos
			        /////cargarDatos();
			        //$("#listado").show('slow');
			      }
			    );

			  },

			  //Clase se cambia su tamaño
			  eventResize: function(event, delta, revertFunc) {
			  	//Update Clase BD
			  	///console.log("event resize");
			  	///console.log(event);
			    //console.log(delta);
			    //console.log(revertFunc);

				var token = $("#token").val();

				//Parse dates
				var start = event.start;
				var end = event.end;

				var d = start.getDate();
				var m = start.getMonth() + 1;
				var y = start.getFullYear();	

				var h = start.getHours();	
				var min = start.getMinutes();	
				var s = start.getSeconds();	

				var dateN = String(`${y}-${m}-${d} ${h}:${min}:${s}`);

				//Parse date
				//var dateN = this.parseDate(start);
				//var dateEnd = this.parseDate(end);

				//console.log(dateN);
				start = dateN;

				if(end != null){
					var d = end.getDate();
					var m = end.getMonth() + 1;
					var y = end.getFullYear();	

					var h = end.getHours();	
					var min = end.getMinutes();	
					var s = end.getSeconds();	

					var dateEnd = String(`${y}-${m}-${d} ${h}:${min}:${s}`);
					//console.log(dateEnd);
					
					end = dateEnd;
				}

				var idInstanciaClase = event.id;

			    var base_url = "<? echo base_url()?>";
			    $.post(
			      "updateClaseTime",
			      {
			      	idInstanciaClase: idInstanciaClase,
			        start: start,
			        end: end,
			        _token:token
			      },function(){
			        //$("#myModal1").modal('hide');
			        //$("#listado").hide('slow');
			        //cambiar cargar datos
			        /////cargarDatos();
			        //$("#listado").show('slow');
			      }
			    );
			  },

			  //modal click clase
			  eventClick: function(calEvent, jsEvent, view) {
			    console.log(calEvent);
			    var color = calEvent['source']['color'];

			    //si no corresponde a un feriado (color verde)
			    if(color != "green"){

				    //resetear click listener para guardar solo el ultimo clickeado
				    $("#myModalEvent button.btn-success").off('click');
				    $("#myModalEvent button.btn-danger").off('click');
				    //console.log(jsEvent);
				    //console.log(view);

				    $("#idEdit").val(calEvent.id);
				    $("#contenidosEdit").val(calEvent.contenidos);
				    $("#recursosEdit").val(calEvent.recursos);
				    $("#inicioEdit").val(calEvent.inicio);
				    $("#desarrolloEdit").val(calEvent.desarrollo);
				    $("#cierreEdit").val(calEvent.cierre);

				    $("#myModalEvent").modal('show');

				    //Guardar button
				    $("#myModalEvent button.btn-success").on('click', function() {
				    	console.log("Guardar datos clase");
				    	console.log(calEvent.title);
		                //calEvent.title = "holi";
		                //Actualizar datos evento
		                calEvent.contenidos = $("#contenidosEdit").val();
		                calEvent.recursos = $("#recursosEdit").val();
		                calEvent.inicio = $("#inicioEdit").val();
		                calEvent.desarrollo = $("#desarrolloEdit").val();
		                calEvent.cierre = $("#cierreEdit").val();

		                $('#fullcalendar').fullCalendar('updateEvent', calEvent);

		                //Actualizar clase detail BD
		                var token = $("#token").val();
						var idInstanciaClase = calEvent.id;

					    var base_url = "<? echo base_url()?>";
					    $.post(
					      "updateClaseDetail",
					      {
					      	idInstanciaClase: idInstanciaClase,
					        contenidos: calEvent.contenidos,
					        recursos: calEvent.recursos,
					        inicio: calEvent.inicio,
					        desarrollo: calEvent.desarrollo,
					        cierre: calEvent.cierre,
					        _token:token
					      },function(){
					        //$("#myModal1").modal('hide');
					        //$("#listado").hide('slow');
					        //cambiar cargar datos
					        /////cargarDatos();
					        //$("#listado").show('slow');
					      }
					    );
		                //Ocultar modal y remover eventHandler
		                $("#myModalEvent").modal('hide');
		                $("#myModalEvent button.btn-success").off('click');
	                	return("0");
	            	});

				    //Eliminar button
	            	$("#myModalEvent button.btn-danger").on('click', function() {
				    	console.log("Eliminar datos clase");
				    	console.log(calEvent);
				    	console.log(calEvent.id);
		                //calEvent.title = "holi";

						$('#fullcalendar').fullCalendar('removeEvents', calEvent.id);


		                //Delete clase BD
		                var token = $("#token").val();
						var idInstanciaClase = calEvent.id;

					    var base_url = "<? echo base_url()?>";
					    $.post(
					      "deleteClase",
					      {
					      	idInstanciaClase: idInstanciaClase,
					        _token:token
					      },function(){
					        //$("#myModal1").modal('hide');
					        //$("#listado").hide('slow');
					        //cambiar cargar datos
					        /////cargarDatos();
					        //$("#listado").show('slow');
					      }
					    );

		                //Ocultar modal y remover eventHandler
		                $("#myModalEvent").modal('hide');
		                $("#myModalEvent button.btn-success").off('click');
		                $("#myModalEvent button.btn-danger").off('click');
	                	return("0");
	            	});


				   }
			}
		});
		this.external_events();		
	},
	
	// === Adds an event if name is provided === //
	add_event: function(){
		if($('#event-name').val() != '') {
			var event_name = $('#event-name').val();
			$('#external-events .panel-content').append('<div class="external-event ui-draggable label label-inverse">'+event_name+'</div>');
			this.external_events();
			$('#modal-add-event').modal('hide');
			$('#event-name').val('');
		} else {
			this.show_error();
		}
	},
	
	// === Initialize the draggable external events === //
	external_events: function(){
		/* initialize the external events
		-----------------------------------------------------------------*/
		var indice = 0;
		$('#external-events div.external-event').each(function() {		
			// create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
			// it doesn't need to have a start or end
			var row = $("#RowObjetivo"+indice).val();
    		var json = JSON.parse(row);
    		//console.log("ext");
    		//console.log(json['nombreObjetivo']['NuevoNombre']);

			var eventObject = {
				title: $.trim($(this).text()), // use the element's text as the event title
				description: json['nombreObjetivo']['NuevoNombre'],
				json: json
			};
				
			// store the Event Object in the DOM element so we can get to it later
			$(this).data('eventObject', eventObject);
				
			// make the event draggable using jQuery UI
			$(this).draggable({
				zIndex: 999,
				revert: true,      // will cause the event to go back to its
				revertDuration: 0  //  original position after the drag
			});		
			indice = indice + 1;
		});		
	},
	
	// === Show error if no event name is provided === //
	show_error: function(){
		$('#modal-error').remove();
		$('<div style="border-radius: 5px; top: 70px; font-size:14px; left: 50%; margin-left: -70px; position: absolute;width: 140px; background-color: #f00; text-align: center; padding: 5px; color: #ffffff;" id="modal-error">Enter event name!</div>').appendTo('#modal-add-event .modal-body');
		$('#modal-error').delay('1500').fadeOut(700,function() {
			$(this).remove();
		});
	},

	parseDate: function(date){
		var d = date.getDate();
		var m = date.getMonth() + 1;
		var y = date.getFullYear();	

		var h = date.getHours();	
		var min = date.getMinutes();	
		var s = date.getSeconds();	

		var dateN = String(`${y}-${m}-${d} ${h}:${min}:${s}`);
		return dateN;
	}
	
};
