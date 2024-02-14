<?php
ob_start();
session_start();
require_once '../controller/controllerAlumno.php';
require_once '../controller/controllerParte.php';

//un metodo que recoge un alumno en especifico
$a = controllerAlumno::getAlumno($_SESSION['idUsu']);

//un metodo que recoge todos los partes de ese alumno
$p = controllerParte::getPartes($_SESSION['idUsu'], $_SESSION['dniP']);
?>


<html>
    <body>
        <form method='POST' action=''>
            <input type='submit' name='cerrar' value='Cerrar Sesion'>
            <input type='submit' name='inicio' value='Inicio'><br><br>
        </form>

        <?php echo "Profesor: $_SESSION[nombreP] $_SESSION[apellidosP] <br>" ?>
        <?php echo "Historial de partes del alumno: $a->nombre $a->apellidos <br>" ?>

        <?php
        if($p != null){            
        ?>
        <table border='1px'>
            <tr>
                <td>Fecha</td>
                <td>Profesor</td>
                <td>Motivo</td>
                <td>Quitar parte</td>
            </tr>
            <?php           
           
                foreach ($p as $parte) {
                   echo "<tr>";
                   //el valor de la fecha (que está en UNIX) lo parseamos
                   $fecha = date("d-m-Y", $parte->time);
                   echo "<td>$fecha</td>";
                   echo "<td>$parte->nombre $parte->apellidos</td>";
                   echo "<td>$parte->motivo</td>";
                   echo "<td>";
                   echo "<form method='POST' action=''>";
                   if($_SESSION['dniP'] == $parte->dni_p){
                        echo "<input type='submit' name='quitar' value='Quitar'>";    
                   }                  
                   echo "<input type='hidden' name='idParte' value='$parte->id'>";
                   echo "</form>";
                   echo "</td>";
                   echo "</tr>";
                }
            } else {
                echo "<h2>EL USUARIO NO TIENE PARTES</h2>";
            }
            ?>

        </table>
    </body>
</html>

<?php

if(isset($_POST['quitar'])){
    controllerParte::deleteParte($_POST['idParte']);
    header("Location: historial.php");
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