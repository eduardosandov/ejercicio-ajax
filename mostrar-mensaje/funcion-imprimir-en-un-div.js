$('#boton1').click(function(){
    $.get('mensaje-con.php',function(mensaje,estado){
       /* alert("Mensaje mostrado: "+mensaje+'\nEstado: '+estado);*/
        $('#resultados').html(mensaje);
    })
})