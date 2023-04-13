<?php
include_once ('../config/config.php');
include('comentario.php');


$p= new comentario();
$data = $p->getAll();

?>

<!DOCTYPE html>
<html lang="en">

<body>

    <?php

    include('../menu.php');
    
    ?>

    <div class="container" >
        <h2 class="text-center mb-2"> Nuevos comentarios </h2>
        <div class="row">
            <?php
            while ($pt = mysqli_fetch_assoc($data)) {
            ?>
                <div class="container">
                    <div class="row">
                        <div class="well">
                            <div class="list-group">
                                <div href="#" class="list-group-item active">
                                    <div class="col-md-6">
                                        <h4 class="list-group-item-heading"><?php echo $pt['nombre']; ?></h4>
                                        <p class="list-group-item-text"> <?php echo $pt['comentario']; ?></p>
                                    </div>
                                    <div class="col-md-3 text-center">
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
                            href="<?= ROOT?>formulario/edit.php?id=<?= $pt['id']?> ">
                                Editar comentario
                            </a>
                            <button class="btn btn-success"onclick="myFunction(<?= $pt['id']?>)">
                                Eliminar comentario
                            </button>
                        </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
    </div>
    
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
<style>
    a.list-group-item {
        height:auto;
        min-height:220px;
    }
    a.list-group-item.active small {
        color:#fff;
    }
    .stars {
        margin:20px auto 1px;
    }
</style>
</html>