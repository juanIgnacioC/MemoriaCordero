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