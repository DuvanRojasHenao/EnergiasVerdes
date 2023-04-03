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
        header("Location: ". ROOT ."formulario/add.php");
            exit();

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="../stilos.css" rel="stylesheet" type="text/css">


</head>
<body>

<nav class= "navbar navbar-expand navbar-dark bg-dark mb-5">
    <ul class="navbar-nav">
        <li class="nav-item" class="text-center" >
            <a class="nav-link" href="/comentarios/formulario/add.php" >Escribir comentario </a>
        </li>
        <li class="nav-item" class="text-center" >
            <a class="nav-link" href="/comentarios/formulario/index.php" >Lista de comentarios </a>
        </li>
    </ul>
</nav>

<?php 
      if (isset($mensaje)){
        echo $mensaje;
      }
?>
<form method="POST" enctype="multipart/form-data" class="row g-3">
    <div class="text-center" class="lbl-comentarios"><h1>Escribir comentario</h1></label></div>
    <div class="container text-center container_form">
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


    </div>

</form>


<div class="container container_comentarios"  >
    <h2 class="title"> Nuevos comentarios </h2>
    <div class="row">
        <?php
        while ($pt = mysqli_fetch_assoc($data)) {
            ?>

                        <div class="list-group">
                            <div href="#" class="list-group-item active comentario">
                                <div class="col-md-10">
                                    <h4 class="list-group-item-heading"><?php echo $pt['nombre']; ?></h4>
                                    <p class="list-group-item-text"> <?php echo $pt['comentario']; ?></p>
                                </div>

                                <div class="col-md-2 text-center">
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
                        <div class="d-grid gap-2 d-md-block" style="margin-bottom: 13px;">
                            <a type="button" class="btn btn-warning" 
                            href="<?=ROOT?>formulario/edit.php?id=<?= $pt['id']?> ">
                                Editar comentario
                            </a>
                            <button class="btn btn-success"onclick="myFunction(<?= $pt['id']?>)">
                                Eliminar comentario
                            </button>
                        </div>


            <?php
        }
        ?>
    </div>
</div>

<!--codigo test-->



<!--fin codigo test-->
</body>
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

</html>