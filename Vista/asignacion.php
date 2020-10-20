<?php
require_once("../Controlador/LNListaUsuario.php");
$usuario = new LNListaUsuario();
$persona = "";
$asignacionCarrera = $usuario->datosAsignacionCarrera($persona);


if(isset($_REQUEST['idPersona'])){
    $persona = $_REQUEST['idPersona'];
    $asignacionCarrera = $usuario->datosAsignacionCarrera($persona);
}

if($asignacionCarrera){ ?>
    <option value="" selected disabled>Seleccione una asignacion</option>
    <?php foreach($asignacionCarrera as $datos){?>
        <option value="<?php echo $datos['idAsignacionCarrera']?>"><?php echo $datos['idCarrera']?></option>
    <?php }?>
<?php }?>