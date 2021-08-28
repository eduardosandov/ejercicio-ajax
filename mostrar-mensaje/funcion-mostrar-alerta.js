function mifuncion(){
    $.get('./mensaje-con.php',function(informacion,estado){
        alert('Mensaje de php: '+informacion+'\nEstado: '+estado);
    })
}