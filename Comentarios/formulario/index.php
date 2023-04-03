<?php
include_once ('../config/config.php');
include('comentario.php');

$p= new comentario();
$data = $p->getAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de comentarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<body>

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
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
    </div>
    
</body>
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