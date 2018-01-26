<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Login</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        body {
    padding-top: 90px;
    background-color: #0c8dcd;
}
.panel-login {
    border-color: #ccc;
    -webkit-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
    -moz-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
    box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
}
.panel-login>.panel-heading {
    color: #00415d;
    background-color: #fff;
    border-color: #fff;
    text-align:center;
}
.panel-login>.panel-heading a{
    text-decoration: none;
    color: #666;
    font-weight: bold;
    font-size: 15px;
    -webkit-transition: all 0.1s linear;
    -moz-transition: all 0.1s linear;
    transition: all 0.1s linear;
}
.panel-login>.panel-heading a.active{
    color: #029f5b;
    font-size: 18px;
}
.panel-login>.panel-heading hr{
    margin-top: 10px;
    margin-bottom: 0px;
    clear: both;
    border: 0;
    height: 1px;
    background-image: -webkit-linear-gradient(left,rgba(0, 0, 0, 0),rgba(0, 0, 0, 0.15),rgba(0, 0, 0, 0));
    background-image: -moz-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
    background-image: -ms-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
    background-image: -o-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
}
.panel-login input[type="text"],.panel-login input[type="email"],.panel-login input[type="password"] {
    height: 45px;
    border: 1px solid #ddd;
    font-size: 16px;
    -webkit-transition: all 0.1s linear;
    -moz-transition: all 0.1s linear;
    transition: all 0.1s linear;
}
.panel-login input:hover,
.panel-login input:focus {
    outline:none;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none;
    border-color: #ccc;
}
.btn-login {
    background-color: #0c8dcd;
    outline: none;
    color: #fff;
    font-size: 14px;
    height: auto;
    font-weight: normal;
    padding: 14px 0;
    text-transform: uppercase;
    border-color: #59B2E6;
}
.btn-login:hover,
.btn-login:focus {
    color: #fff;
    background-color: #53A3CD;
    border-color: #53A3CD;
}
.forgot-password {
    text-decoration: underline;
    color: #888;
}
.forgot-password:hover,
.forgot-password:focus {
    text-decoration: underline;
    color: #666;
}

.btn-register {
    background-color: #1CB94E;
    outline: none;
    color: #fff;
    font-size: 14px;
    height: auto;
    font-weight: normal;
    padding: 14px 0;
    text-transform: uppercase;
    border-color: #1CB94A;
}
.btn-register:hover,
.btn-register:focus {
    color: #fff;
    background-color: #1CA347;
    border-color: #1CA347;
}

    </style>
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
            padding-top: 15px;
            pointer-events: none;
            color: #0684c5;
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

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
    
    <?php include("licenca.php");
    if (isset($licenciado)){
        
    ?>
    
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-login">
                    <div class="panel-heading">
                        <div class="row">
                            <img src="css/logo.png" style="padding: 20px;" class="img-responsive" alt="Imagem Responsiva">
                        </div>
                        <hr>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                            <form action="validacao.php" method="post" id="login-form" name="form1" style="display: block;">
                                    <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <?php if ($_GET["erro"] == 01){?>
                                                <div id="msgerro" class="alert alert-danger" role="alert">
                                                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                                    <span class="sr-only">Erro:</span>
                                                    Usuário ou Senha incorreto!
                                                </div><?php }?>
                                            <div class="inner-addon left-addon">
                                                <i class="glyphicon glyphicon-user"></i>
                                        <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Usuário" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3">
                                        <div class="inner-addon left-addon">
                                            <i class="glyphicon glyphicon-lock"></i>
                                        <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Senha" required>
                                        </div>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="form-group text-center">
                                        <input type="checkbox" tabindex="3" class="" name="remember" id="remember">
                                        <label for="remember" style="color: #231f20;"> Me lembre!</label>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="submit" id="submit" tabindex="4" class="form-control btn btn-login" value="Entrar">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group text-center">
                                        <label for="licenca" style="color: #616161;font-style: italic;"> Software licenciado para: <?php echo $licenciado;?></label>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="text-center">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<hr>
    <footer2 class="container">
<p><a href="http://www.vittel.com.br" target="_blank" style="margin-left: 5%; color: white">&copy;2017 - Vittel Softwares e Comunicações</a></p>
    </footer2>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/jquery-1.11.2.min.js"><\/script>')</script>

    <script src="js/bootstrap.min.js"></script>

    <script src="js/main.js"></script>
        <script src="js/anima.js"></script>


</body>
    <?php  }else{
        echo "<div id=\"msgerro\" class=\"alert alert-danger\" role=\"alert\">
                                                    <span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span>
                                                    <span class=\"sr-only\">Erro:</span>
                                                    ERRO DE LICENÇA!
                                                </div>";
    }?>
</html>