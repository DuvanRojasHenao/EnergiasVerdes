<?php
include('../config/config.php');
include('comentario.php');



if (isset($_POST['nombre']) && !empty($_POST['nombre'])){
    $p = new comentario();

    $save = $p->save($_POST);
    if($save){
        $mensaje = '<div class="alert alert-success" role="alert"> Comentario registrado </div>';

    }else{
        $mensaje = '<div class="alert alert-danger" role="alert"> Error al registrar comentario </div>';
    }

}

if(!empty($_POST['delete_id'])){
    $p = new comentario();
    $save = $p->delete($_POST['delete_id']);
}



$p= new comentario();
$data = $p->getAll();



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar comentario</title>
    <link href="../styles/styles.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <link href="../stilos.css" rel="stylesheet" type="text/css">

    <style>

        .letra >li > a{
            font-size: 16px
        }

        .logo{
            position: relative;
            top: -25px
        }
    </style>


</head>
<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary col-lg-12 d-flex justify-content-center menu_sitio">
    <div class="container-fluid">
        <a class="navbar-brand logo" href="../index.html">
            <img src="../imagenes/logo.png" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 letra">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="../index.html">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../PlasticosBiodegradables.html">Plasticos Biodegradables</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="../HidrogenoVerde.html">Hidrogeno Verde</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="add.php">Comentarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../admi.html">Administrador</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

   <div class="banner_container" ><img src="../imagenes/banner.jpg"alt="..."></div>

    <section class="main_container carrusel_imagenes">



            <?php
            if (isset($mensaje)){
                echo $mensaje;
            }
            ?>

        <div class="text-center" class="lbl-comentarios"><h2>Escribir comentario</h2></label></div>
        <hr>
        <div class="container text-center container_form">

            <form action="add.php" method="POST">


                <div class="mb-3">
                    <label for="Nombre" class="form-label"><h3>Nombre</h3></label>
                    <input type="text" class="form-control" id="nombre" name="nombre" >
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label"><h3>Email</h3></label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="mb-3">
                    <label for="escribe tu comentario" class="form-label"><h3>Comentario</h3></label>
                    <textarea class="form-control" id="comentario " name="comentario" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label for="" class="form-label"><h3>Calificanos</h3></label>
                </div>
                <div class="mb-3 contenedor_estrellas">
                    <div class="rating">
                        <input type="radio" name="tuvaloracion" value="5" id="5"><label for="5">☆</label>
                        <input type="radio" name="tuvaloracion" value="4" id="4"><label for="4">☆</label>
                        <input type="radio" name="tuvaloracion" value="3" id="3"><label for="3">☆</label>
                        <input type="radio" name="tuvaloracion" value="2" id="2"><label for="2">☆</label>
                        <input type="radio" name="tuvaloracion" value="1" id="1"><label for="1">☆</label>
                    </div>
                </div>

                <div class="mb-3">
                    <input class="btn btn-primary btn-lg" type="submit" value="Enviar comentario">
                </div>

                <hr class="linea">
            </form>
        </div>




        <div class="container container_comentarios"  >
            <h2 class="title"> Nuevos comentarios </h2>
            <div class="row">
                <?php
                while ($pt = mysqli_fetch_assoc($data)) {
                    ?>

                    <div class="list-group">
                        <div href="#" class="list-group-item active comentario">
                            <div class="col-md-10">
                                <h4 class="list-group-item-heading text-left"><?php echo $pt['nombre']; ?></h4>
                                <p class="list-group-item-text text-left"> <?php echo $pt['comentario']; ?></p>
                            </div>

                            <div class="col-md-12 text-left">
                                <div class="stars">
                                    <?php
                                    $cont = 1;
                                    while ( $cont <= $pt['tuvaloracion']){
                                        echo '<span class="glyphicon glyphicon-star"></span>';
                                        $cont++;
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>


                    <hr>


                    <?php
                }
                ?>
            </div>
        </div>

    <!--codigo test-->



    <!--fin codigo test-->
    </section>


<script >
    function myFunction(id) {

        if(confirm("Desea eliminar este comentario?")) {
            $.post("add.php",
                {
                    delete_id: id
                },
                function(data, status){
                    alert("Registro Eliminado Exitosamente");
                    location.reload();
                });
        }
    }
</script>

<footer class="footer">
    <div class="container text-center">
        <div class="row align-items-start">
            <div class="col">
                <h2 class="redes">Redes</h2>

                <div class="links_redes">
                    <a href="https://www.facebook.com/">
                        <img src="../imagenes/fb.png">
                    </a>
                    <a href="https://wa.link/86n5kj">
                        <img src="../imagenes/wsp.png">
                    </a>
                    <a href="https://www.instagram.com/">
                        <img src="../imagenes/instagram.png">
                    </a>

                </div>
            </div>
            <div class="col">
                <h2 class="autores">Autores</h2>
                <ul class="lista">
                    <li class="autor">
                        <p>Duvan Rojas Henao</p>
                    </li>
                    <li class="autor">
                        <p>Yuly Alexandra Guio</p>
                    </li>
                </ul>
            </div>
            <div class="col">
                <h2 class="contacto">Contacto</h2>
                <ul class="lista">
                    <li class="correo">
                        <p>duvanxxxxx48@gmail.com</p>
                        <p>Yuliwww12@gmail.com</p>
                    </li>
                    <li class="tel">
                        <p>Celular: 3157189017</p>
                    </li>
            </div>
        </div>
    </div>
</footer >

</body>
</html>
