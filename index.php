<?php
    require_once(__DIR__.'/vendor/autoload.php');
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    $request = strtok($_SERVER['REQUEST_URI'],'?');
    session_start();
    switch($request){
        case $_ENV['ROOT']:
            include __DIR__.'/views/home.php';
            break;
        case $_ENV['ROOT'].'getdata.php':
            include __DIR__."/src/getdata.php";
            break;
        case $_ENV['ROOT'].'createtable.php':
            include __DIR__.'/src/createtable.php';
            break;
        case $_ENV['ROOT'].'importfile.php':
            include __DIR__.'/src/importfile.php';
            break;
        case $_ENV['ROOT'].'save.php':
            include __DIR__.'/src/save.php';
            break;
        case $_ENV['ROOT'].'clear.php':
            include __DIR__.'/src/clear.php';
            break;
        default:
            include __DIR__.'/views/notfound.php';
            break;
    }
?>