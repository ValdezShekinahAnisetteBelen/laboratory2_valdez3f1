<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class MusicController extends Controller
{
    private $model;
    public function __construct()
    {
        $this->model = new \App\Models\MusicModel();
       
      
    }

    public function insertAudio()
{
    // Get a reference to the MusicModel
    $model = new MusicModel();

    // Actual data from your form or other sources
    $title = $_POST['title']; // Replace with the actual title
    $artist = $_POST['artist']; // Replace with the actual artist
    $file_path = '/path/to/your/audio/file.mp3'; // Replace with the actual file path
    $duration = 240; // Replace with the actual duration (in seconds)

    // Create an array with the data
    $data = [
        'title' => $title,
        'artist' => $artist,
        'file_path' => $file_path,
        'duration' => $duration,
        'created_at' => date('Y-m-d H:i:s') // You can set the created_at field to the current date and time
    ];

    // Insert the record into the database
    if ($model->insert($data)) {
        echo 'Audio record inserted successfully.';
    } else {
        echo 'Error inserting audio record: ' . $model->errors();
    }
}


    public function music_view($music_view)
    {
        echo $music_view;
    }
    public function shekinah()
    {
        return view('music_view');
    }
    public function index()
    {
       
    }
}