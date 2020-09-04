<?php
    require_once(__DIR__.'/vendor/autoload.php');
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    $request = strtok($_SERVER['REQUEST_URI'],'?');
    session_start();
    switch($request){
        case '/t3/':
            include __DIR__.'/views/home.php';
            break;
        case '/t3/getdata.php':
            include __DIR__."/src/getdata.php";
            break;
        case '/t3/createtable.php':
            include __DIR__.'/src/createtable.php';
            break;
        case '/t3/importfile.php':
            include __DIR__.'/src/importfile.php';
            break;
        case '/t3/save.php':
            include __DIR__.'/src/save.php';
            break;
        case '/t3/clear.php':
            include __DIR__.'/src/clear.php';
            break;
        default:
            include __DIR__.'/views/notfound.php';
            break;
    }
?>