<?php
session_start();
define('__SITE_DIR__',__DIR__);
$alea=hash('sha256','fu3jkfdihfuf324903UDSIF687909034'.uniqid());
define($alea,true);

include __SITE_DIR__.'/controls/config.php';
include __FUNCTIONS_DIR__.'/functions.php';
include __FUNCTIONS_DIR__.'/connexion.php';
include __FUNCTIONS_DIR__.'/bdd.php';
include __FUNCTIONS_DIR__.'/teams.php';

include __CONTROLS_DIR__.'/global.php';
