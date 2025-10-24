<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MairieController extends Controller
{
    public function index()
    {
        $json = File::get(public_path('data/mairies.json'));
        $mairies = json_decode($json, true);
        return view('liste-des-mairies', ['mairies' => $mairies]);
    }
}