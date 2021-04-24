<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        $title = 'Welcome to laravel sent from controller';
        return view('pages.index')->with('title', $title);
    }

    public function about()
    {
        $title = 'about title sent from controller';
        return view('pages.about')->with('title', $title);
    }

    public function services()
    {
        $data = array(
            'title' => 'Services',
            'services' => ['CRM Softwares', 'Web ', 'DEMO_graphics ', 'Laravel ', 'Bootstrap ',]
        );
        return view('pages.services')->with($data);
    }

    public function bookAppointment()
    {

        return view('pages.book');
    }

    public function welcomeruser()
    {

        return view('users.index');
    }
}
