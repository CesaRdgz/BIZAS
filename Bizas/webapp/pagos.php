<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>BIZAS</title>
    <link rel="stylesheet" href="css/pagos.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="shortcut icon" href="pw-fotos/perrologo-modified.png">
    <script src="js/pagos.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <style>
        /* Formatting result items */
        .result p{
            margin: 0;
            padding: 7px 10px;
            border: 1px solid #CCCCCC;
            border-top: none;
            cursor: pointer;
        }
        .result p:hover{
            background: #f2f2f2;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>

        //nombre
        $(document).ready(function(){
            $('.search-box input[type="text"]').on("keyup input", function(){
                /* Get input value on change */
                var inputVal = $(this).val();
                var resultDropdown = $(this).siblings(".result");
                if(inputVal.length){
                    $.get("Ajax.php", {term: inputVal}).done(function(data){
                        // Display the returned data in browser
                        resultDropdown.html(data);
                    });
                } else{
                    resultDropdown.empty();
                }
            });

            $(document).on("click", ".result p", function(){
                $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
                $(this).parent(".result").empty();
            });
        });


    </script>

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

<div class="container white"></div>

<div class="container" id="titulo">
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <h2> ¿Has decidido pagar ya?</h2>
            <p> Selecciona al encargado de pagar este mes y la cantidad que deseas abonarle</p>
            <div class="container white"></div>
        </div>
        <div class="col-1 ms-1"></div>
        <div class="col-5">
            <div class="row">
                <div class="col ">
                    <div class="search-box">
                    <label for="firstName" class="form-label" >Nombre y apellido</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" autocomplete="off" required >
                        <div class="result"></div>

                        <div class="invalid-feedback">
                        Valid first name is required.
                    </div>
                        <br>
                    </div>
                </div>
            </div>

            <form action="operaciones.php" method="post">
            <div class="row">
                <div class="col-6">
                    <label for="address" class="form-label">Cantidad</label>
                    <input type="text" class="form-control" id="payment" placeholder="€" name="cantidad" >
                    <div class="invalid-feedback">
                        Introduce la cantidad.
                    </div>
                </div>


                <div class="col">
                    <button class="w-100 h-60 btn btn-lg btn-info mt-4" id="btn" > BIZAS </button>
                </div>
                <p id="parrafo1"></p>
            </div>
            </form>
                <p id="parrafo1"></p>

            </div>

        <div class="col-1">
            <div class="vertical-line"></div>
        </div>
        <div class="col-4">
            <img src="pw-fotos/descarga.png" id="transaccion">
            <div class="row">
                <div class="col-12">
                    <br>
                    <p> Transaccion verificada por la entidad bancaria de <strong>@manuelRuzCastro</strong></p>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
