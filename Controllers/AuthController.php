<?php

class AuthController
{
    public function login()
    {
        
    }
    public function logout()
    {
        session_start();

        session_unset();
        session_destroy();

        header("Location: /krear3dperu");
        exit();
    }
}
