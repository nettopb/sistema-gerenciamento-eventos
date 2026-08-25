<?php

require_once __DIR__ . '/../Core/Auth.php';

class HomeController
{
    public function index()
    {
        require __DIR__ .
            '/../Views/home/index.php';
    }
}