<?php

    echo "<pre>";
    print_r( $_GET);
    echo "<br>";
    print_r( $_GET["usuario"]);

    echo "<pre>";
    print_r( $_POST);
    echo "<br>";
    print_r( $_POST["usuario"]);

    print_r( $_FILE);
    echo "<br>";
    print_r( $_FILES["Fichero"]["name"]);