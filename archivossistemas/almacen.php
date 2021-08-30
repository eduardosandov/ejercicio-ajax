<?php 
if (!isset($_SESSION)) {
  session_start();
} 
if ( isset($_SESSION['U_spprivilegio']) and in_array("a_alma", $_SESSION['U_spprivilegio'])) { 
	 
require_once('Connections/conexion2.php');
$menuactivo ='almacen';

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistema Teso</title>
  <link rel="shortcut icon" href="img/icono.png" type="image/x-icon">
  <meta name="author" content="Eduardo Sandoval">
  <!--Desarrollado por: Eduardo Sandoval -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="estilos/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
  <link rel="stylesheet" href="estilos/jquery.dataTables.min.css">
  <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <!-- modal -->
<div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Almacen</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form-editar">
              <div class="form-group">
                  <label for="">Numero de Teso: </label>
                  <input type="text" id="codbieninv" class="form-control">
                  <label for="">Item: </label>
                  <input type="text" id="nombien" class="form-control">
                  <label for="">Marca: </label>
                  <input type="text" id="codmarca" class="form-control">
                  <label for="">Modelo: </label>
                  <input type="text" id="codmodelo" class="form-control">
                  <label for="">Accesorios: </label>
                  <input type="text" id="accesorios" class="form-control">
                  <label for="">observaciones: </label>
                  <input type="text" id="observaciones" class="form-control">
                  <label for="">Anaquel: </label>
                  <input type="text" id="lugar" class="form-control">
                  <input type="hidden" id="idbien">
              </div>          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
        </div>
      </div>
    </div>
  </div>
  <!-- /modal -->
  <div class="wrapper">
    <header class="main-header">
      <?php include('header.php'); ?>
    </header>
    <?php 
    $activarmenu='registrar-fungible';
    include('aside.php');
    ?>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          <i class="fa fa-cubes"></i>Almacen Teso
        </h1>
      </section>
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-body">              
                  <div class="table-responsive">
                    <table id="servicios" width="100%" class="table table-bordered table-striped dt-responsive tablas">
                      <thead>
                        <tr class="titulotabla">
                          <td width="2%">N.</td>
                          <td width="6%">No. INFORME</td>
                          <td width="20%">EMPRESA</td>                          
                          <td width="25%">CARACTERISTICA</td>                                          
                          <td width="15%">ACCESORIOS</td>
                          <td width="10%">ENTREGA MUESTRA A:</td>
                          <td width="15%">OBSERVACIONES</td>
                          <td width="5%">LUGAR</td>
                          <td width="2%">-</td>
                        </tr>
                      </thead>
                    </table>
                  </div>   
               </div>
            </div>
          </div>
        </div>             
      </section>
    </div>
    <?php include('footer.html'); ?>
  </div>
  <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="plugins/fastclick/fastclick.js"></script>
  <script src="dist/js/app.min.js"></script>
  <script src="plugins/select2/select2.full.min.js"></script>
  <!-- DataTables -->
  <script src="plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        var funcion='listar';
       let datatable = $('#servicios').DataTable({
            "ajax": {
                "url": "controlador/almacenControlador.php",
                "method": "POST",
                "data": {funcion:funcion}
            },
        "columns": [
            { "data": "idbien" },
            { "data": "codbieninv" },
            { "data": "razonsocial"  },
            { "data": "nombien" },
            { "data": "accesorios" },
            { "data": "nombres" },
            { "data": "observaciones" },
            { "data": "lugar" },
            { "defaultContent": `<button class="editar btn btn-success" type="button" data-toggle="modal" data-target="#editar">Editar</button>`}
        ],
        "language": espanol
    });
    $('#servicios tbody').on('click','.editar', function(){
        let data = datatable.row($(this).parents()).data();
        $('#codbieninv').val(data.codbieninv);
        $('#nombien').val(data.nombien);
        $('#codmarca').val(data.codmarca);
        $('#codmodelo').val(data.codmodelo);
        $('#accesorios').val(data.accesorios);
        $('#observaciones').val(data.observaciones);
        $('#lugar').val(data.lugar);
        $('#idbien').val(data.idbien);
    })
    $('#form-editar').submit(e=>{
        let idbien =$('#idbien').val();
        let codbieninv=$('#codbieninv').val();
        let nombien=$('#nombien').val();
        let codmarca=$('#codmarca').val();
        let codmodelo=$('#codmodelo').val();
        let accesorios=$('#accesorios').val();
        let observaciones=$('#observaciones').val();
        let lugar=$('#lugar').val();
        funcion='editar';
        $.post('controlador/almacenControlador.php',{idbien,codbieninv,nombien,codmarca,codmodelo,accesorios,observaciones,lugar,funcion},(response)=>{

        })

    })
} );
    let espanol = {
    "aria": {
        "sortAscending": "Activar para ordenar la columna de manera ascendente",
        "sortDescending": "Activar para ordenar la columna de manera descendente"
    },
    "autoFill": {
        "cancel": "Cancelar",
        "fill": "Rellene todas las celdas con <i>%d<\/i>",
        "fillHorizontal": "Rellenar celdas horizontalmente",
        "fillVertical": "Rellenar celdas verticalmente"
    },
    "buttons": {
        "collection": "Colección",
        "colvis": "Visibilidad",
        "colvisRestore": "Restaurar visibilidad",
        "copy": "Copiar",
        "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
        "copySuccess": {
            "1": "Copiada 1 fila al portapapeles",
            "_": "Copiadas %d fila al portapapeles"
        },
        "copyTitle": "Copiar al portapapeles",
        "csv": "CSV",
        "excel": "Excel",
        "pageLength": {
            "-1": "Mostrar todas las filas",
            "_": "Mostrar %d filas"
        },
        "pdf": "PDF",
        "print": "Imprimir"
    },
    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
    "infoThousands": ",",
    "lengthMenu": "Mostrar _MENU_ registros",
    "loadingRecords": "Cargando...",
    "paginate": {
        "first": "Primero",
        "last": "Último",
        "next": "Siguiente",
        "previous": "Anterior"
    },
    "processing": "Procesando...",
    "search": "Buscar:",
    "searchBuilder": {
        "add": "Añadir condición",
        "button": {
            "0": "Constructor de búsqueda",
            "_": "Constructor de búsqueda (%d)"
        },
        "clearAll": "Borrar todo",
        "condition": "Condición",
        "deleteTitle": "Eliminar regla de filtrado",
        "leftTitle": "Criterios anulados",
        "logicAnd": "Y",
        "logicOr": "O",
        "rightTitle": "Criterios de sangría",
        "title": {
            "0": "Constructor de búsqueda",
            "_": "Constructor de búsqueda (%d)"
        },
        "value": "Valor",
        "conditions": {
            "date": {
                "after": "Después",
                "before": "Antes",
                "between": "Entre",
                "empty": "Vacío",
                "equals": "Igual a",
                "not": "Diferente de",
                "notBetween": "No entre",
                "notEmpty": "No vacío"
            },
            "number": {
                "between": "Entre",
                "empty": "Vacío",
                "equals": "Igual a",
                "gt": "Mayor a",
                "gte": "Mayor o igual a",
                "lt": "Menor que",
                "lte": "Menor o igual a",
                "not": "Diferente de",
                "notBetween": "No entre",
                "notEmpty": "No vacío"
            },
            "string": {
                "contains": "Contiene",
                "empty": "Vacío",
                "endsWith": "Termina con",
                "equals": "Igual a",
                "not": "Diferente de",
                "startsWith": "Inicia con",
                "notEmpty": "No vacío"
            },
            "array": {
                "equals": "Igual a",
                "empty": "Vacío",
                "contains": "Contiene",
                "not": "Diferente",
                "notEmpty": "No vacío",
                "without": "Sin"
            }
        },
        "data": "Datos"
    },
    "searchPanes": {
        "clearMessage": "Borrar todo",
        "collapse": {
            "0": "Paneles de búsqueda",
            "_": "Paneles de búsqueda (%d)"
        },
        "count": "{total}",
        "emptyPanes": "Sin paneles de búsqueda",
        "loadMessage": "Cargando paneles de búsqueda",
        "title": "Filtros Activos - %d",
        "countFiltered": "{shown} ({total})"
    },
    "select": {
        "cells": {
            "1": "1 celda seleccionada",
            "_": "$d celdas seleccionadas"
        },
        "columns": {
            "1": "1 columna seleccionada",
            "_": "%d columnas seleccionadas"
        }
    },
    "thousands": ",",
    "datetime": {
        "previous": "Anterior",
        "hours": "Horas",
        "minutes": "Minutos",
        "seconds": "Segundos",
        "unknown": "-",
        "amPm": [
            "am",
            "pm"
        ],
        "next": "Siguiente",
        "months": {
            "0": "Enero",
            "1": "Febrero",
            "10": "Noviembre",
            "11": "Diciembre",
            "2": "Marzo",
            "3": "Abril",
            "4": "Mayo",
            "5": "Junio",
            "6": "Julio",
            "7": "Agosto",
            "8": "Septiembre",
            "9": "Octubre"
        },
        "weekdays": [
            "Domingo",
            "Lunes",
            "Martes",
            "Miércoles",
            "Jueves",
            "Viernes",
            "Sábado"
        ]
    },
    "editor": {
        "close": "Cerrar",
        "create": {
            "button": "Nuevo",
            "title": "Crear Nuevo Registro",
            "submit": "Crear"
        },
        "edit": {
            "button": "Editar",
            "title": "Editar Registro",
            "submit": "Actualizar"
        },
        "remove": {
            "button": "Eliminar",
            "title": "Eliminar Registro",
            "submit": "Eliminar",
            "confirm": {
                "_": "¿Está seguro que desea eliminar %d filas?",
                "1": "¿Está seguro que desea eliminar 1 fila?"
            }
        },
        "multi": {
            "title": "Múltiples Valores",
            "restore": "Deshacer Cambios",
            "noMulti": "Este registro puede ser editado individualmente, pero no como parte de un grupo.",
            "info": "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, haga click o toque aquí, de lo contrario conservarán sus valores individuales."
        },
        "error": {
            "system": "Ha ocurrido un error en el sistema (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\"> Más información<\/a>)."
        }
    },
    "decimal": ".",
    "emptyTable": "No hay datos disponibles en la tabla",
    "info": "Mostrando de _START_ al _END_ de  _TOTAL_ registros",
    "zeroRecords": "No se encontraron coincidencias"
};
   
    </script>


  <script>
  $(function() {
    $(".select2").select2();
  });
  </script>
</body>

</html>
<?php }else{
header("Location: pagina-restringida.php");
}?>