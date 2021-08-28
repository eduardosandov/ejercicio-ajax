function mifuncion(){
    $.get('./funciones.php',function(informacion,estado){
        alert('Informacion de php: '+informacion+'\nEstado:'+estado);
    })
}