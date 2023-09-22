<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class MusicController extends Controller
{
    public function index()
    {
        // Load the database library
        $db = \Config\Database::connect();

        // Fetch music data from the database (example)
        $query = $db->query('SELECT * FROM music');
        $data['music'] = $query->getResult();

        // Load the view and pass data
        return view('music_view', $data);
    }
}