<?php 
ob_start();
session_start();
require_once '../controller/controllerAlumno.php';
require_once '../controller/controllerParte.php';


//metodo que recoge un alumno específico 
$a = controllerAlumno::getAlumno($_GET['idUsu']);
?>


<html>
    <body>
        <form method='POST' action=''>
            <input type='submit' name='cerrar' value='Cerrar Sesion'>
            <input type='submit' name='inicio' value='Inicio'><br><br>
            
            <?php echo "Profesor: $_SESSION[nombreP] $_SESSION[apellidosP] <br>" ?>
            
            <h2>PARTE DE INCIDENCIAS</h2>
            
            <p><?php echo $_SESSION['nombreP'] ?> <?php echo $_SESSION['apellidosP'] ?> como profesor de este alumno/a <?php echo $a->nombre ?>
            <?php echo $a->apellidos ?> del grupo <?php echo $a->descripcion ?> ha cometido la siguiente falta:</p><br>
            
            <textarea name='motivo'></textarea><br><!-- comment -->
            <input type='submit' name='grabar' value='Grabar parte'>
        </form>
    </body>
</html>

<?php
if(isset($_POST['grabar'])){
    // si se pulsa grabar, pasa a un metodo que hace un insert en la tabla partes
    $a = controllerParte::insertParte($_SESSION['dniP'], $_POST['motivo'], $a->dni_a);
    if($a != null){
        header("Location: partes.php?insertado=true");
    } else {
        echo "fallo";
    }
   
}

if(isset($_POST['cerrar'])){
    session_unset();
    header("Location: index.php");
}

if(isset($_POST['inicio'])){
    header("Location: partes.php");
}

 ob_end_flush();
 ?>