<?php
    include('../config/config.php');
    include('comentario.php');

    $p= new comentario();
   
    $dp =$p->get0ne($_GET['id']);

    $data =  mysqli_fetch_assoc($dp);

    if (isset($_POST) && !empty($_POST)){
        $update = $p->update($_POST);
        if ($update) {
            $mensaje='<div class="alert alert-success"role="alert">Comentario modificado con exito</div>';
            header("Location: ". ROOT ."formulario/add.php");
            exit();
        } else {
            $mensaje='<div class"alert alert_danger"role="alert">Error!</div>';
        }
    }
    
    ?>
    

<!DOCTYPE html>
<html lang="en">

<body>
    
    <?php
        include('../menu.php');
    ?>

    <?php 
          if (isset($mensaje)){
            echo $mensaje;
          }
    ?>

    <form method="POST" enctype="multipart/form-data" class="row g-3">
        <div class="text-center" class="lbl-comentarios"><h1>Editar comentario</h1></label></div>
        <div class="container text-center container_form">
            <input type="hidden" value="<?= $data['id'] ?>" name="id">
              <div class="mb-3">
                <label for="Nombre" class="form-label"><h3>Nombre</h3></label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $data['nombre'] ?>">
              </div>
              <div class="mb-3">
                <label for="email" class="form-label"><h3>Email</h3></label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $data['email'] ?>">
              </div>
              <div class="mb-3">
                <label for="escribe tu comentario" class="form-label"><h3>Comentario</h3></label>
                <textarea class="form-control" id="comentario" 
                name="comentario" rows="3" ><?= $data['comentario'] ?></textarea>
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
                <input class="btn btn-primary btn-lg" type="submit" value="Modificar comentario">
            </div>

            <hr class="linea">

        </div>

    </form>
    
</body>

</html>