$('#boton1').click(function(){
    
    $.post('funciones.php',{
        nombre:'Eduardo Sandoval',
        ciudad:'CDMX',
        edad:29,
        celular:'111111111'
    },
    function(datos,estado){
        /*alert("informacion: "+datos+"\nEstado: "+estado);*/
        $('#resultados').html(datos);
    })
})