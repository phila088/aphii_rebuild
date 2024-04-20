<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public $currentUser;
    public function __construct()
    {
        $this->currentUser = auth()->user();
    }
}
