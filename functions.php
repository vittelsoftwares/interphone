<?php
require_once('../config.php');
require_once(DBAPI);
$moradores = null;
$morador = null;
/**
 *  Listagem de Clientes
 */
function index() {
  global $moradores;
  $moradores = find_all('moradores');
}

/**
 *  Cadastro de Clientes
 */
function add() {
  if (!empty($_POST['morador'])) {
    
    $today = 
      date_create('now', new DateTimeZone('America/Sao_Paulo'));
    $morador = $_POST['morador'];
    $morador['modified'] = $morador['created'] = $today->format("Y-m-d H:i:s");
    
    save('moradores', $morador);
    header('location: index.php');
  }
}

/**
 *  Atualizacao/Edicao de Cliente
 */
function edit() {
  $now = date_create('now', new DateTimeZone('America/Sao_Paulo'));
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (isset($_POST['morador'])) {
      $morador = $_POST['morador'];
      $morador['modified'] = $now->format("Y-m-d H:i:s");
      update('moradores', $id, $morador);
      header('location: index.php');
    } else {
      global $morador;
      $morador = find('moradores', $id);
    } 
  } else {
    header('location: index.php');
  }
}

/**
 *  Visualização de um Cliente
 */
function view($id = null) {
  global $morador;
  $morador = find('moradores', $id);
}

/**
 *  Exclusão de um Cliente
 */
function delete($id = null) {
  global $morador;
  $morador = remove('moradores', $id);
  header('location: index.php');
}