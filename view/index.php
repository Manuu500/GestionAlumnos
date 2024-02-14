<?php
session_start();
require_once '../controller/controllerProfesor.php';

if (isset($_POST['enviar'])) {
    //Si los campos están llenos, se ejecuta el codigo de abajo
    if (!empty($_POST['usu']) && !empty($_POST['clave'])) {

        $usu = $_POST['usu'];
        $u = controllerProfesor::getTeacher($usu);
        $_SESSION['nombreP'] = $u->nombre;
        $_SESSION['apellidosP'] = $u->apellidos;
        $_SESSION['dniP'] = $u->dni_p;
        $intentos = $u->intentos;
        $bloqueado = $u->bloqueado;
        $claveMD5 = md5($_POST['clave']);

        //si en la base de datos, el profesor tienne el atributo bloqueado a 1, no deja hacer nada, solo sale el mensaje y un boton de volver
        if ($bloqueado == 1) {
            echo "Estás bloqueado<br>";
            echo "<a href='index.php'>volver</a>";
        } else {
            //si no está logueado, se pasa a un metodo llamado login, que seleccina la entidad que corresponda con el usuario y la clave
            $p = controllerProfesor::login($usu, $claveMD5);
            //si existe, se pasa a otra pagina y se actualiza los intentos de vuelta a 3 en la base de datos
            if ($p != null) {
                controllerProfesor::updateIntentos($usu);
                header("Location: partes.php");
                //si no existe, se llama a otro metodo que va restando los intentos
            } else {
                controllerProfesor::updateIntentosResta($usu);
                ?>
                <body>
                    <h1>LOGIN</h1>
                    <form method='POST' action=''> 
                        <?php
                        //de mientras los intentos sean mayores que 0, sale el mensaje que avisa
                        if($intentos > 0){
                            echo "<h2>Te quedan $intentos intentos</h2>";
                            //si son menores, te sale que estas bloqueado y se lllama a un metodo que pone el atributo bloqueado a 1 en el profesor
                        } else {
                            echo "<h2>Estás bloqueado</h2>";
                            controllerProfesor::bloqueado($usu);
                        }
                        ?>
                        Usuario: <input type='text' name='usu' value='<?php echo $_POST['usu'] ?>'><br><!-- comment -->
                        Clave: <input type='text' name='clave' value='<?php echo $_POST['clave'] ?>'><br><!-- comment -->
                        <input type='submit' name='enviar' value='Acceder'>
                    </form>
                </body>
                <?php
            }
        }
        //Si hay algun campo que falte, se pondrá sus mensajes en rojo diciendo que falta contenido
    } else {
        ?>
        <body>
            <h1>LOGIN</h1>
            <form method='POST' action=''>       
                Usuario: <input type='text' name='usu' value='<?php echo $_POST['usu'] ?>'><br><!-- comment -->
                <?php
                if (empty($_POST['usu'])) {
                    echo "<p style='color:red'>El campo usuario está vacio</p>";
                }
                ?>
                Clave: <input type='text' name='clave' value='<?php echo $_POST['clave'] ?>'><br><!-- comment -->
                <?php
                if (empty($_POST['clave'])) {
                    echo "<p style='color:red'>El campo clave está vacio</p>";
                }
                ?>
                <input type='submit' name='enviar' value='Acceder'>
            </form>
        </body>
        <?php
    }
} else {
    ?>
    <html>
        <body>
            <h1>LOGIN</h1>
            <form method='POST' action=''>       
                Usuario: <input type='text' name='usu'><br><!-- comment -->
                Clave: <input type='text' name='clave'><br><!-- comment -->
                <input type='submit' name='enviar' value='Acceder'>
            </form>
        </body>
    </html>
    <?php
}
?>