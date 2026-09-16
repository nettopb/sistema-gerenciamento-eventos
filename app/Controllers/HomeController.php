<?php

require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Core/Auth.php';
require_once __DIR__ . '/../Core/CSRF.php';

class HomeController extends Controller
{
    public function index()
    {
        $this->view('home/index');
    }
}
