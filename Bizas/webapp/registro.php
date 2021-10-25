<?php

require_once "configuracion.php";

// Define variables and initialize with empty values
$email = $password = $confirm_password = "";
$email_err = $password_err = $confirm_password_err = "";
$nombre = $apellido = $nombre_usu = $telefono = $dinero = "";
$nombre_err = $apellido_err = $nombre_usu_err = $telefono_err = $dinero_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["nombre"]))){
        $nombre_err = "Introduce un nombre.";
    } elseif(!preg_match('/^[A-Z]+$/i', trim($_POST["nombre"]))){
        $nombre_err = "El nombre solo puede tener letras.";
    } else{
        $nombre = trim($_POST["nombre"]);
    }

    if(empty(trim($_POST["apellido"]))){
        $apellido_err = "Introduce un apellido.";
    } elseif(!preg_match('/^[A-Z]+$/i', trim($_POST["apellido"]))){
        $apellido_err = "El apellido solo puede tener letras.";
    } else{
        $apellido = trim($_POST["apellido"]);
    }

    if(empty(trim($_POST["telefono"]))){
        $telefono_err = "Introduce un numero de telefono.";
    } elseif(!preg_match('/[0-9]+/', trim($_POST["telefono"]))){
        $telefono_err = "El telefono debe tener 9 caracteres y deben ser numeros.";
    } else{
        $telefono = trim($_POST["telefono"]);
    }

    if(empty(trim($_POST["email"]))){
        $email_err = "Introduce un email.";
    } elseif(!preg_match('/^\S+@\S+\.\S+$/', trim($_POST["email"]))){
        $email_err = "El email debe seguir el formato example@example.xxx .";
    } else{
        $email = trim($_POST["email"]);
    }

    if(empty(trim($_POST["dinero"]))){
        $dinero_err = "Introduce el dinero.";
    } elseif(!preg_match('/[0-9]+$/', trim($_POST["telefono"]))){
        $dinero_err = "El dinero debe de estar compuesto unicamente por numeros.";
    } else{
        $dinero = trim($_POST["dinero"]);
    }

    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Introduce una contraseña.";
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Por favor, confirma la contraseña.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Las contraseñas no coinciden.";
        }
    }

    // Check input errors before inserting in database
    if(empty($email_err) && empty($password_err) && empty($confirm_password_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO usuarios (email, nombre, apellido, telefono, passwd, dinero) VALUES (?, ?, ?, ?, ?, ?)";

        if (!empty($mysqli)) {
            if($stmt = $mysqli->prepare($sql)){
                // Bind variables to the prepared statement as parameters
                $param_email = $email;
                $param_nombre = $nombre;
                $param_apellido = $apellido;
                $param_telefono = $telefono;
                $param_dinero = $dinero;
                $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
                $stmt->bind_param("sssisi", $param_email, $param_nombre, $param_apellido, $param_telefono, $param_password, $param_dinero);

                // Set parameters
                $param_email = $email;
                $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

                // Attempt to execute the prepared statement
                if($stmt->execute()){
                    // Redirect to login page
                    header("location: index.php");
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close statement
                $stmt->close();
            }
        }
    }

    // Close connection
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>BIZAS</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="shortcut icon" href="pw-fotos/perrologo-modified.png">
    <link href="css/singin.css" rel="stylesheet">
</head>
<body>
<div class="row">


    <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="pw-fotos/perrologo.jpg" id="logo" alt="" width="72" height="57">
        <h2>Comienza el registro</h2>
        <p class="lead">Introduce los datos que se te piden en sus respectivos espacios para ser dado de alta en esta web</p>
    </div>

    <div class="col-1"></div>

    <div class="col-10">
    <form action="<?php echo htmlspecialchars($_SERVER["SCRIPT_NAME"]); ?>" method="post">

        <hr class="my-4">
        <div class="form-group">
            <label for="email" class="form-label">Email </label>
            <input type="email" name="email"  placeholder="tu@example.com" id="email"  class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
            <span class="invalid-feedback"><?php echo $email_err; ?></span>
        </div>

    <div class="row mt-3">
        <div class="col-sm-6">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text"  id="nombre" name="nombre"  class="form-control <?php echo (!empty($nombre_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nombre; ?>">
            <span class="invalid-feedback"><?php echo $nombre_err; ?></span>
        </div>

        <div class="col">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" id="apellido" name="apellido"  class="form-control <?php echo (!empty($apellido_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $apellido; ?>">
            <span class="invalid-feedback"><?php echo $apellido_err; ?></span>
        </div>
    </div>
    <div class="row">
        <div class="col-6 mt-3">
            <label for="telefono" class="form-label">Numero de telefono</label>
            <input type="text"  id="telefono" name="telefono" class="form-control <?php echo (!empty($telefono_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $telefono; ?>">
            <span class="invalid-feedback"><?php echo $telefono_err; ?></span>
        </div>

        <div class="col mt-3">
            <label for="dinero" class="form-label">Euros</label>
            <input type="text"  id="dinero" name="dinero" value="100" min="1" class="form-control <?php echo (!empty($dinero_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $dinero; ?>">
            <span class="invalid-feedback"><?php echo $dinero_err; ?></span>
        </div>
    </div>

        <div class="row mt-3">
        <div class="form-group col-6 ">
            <label>Contraseñas</label>
            <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
            <span class="invalid-feedback"><?php echo $password_err; ?></span>
        </div>

        <div class="form-group col ">
            <label>Confirmar contraseñas</label>
            <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
            <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
        </div>
        </div>
        <hr class="my-4">

        <div class="form-group">
            <input type="submit" class="btn btn-lg btn-info w-100" value="Registrarme">
        </div>
        <br>
        <p>¿Ya tienes una cuenta? <a href="index.php">Inicia sesion</a>.</p>
    </form>
    </div>

    <div class="col-1"></div>
</div>
</body>
</html>
