<?php

session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}

require_once "configuracion.php";

if(isset($_REQUEST["cantidad"])){

    $sql = "SELECT dinero FROM contactos WHERE nombre LIKE ? AND apellido LIKE ?";


    if($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("ss", $nombre, $apellido);

        $nombre = $_COOKIE['nombre'];
        $apellido = $_COOKIE['apellido'];

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                    $money = $row["dinero"];
                }
            } else {
                echo "<p>No se encontraron resultados</p>";
            }
        } else {
            echo "ERROR: No se pudo ejecutar $sql. ";
        }


        $sqlsuma = "UPDATE contactos SET dinero = ? WHERE nombre = ? AND apellido = ?";

        if ($stmt = $mysqli->prepare($sqlsuma)) {

            $stmt->bind_param("iss", $new_dinero, $nombre, $apellido);

            $new_dinero = $money + intval($_REQUEST["cantidad"]);

            if ($stmt->execute()) {

                $sql = "SELECT dinero FROM usuarios WHERE email LIKE ? ";

                if ($stmt = $mysqli->prepare($sql)) {
                    $stmt->bind_param("s", $email);

                    $email = $_SESSION["username"];

                    if ($stmt->execute()) {
                        $result = $stmt->get_result();
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                                $money = $row["dinero"];
                            }
                        } else {
                            echo "<p>No se encontraron resultados</p>";
                        }
                    } else {
                        echo "ERROR: No se pudo ejecutar $sql. ";
                    }

                    $sqlresta = "UPDATE usuarios SET dinero = ? WHERE email LIKE ?";

                    if ($stmt = $mysqli->prepare($sqlresta)) {

                        $stmt->bind_param("is", $new_dinero, $email);

                        if ($money > intval($_REQUEST["cantidad"])) {
                            $new_dinero = $money - intval($_REQUEST["cantidad"]);
                        } else {
                            echo "El dinero ingresado es superior al que tienes en la cuenta";
                        }


                        if ($stmt->execute()) {

                            header("location: si.php");
                        } else {
                            echo "Oops! Something went wrong. Please try again later.";
                        }

                    } else {
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                }

                $stmt->close();
            }
        }
    }
    $mysqli->close();
}
?>


