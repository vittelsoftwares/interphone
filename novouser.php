<?php session_start(); ?>
<?php require_once 'config.php'; ?>
<?php require_once DBAPI; ?>



<?php include(HEADER_TEMPLATE); ?>

<?php

// A sessão precisa ser iniciada em cada página diferente
if (!isset($_SESSION)) session_start();

$nivel_necessario = 3;

// Verifica se não há a variável da sessão que identifica o usuário
if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] <$nivel_necessario)) {
    // Destrói a sessão por segurança
    // Redireciona o visitante de volta pro login
    header("Location: index.php"); exit;

}
    ?>

    <title>Moradores</title>

    <h1>Criar novo Usuário do sistema</h1>
    <hr />

        <br/>

        <?php
        include("customers/connection.php");

        if(isset($_POST['submit'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $user = $_POST['username'];
            $pass = $_POST['password'];
            $permissao = $_POST['nivel'];


            $consulta = mysqli_query($mysqli, "SELECT * FROM login WHERE username='$user'");
            $linha = mysqli_num_rows($consulta);

            if($linha == 1) {
                echo "<p style='color:red';>Este nome de usuário já está em uso! Tente outro</p>";
                echo "<br/>";
                echo "<a href='novouser.php'>Voltar</a>";

            }else {
                mysqli_query($mysqli, "INSERT INTO login(name, email, username, password, nivel) VALUES('$name', '$email', '$user', md5('$pass'), '$permissao')")
                or die("Não foi possivel inserir na tabela.");

                mysqli_query($mysqli, "ALTER TABLE login AUTO_INCREMENT = 1")
                or die("Não foi possivel inserir na tabela.");

                echo "Registro realizado com sucesso!";
                echo "<br/>";
                echo "<a href='novouser.php'>Voltar</a>";
            }
        } else {
            ?>
<?php

$itens_por_pagina = 50;
// Pegar a pagina atual
$pagina = intval($_GET['pagina']);

$item = $pagina*$itens_por_pagina;
// Puxar moradores do banco
$sql_code = "select name, email, username, nivel from login";
$execute = $mysqli->query($sql_code) or die($mysqli->error);
$morador = $execute->fetch_assoc();
$num = $execute->num_rows;

// Pega a qtd total de objetos no banco de dados
$num_total = $mysqli->query("select * from login")->num_rows;

// Definir numero de páginas
$num_paginas = ceil($num_total/$itens_por_pagina);
?>
            <script language="Javascript">

                function checkLength(el) {

                    if (el.value.length < 6) {
                        document.getElementById("msgsenha").innerHTML="<label style='font-family: Segoe UI; font-weight: 700'>Senha <i style='color: darkred' class='fa fa-times-circle'></i><label style='font-style: italic; font-weight: 400'>(Mínimo 6 Caracteres!)</label></label>";
                        document.getElementById("submit").disabled = true;
                    } else {
                        document.getElementById("msgsenha").innerHTML="<label style='font-family: Segoe UI; font-weight: 700'>Senha <i style='color: #0000bf' class='fa fa fa-check'></i></label>";
                        document.getElementById("submit").disabled = false;
                    }
                }

                function validacaoEmail(field) {
                    usuario = field.value.substring(0, field.value.indexOf("@"));
                    dominio = field.value.substring(field.value.indexOf("@")+ 1, field.value.length);

                    if ((usuario.length >=1) &&
                        (dominio.length >=3) &&
                        (usuario.search("@")==-1) &&
                        (dominio.search("@")==-1) &&
                        (usuario.search(" ")==-1) &&
                        (dominio.search(" ")==-1) &&
                        (dominio.search(".")!=-1) &&
                        (dominio.indexOf(".") >=1)&&
                        (dominio.lastIndexOf(".") < dominio.length - 1)) {
                        document.getElementById("msgemail").innerHTML="<label style='font-family: Segoe UI; font-weight: 700'>E-mail <i style='color: #0000bf' class='fa fa fa-check'></i></label>";
                        document.getElementById("submit").disabled = false;
                    }
                    else{
                        document.getElementById("msgemail").innerHTML="<label style='font-family: Segoe UI; font-weight: 700'>E-mail <i style='color: darkred' class='fa fa-times-circle'></i></label>";
                        document.getElementById("submit").disabled = true;
                    }

                }
            </script>

            <style>
                .form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
                    background-color: #eee;
                    color: green;
                }
                     /* Ativa posicionamento absoluto */
                 .inner-addon {
                     position: relative;
                 }

                /* estilo do icone */
                .inner-addon .glyphicon {
                    position: absolute;
                    padding: 10px;
                    pointer-events: none;
                }

                /* alinha o icone */
                .left-addon .glyphicon  { left:  0px;}
                .right-addon .glyphicon { right: 0px;}

                /* adiciona margem  */
                .left-addon input  { padding-left:  30px; }
                .right-addon input { padding-right: 30px; }

                .padding {
                    padding: 6px 25px;
                }
            </style>

<div class="container">
    <div class="row">
        <div class="col-xs-6">
        <form id="register-form" name="form1" method="post" action="" style="display: block;">

            <div class="row">
             <div class="form-group .col-xs-6 .col-sm-3">
                <label for="name">Nome</label>
             <div class="inner-addon left-addon">
             <i class="glyphicon glyphicon-list-alt"></i>
                <input type="text" class="form-control" name="name" placeholder="Digite seu nome completo" required>
                </div>
             </div>
            </div>

            <div class="row">
            <div class="form-group .col-xs-6 .col-sm-3">
                <label id="msgemail" for="campo2">E-mail </label>
             <div class="inner-addon left-addon">
             <i class="glyphicon glyphicon-envelope"></i>
                <input type="text" class="form-control" name="email" onkeyup="validacaoEmail(form1.email)"  maxlength="60" size='65' placeholder="exemplo@exemplo.com.br" required>
                </div>
            </div>
            </div>



            <div class="row">
            <div class="form-group .col-xs-6 .col-sm-3">
                <label for="campo2">Usuário</label>
             <div class="inner-addon left-addon">
             <i class="glyphicon glyphicon-user"></i>
                <input type="text" class="form-control" name="username" placeholder="Digite seu usuário" required>
            </div>
            </div>
                </div>

            <div class="row">
            <div class="form-group .col-xs-6 .col-sm-3">
                <label id="msgsenha" for="campo2">Senha </label>
             <div class="inner-addon left-addon">
             <i class="glyphicon glyphicon-lock"></i>
                <input type="password" class="form-control" name="password" onkeyup="checkLength(this)" placeholder="Digite sua senha" required>
               </div>
            </div>
                <br>

                    <div class="form-group .col-xs-6 .col-sm-3">
                        <label for="permissao">Nível do Usuário</label>
                        <div class="inner-addon left-addon">
                            <i class="glyphicon glyphicon glyphicon-tasks"></i>
                            <select name="nivel" class="form-control padding" required>
                                <option value="1">Padrão (Somente Visualiza)</option>
                                <option value="3">Administrador</option>
                            </select>
                        </div>
                    </div>
            </div>

            <div class="row" >
                <div class="form-group .col-xs-6 .col-sm-3">
                    <input type="submit" name="submit" id="submit" tabindex="4" class="form-control btn btn-success" value="Cadastrar" disabled>                </div>
            </div>

        </form>
        </div>

        <div class="col-xs-6">
        <h4 style="text-align:  center;">Usuários Ativos</h4>
    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <th>Nome</th>
            <th>Usuário</th>
            <th>Opções</th>

        </tr>
        </thead>
        <tbody>
        <?php do{ ?>
            <tr>
                <td><?php if ($morador['nivel'] == 3){ ?><i class="fa fa-star" style="color: yellow;"></i> <?php echo $morador['name']; ?><?php }else{?>
                <?php echo $morador['name']; ?>
                <?php }?>
                </td>

                <td><?php echo $morador['username']; ?></td>
                <td class="actions text-center"><a href="edit.php?id=<?php echo $morador['id']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i> Editar</a>
                    <?php if ($morador['nivel'] != 3){ ?><a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-modal" data-customer="<?php echo $morador['id']; ?>" data-morador="<?php echo $morador['name']; ?>"> <i class="glyphicon glyphicon-remove"></i> Excluir</a>
                    <?php } else {?><a href="#" class="btn btn-sm btn-danger" disabled> <i class="glyphicon glyphicon-remove"></i> Excluir</a><?php }?></td>


            </tr>
        <?php } while($morador = $execute->fetch_assoc()); ?>
        </tbody>
    </table>
            </div>

        </div>
    </div>
</div>

<?php }?>
<?php include(FOOTER_TEMPLATE); ?>
