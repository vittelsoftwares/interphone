<?php
/**
 * Created by PhpStorm.
 * User: Dionisio
 * Date: 08/11/2017
 * Time: 20:37
 */

    include("connection.php");
// Define itens por pagina para exibir
$itens_por_pagina = 10;
// Pegar a pagina atual
$pagina = intval($_GET['pagina']);
// Puxar moradores do banco
$sql_code = "select id, name, quadraelote, usuario1, usuario2 from moradores LIMIT $pagina, $itens_por_pagina";
$execute = $mysqli->query($sql_code) or die($mysqli->error);
$morador = $execute->fetch_assoc();
$num = $execute->num_rows;

// Pega a qtd total de objetos no banco de dados
$num_total = $mysqli->query("select id, name, quadraelote, usuario1, usuario2 from moradores")->num_rows;

// Definir numero de páginas
$num_paginas = ceil($num_total/$itens_por_pagina);
?>

<!doctype html>
<html lang="en">
<head>
    <title>Hello, world!</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
</head>
<body>

<div class="container-fluid">
    <div class="row"></div>
        <div class="col-lg-4">
            <h1>Moradores</h1>
            <?php if($num > 0){ ?>
               <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Nome</td>
                            <td>Quadra e Lote</td>
                            <td>Usuario 1</td>
                            <td>Usuario 2</td>
                        </tr>
                    </thead>
                   <tbody>
                   <?php do{ ?>
                     <tr>
                       <td><?php echo $morador['id']; ?></td>
                         <td><?php echo $morador['name']; ?></td>
                         <td><?php echo $morador['quadraelote']; ?></td>
                       <td><?php echo $morador['usuario1']; ?></td>
                       <td><?php echo $morador['usuario2']; ?></td>
                     </tr>
                   <?php } while($morador = $execute->fetch_assoc()); ?>
                   </tbody>
               </table>
            <?php } ?>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="paginacao.php?pagina=0">Anterior</a></li>
                        <?php for($i=0;$i<$num_paginas;$i++){
                            $estilo= "";
                            if($pagina == $i)
                                $estilo = "class=\"active\"";
                            ?>
                        <li <?php echo $estilo; ?> ><a class="page-link" href="paginacao.php?pagina=<?php echo $i; ?>"><?php echo $i+1; ?></a></li>
                        <?php } ?>
                        <li class="page-item"><a class="page-link" href="paginacao.php?pagina=<?php echo $num_paginas-1; ?>">Proxima</a></li>
                    </ul>
                </nav>


        </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</body>
</html>
