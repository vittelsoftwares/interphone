<?php session_start(); ?>

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
            padding-top: 50px;
            padding-bottom: 20px;
        }
    </style>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
</head>
<body>
<?php
include("customers/connection.php");
 
if(isset($_POST['submit'])) {
    $user = mysqli_real_escape_string($mysqli, $_POST['username']);
    $pass = mysqli_real_escape_string($mysqli, $_POST['password']);
 
    if($user == "" || $pass == "") {
        echo "Either username or password field is empty.";
        echo "<br/>";
        echo "<a href='login.php'>Go back</a>";
    } else {
        $result = mysqli_query($mysqli, "SELECT * FROM login WHERE username='$user' AND password=md5('$pass')")
        or die("Could not execute the select query.");
        
        $row = mysqli_fetch_assoc($result);
        
        if(is_array($row) && !empty($row)) {
            $validuser = $row['username'];
            $_SESSION['valid'] = $validuser;
            $_SESSION['name'] = $row['name'];
            $_SESSION['id'] = $row['id'];
        } else {
            echo "Invalid username or password.";
            echo "<br/>";
            echo "<a href='login.php'>Go back</a>";
        }
 
        if(isset($_SESSION['valid'])) {
            header('Location: index.php');            
        }
    }
} else {
?>
    <a href="index.php">Inicio</a> <br />

<h2>Login</h2>
    <form name="form1" method="post" action="">

<hr />
 <div class="row">
    <div class="form-group col-md-3">
      <label for="name">Usuário</label>
      <input type="text" class="form-control" name="username" required>
    </div>
    </div>

 <div class="row">
    <div class="form-group col-md-3">
      <label for="campo2">Senha</label>
      <input type="password" class="form-control" name="password" required>
    </div>
  </div>

  <div id="actions" class="row">
    <div class="col-md-12">
      <input type="submit" name="submit" value="Login" class="btn btn-primary">
    </div>
  </div>
    </form>
<?php
}
?>
<hr>
    <footer class="container">
        <p>&copy;2017 - Vittel Softwares e Comunicações</p>
    </footer>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/jquery-1.11.2.min.js"><\/script>')</script>

    <script src="js/bootstrap.min.js"></script>

    <script src="js/main.js"></script>
</body>
</html>