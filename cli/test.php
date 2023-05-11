<?php
require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Form.php';
echo Form::$class . PHP_EOL; // Appel d'une propriété static
echo Form::checkbox('demo', 'Demo'); // appel d'une méthode static