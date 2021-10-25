<?php
// Initialize the session
session_start();

// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}

// Include config file
require_once "configuracion.php";

$mysqli = new mysqli("db", "quevedo", "quevedo", "quevedodb");

$email = $_SESSION['username'];

$consulta = "SELECT * FROM usuarios WHERE email = '$email'";
$busqueda = $mysqli->query($consulta);
$final = $busqueda->fetch_assoc();

// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have atleast 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err)){
        // Prepare an update statement
        $sql = "UPDATE usuarios SET passwd = ? WHERE email = ?";

        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ss", $param_password, $param_email);

            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_email = $_SESSION["username"];

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Close connection
    $mysqli->close();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BIZAS</title>
    <link rel="stylesheet" href="css/perfil.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="shortcut icon" href="pw-fotos/perrologo-modified.png">
    <link rel="stylesheet" <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <script src="js/bootstrap.min.js"></script>
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }

        #cancel{
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <nav class="navbar navbar-expand-md navbar-light border-3 border-bottom border-info">
        <div class="container-fluid">
            <a href="#" class="navbar-brand"><img src="pw-fotos/perrologo.jpg" id="logo"></a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menuNavegacion">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="menuNavegacion" class="collapse navbar-collapse">
                <ul class="navbar-nav ms-3">
                    <li class="nav-item"><a class="nav-link" href="facturas.php">Factura</a></li>
                    <li class="nav-item"><a class="nav-link" href="pagos.php">Pagos</a></li>
                    <li class="nav-item"><a class="nav-link" href="perfil.php">Perfil</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php" id="cerrarSesion">Cerrar Sesion</a> </li>
                </ul>
            </div>
        </div>
    </nav>
</div>



    <div>
        <h1 style="text-align: center; margin-top: 50px"> Hola <?php echo $_SESSION["username"]?></h1>
    <br>
        <br>

        <div class="row">
            <div class="col-1"></div>

            <div class="col-10">
                <hr style="color: gray">
                <div class="row" >
                    <div class="col-6">
                        <br>
                        <ul>
                            <li> <i class="fas fa-user"></i> &nbsp; Nombre:   <?php  echo $final["nombre"]?></li>
                            <br>
                            <li> <i class="fas fa-user"></i> &nbsp; Apellido: <?php  echo $final["apellido"]?></li>
                        </ul>
                    </div>
                    <div class="col">
                        <br>
                        <ul>
                            <li> <i class="fas fa-phone-square-alt"></i> &nbsp; Telefono: <?php  echo $final["telefono"]?></li>
                            <br>
                            <li> <i class="fas fa-envelope"></i> &nbsp; Email:    <?php  echo $final["email"]?></li>
                        </ul>
                    </div>
                    <br>
                </div>
            </div>
            <div class="col-1"></div>
        </div>

        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <hr style="color: gray">
        <h2>¿Quiere cambiar la contraseña?</h2>

        <form action="<?php echo htmlspecialchars($_SERVER["SCRIPT_NAME"]); ?>" method="post">
            <br>
            <div class="form-group">
                <label>Nueva contraseña</label>
                <input type="password" name="new_password" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">
                <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
            </div>
            <br>
            <div class="form-group">
                <label>Confirmar contraseña</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <br>
            <div class="form-group">
                <input type="submit" class="btn btn-info" value="Confirmar">
                <a class="btn btn-link ml-2" href="facturas.php" id="cancel">Cancelar</a>
            </div>
            <hr style="color: gray">
            <div class="col-1"></div>
        </form>
            </div>
    </div>
    </div>
</body>
</html>