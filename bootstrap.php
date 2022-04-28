<?php

function dd($variable) {
    echo "<pre>";
    print_r($variable);
    echo "</pre>";
}

function ddc($variable) {
    $variable = json_encode($variable);
    ddc($variable);

    echo "<script lang='javasript'>";
    echo "var variable = $variable\n";
        // echo 'console.log("' . stripslashes(print_r($variable, true)) . '");';
        echo 'console.log(JSON.parse(variable));';
    echo '</script>';
}