async function iniciarCalendario(){
	$.ajax({
	        url: 'https://www.googleapis.com/calendar/v3/calendars/es.cl%23holiday%40group.v.calendar.google.com/events?key=AIzaSyAJmdGvoVv9ZMZq5N_-3yQZmobkeG0Dzus',
	        type: 'GET',
	        datatype: 'json',
	        data: {
		        // our hypothetical feed requires UNIX timestamps
		        start: Math.round(start.getTime() / 1000),
				end: Math.round(end.getTime() / 1000)
		      },headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }, success: function (response, callback) {
	            var feriados = [];
	            console.log("query");
	            console.log($(response['items']));
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
	            return feriados;
	    }
	});
}