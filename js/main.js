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
        
        if(response == "Success"){
            alert("Trening uspešno zakazan");
            console.log("Trening zakazan");
            location.reload(true);
        }else console.log("Trening nije zakazan " + response);
        console.log(response);
      
    });

    request.fail(function(jqXHR, textStatus, errorThrown){
        console.error('Sledeca greska se desila> '+textStatus, errorThrown)
    });
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
