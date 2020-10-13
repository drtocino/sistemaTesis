<?php
require_once("../Controlador/LNListaCarrera.php");
$objetoCarrera = new LNListaCarrera();
$facultad="";
$lista = $objetoCarrera->listaCarrera($facultad);

if(isset($_POST['idFacultad'])){
    $facultad = $_POST['idFacultad'];
    $lista = $objetoCarrera->listaCarrera($facultad);
}

if($lista){
?>
    <option value="" selected disabled>Seleccione una Carrera</option>
<?php
    foreach($lista as $dato){
?>
    <option value="<?php echo $dato['idCarrera']?>"><?php echo $dato['nombre']?></option>
<?php
    }
}else{
?>
    <option value="">Selecciona una facultad</option>
<?php
}
?>