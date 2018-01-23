<!DOCTYPE html>
<html>
<head>

    <?php

    // A sessão precisa ser iniciada em cada página diferente
    if (!isset($_SESSION)) session_start();

    $nivel_necessario = 1;

    // Verifica se não há a variável da sessão que identifica o usuário
    if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] <$nivel_necessario)) {
        // Destrói a sessão por segurança
        session_destroy();
        // Redireciona o visitante de volta pro login
        header("Location: login.php"); exit;
    }

    ?>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Interphone | ICC</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="<?php echo BASEURL; ?>css/bootstrap.min.css">
    <style>
        body {
            padding-top: 50px;
            padding-bottom: 20px;
            font-family: Segoe UI;
        }
    </style>

    <link rel="stylesheet" href="<?php echo BASEURL; ?>css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="brand"><a href="/interphone/index.php" ><img src="/interphone/css/logo_interphone_pequeno.png" class="img-responsive" style="max-width: 100%;float: left;max-width: 100%;padding-left: 10px;float: left;padding-top: 5px;" alt="Imagem Responsiva"></a></div>
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        Moradores <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo BASEURL; ?>customers">Gerenciar Moradores</a></li>
                        <?php if($_SESSION['UsuarioNivel'] >$nivel_necessario){ ?>
                        <li><a href="<?php echo BASEURL; ?>customers/add.php">Novo Morador</a></li>
                        <?php };?>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        Relatórios <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo BASEURL; ?>relatorios">Relatórios de Chamadas</a></li></ul>
                </li>
            </ul>

            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        Anúncios <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo BASEURL; ?>anuncios">Novo Anúncios</a></li>
                        <li><a href="<?php echo BASEURL; ?>anuncios/view.php">Visualizar Anúncios</a></li></ul>
                    </ul>
                </li>
            </ul>

            <ul class="nav navbar-nav" style=" float: right; ">
                <li class="dropdown">
                    <a class="btn btn-info btn-sm dropdown-toggle" href="#" style="color:  white; margin-top: 10px;padding: 5px;" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i>  <?php echo $_SESSION['UsuarioNome'] ?></a>
                    <ul class="dropdown-menu">
                        <li><a href="/interphone/logout.php">Sair</a></li>
                        <?php if($_SESSION['UsuarioNivel'] >$nivel_necessario){ ?>
                        <li><a href="<?php echo BASEURL; ?>novouser.php"> Criar Usuário</a></li>
                        <?php }?>
                    </ul>
                </li>
            </ul>

        </div>
    </div>
</nav>
<main class="container">