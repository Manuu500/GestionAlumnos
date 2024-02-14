<?php
ob_start();
session_start();
require_once '../controller/controllerCurso.php';
require_once '../controller/controllerAlumno.php';
?>
<html>
    <body>
        <h1>LOGIN</h1>

        <form method='POST' action=''>
            <input type='submit' name='cerrar' value='Cerrar Sesion'><br><br>

            
            <?php
            //esto es una variable pasada por un header, de manera que si insertado existe, sale un mensaje dicciendo que el usuario se ha registrado
            if (isset($_GET['insertado'])) {
                echo "<p style='color:green'>El parte ha sido registrado</p>";
            }
            ?>

            Profesor: 
            <?php
            echo "$_SESSION[nombreP] $_SESSION[apellidosP]";
            ?><br><br>

            Selecciona curso del alumno:
            <br>
            <select name='curso'>
                <?php
                //llamo a un controlador, que recoge todos los cursos que da X profesor
                $c = controllerCurso::getTeacherCurso($_SESSION['dniP']);
                if ($c != null) {
                    foreach ($c as $curso) {
                        echo "<option>$curso->descripcion</option>";
                    }
                } else {
                    echo "no hhay registros";
                }
                ?>
            </select>
            <input type='submit' name='seleccion' value='Seleccionar curso'>
        </form>

    </body>
</html>
<?php
if (isset($_POST['nuevoparte'])) {
    //le paso la variable oculta para poner el parte a ese usuario en concreto
    header("Location: nuevoparte.php?idUsu=$_POST[idUsu]");
}

if (isset($_POST['historial'])) {
    //le paso la variable oculta para ver el historial de ese usuario en concreto
    $_SESSION['idUsu'] = $_POST['idUsu'];
    header("Location: historial.php?idUsu=$_SESSION[idUsu]");
}

if(isset($_POST['cerrar'])){
    //esto quita la sesion, y te manda de vuelta al index
    session_unset();
    header("Location: index.php");
}

if (isset($_POST['seleccion'])) {
    //esto es un metodo que comprueba si dicho usuario tiene parte, si no tiene parte te devuelve un "true"
    $check = controllerCurso::checkPartes($_POST['curso']);
    //esto es un metodo qeu pilla todos los alumnos de un curso en especifico
    $a = controllerAlumno::getAlumnos($_POST['curso']);
    if ($a != null) {
        //si la variable recogida del metodo es en efecto "true", sale el mensaje de abajo
        if ($check == true) {
            echo "<h2>ESTE CURSO NO TIENE PARTES</h2>";
        }
        ?>

        <table border='1px'>
            <tr>
                <td>Alumnos</td>
                <td>Opciones</td>
            </tr>

        <?php
        foreach ($a as $alum) {
            echo "<tr>";
            echo "<td>$alum->nombre</td>";
            echo "<td>";
            echo "<form method='POST' action=''>";
            echo "<input type='submit' name='nuevoparte' value='Nuevo parte'>";
            echo "<input type='submit' name='historial' value='Historial'>";
            echo "<input type='hidden' name='idUsu' value='$alum->dni_a'>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
        ?>

        </table>
        <?php
    } else {
        echo "hubo un fallo";
    }
}


ob_end_flush();
?>