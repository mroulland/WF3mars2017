<?php
require 'App\autoload.php';

use Model\User; 

$users = User::findAll();

include './view/index.view.php';