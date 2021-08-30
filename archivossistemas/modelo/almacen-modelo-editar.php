<?php
include_once '../Connections/conexion2.php';
class laboratorio{
    var $laboratorios;
    public function __construct(){
        $this->acceso = conexion::conectar();
    }
    function mostrar(){
        $sql="SELECT  bien.idbien, bien.codbiencat, bien.codbieninv, bien.codbiencat, 
        bien.codmarca, bien.codmodelo, bien.segui, bien.idproveedor, 
        bien.fechaadq, bien.tiempovida, bien.codcolor,
        bien.accesorios, bien.lugar,
        bien.observaciones,
        biencatalogo.nombien,         
        familiabien.codfamiliabien,
        proveedor.codproveedor, proveedor.razonsocial, proveedor.personacontacto,  
        usuario.nombres, 
        usuario.apellidos, 
        licencia.idusuario 
        FROM bien 
        inner join biencatalogo on bien.codbiencat = biencatalogo.codbiencat 
        left join familiabien on familiabien.idfamiliabien = bien.idfamiliabien         
        left join licencia on licencia.id_bien = bien.idbien 
        left join usuario on usuario.idusuario = licencia.idusuario
        left join proveedor on proveedor.idproveedor = bien.idproveedor ";
        $resultado = $this->acceso->query($sql);
        $this->laboratorios = $resultado->fetch_all(MYSQLI_ASSOC);
        return $this->laboratorios;
    }

    function editar($idbien,$accesorios,$observaciones,$lugar){
        $sql="UPDATE bien SET accesorios='$accesorios', observaciones='$observaciones', lugar='$lugar' where idbien='$idbien'";
        $resultado = $this->acceso->query($sql);
    }
}
?>