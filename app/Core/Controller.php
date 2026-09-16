<?php

class Controller
{
    protected function view($view, $data = [])
    {
        extract($data);
        require __DIR__ . '/../Views/' . $view . '.php';
    }

    protected function redirect($path)
    {
        header('Location: ' . url($path));
        exit;
    }

    protected function abort($status, $message)
    {
        http_response_code($status);
        $this->view('errors/error', [
            'status' => $status,
            'message' => $message
        ]);
        exit;
    }
}
