<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JobController extends Controller
{
    function index() {
        return "halaman lowongan";
    }

    function dashboard() {
        return "Halaman job Admin";
    }
}
