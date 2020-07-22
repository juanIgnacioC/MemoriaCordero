console.log("feriadosJS");
$('#feriados').change(function() {
  console.log("feriados");

  var array = $('#feriados').val();
  //console.log(array);
  json = JSON.parse(array); 
  console.log(json);


  console.log("agregar");
  //$('#fullcalendar').fullCalendar('addEventSource', json);
  //$('#fullcalendar').fullCalendar('refetchEvents');
  //$('#fullcalendar').fullCalendar('refetchEventSources', json);
  //$('#fullcalendar').fullCalendar('render');
});