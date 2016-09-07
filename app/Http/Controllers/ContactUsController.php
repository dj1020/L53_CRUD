<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ContactUsController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }
}
