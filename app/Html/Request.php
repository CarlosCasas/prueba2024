<?php

namespace App\Http;

class Request
{
    private $data;

    public function __construct()
    {
        $this->data = $_REQUEST;
    }

    public function all()
    {
        return $this->data;
    }

    public function input($key, $default = null)
    {
        return isset($this->data[$key]) ? $this->data[$key] : $default;
    }

    // Otros métodos para acceder a datos de la solicitud, como encabezados, métodos HTTP, etc.
}
