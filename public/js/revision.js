$('#aceptada').bootstrapToggle({
  on: 'Aceptada',
  off: 'Rechazada'
});
$('#estadoPlani').val($('#aceptada').prop('checked'));

$('#aceptada').change(function() {
  var estado = $('#aceptada').prop('checked');
  $('#estadoPlani').val(estado);
});