<?php 
  session_start();
  $_SESSION['user'] =[
    "username" => 'John',
    "password" => '0000'
  ];
  unset($_SESSION['role']);

  $title = "Page d'accueil";
  $nav = "index";
  require('elements' . DIRECTORY_SEPARATOR . 'header.php');
?>

  <div class="starter-template">
    <h1>Bootstrap starter template</h1>
    <p class="lead">Use this document as a way to quickly start any new project.<br> All you get is this text and a mostly barebones HTML document.</p>
  </div>

<?php require('elements' . DIRECTORY_SEPARATOR . 'footer.php') ?>

<?php
  // FONCTIONS
  // session_start — Démarre une nouvelle session ou reprend une session existante
  // unset — Détruit une variable