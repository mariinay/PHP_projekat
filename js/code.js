$('#dodajForm').submit(function(){
    event.preventDefault();
    console.log("Dodavanje");
    const $form =$(this);
    const $input = $form.find('input, select, button, textarea');

    const serijalizacija = $form.serialize();
    console.log(serijalizacija);

    $input.prop('disabled', true);

    request = $.ajax({
        url: 'handler/add.php',
        type:'post',
        data: serijalizacija
    });

    request.done(function(response, textStatus, jqXHR){

        console.log(response);

        
        if(response == "Success"){
            alert("Trening uspešno zakazan");
            console.log("Trening zakazan");
            location.reload(true);
        }else console.log("Trening nije zakazan " + response);
        console.log(response);
      
    });

    request.fail(function(jqXHR, textStatus, errorThrown){
        console.error('Error: '+textStatus, errorThrown)
    });
});

$('#btn-izmeni').click(function () {

    
    const checked = $('input[name=cekiranje]:checked');
    //pristupa informacijama te konkretne forme i popunjava dijalog
    request = $.ajax({
        url: 'handler/get.php',
        type: 'post',
        data: {'id': checked.val()},
        dataType: 'json'
    });


    request.done(function (response, textStatus, jqXHR) {
        console.log('Popunjena');
        $('#teretana').val(response[0]['teretana']);
        console.log(response[0]['teretana']);

        $('#lokacija').val(response[0]['lokacija'].trim());
        console.log(response[0]['lokacija'].trim());

        $('#datum').val(response[0]['datum'].trim());
        console.log(response[0]['datum'].trim());

        $('#vreme').val(response[0]['vreme'].trim());
        console.log(response[0]['vreme'].trim());

        $('#id').val(checked.val());

        console.log(response);
    });

   request.fail(function (jqXHR, textStatus, errorThrown) {
       console.error('Error: ' + textStatus, errorThrown);
   });

});

//dugme za slanje UPDATE zahteva nakon popunjene forme
$('#izmeniForm').submit(function () {
    event.preventDefault();
  
    console.log("Nove vrednosti");
    const $form = $(this);
    const $inputs = $form.find('input, select, button, textarea');
    const serializedData = $form.serialize();
    console.log(serializedData);
    $inputs.prop('disabled', true);

    
    request = $.ajax({
        url: 'handler/update.php',
        type: 'post',
        data: serializedData
      
    });

    request.done(function (response,textStatus,jqXHR) {


        if (response == "Success") {
            console.log('Trening je azuriran');
            location.reload(true);
            $('#izmeniForm').reset;
        }
        else console.log('Trening nije azuriran ' + response);
        console.log(response);
    });

    request.fail(function (jqXHR,textStatus, errorThrown) {
        console.error('Error: ' + textStatus, errorThrown);
    });


    
    $('#azurirajModal').modal('hide');
});


$('#btn-obrisi').click(function(){
    console.log("Brisanje");

    const checked = $('input[name=cekiranje]:checked');

    req = $.ajax({
        url: 'handler/delete.php',
        type:'post',
        data: {'id':checked.val()}
    });

    req.done(function(res, textStatus, jqXHR){
        if(res=='Success'){
           checked.closest('tr').remove();
           alert('Trening je otkazan');
           console.log('Obrisan');
        }else {
        console.log("Trening nije otkazan "+res);
        alert("Trening nije otkazan");

        }
        console.log(res);
    });

});

$('#vidi').click(function () {
    $('#pregled').toggle();
});

$('#btnUnesi').submit(function () {
    $('#prikaziModal').modal('toggle');
    return false;
});
