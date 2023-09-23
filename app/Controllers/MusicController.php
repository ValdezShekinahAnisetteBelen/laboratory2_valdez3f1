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
public function delete($id) {
  $this->model->delete($id);
  return redirect()->to('/music_view');
}
public function save() {
        $data = [
            'title' => $this->request->getVar('title'),
            'artist' => $this->request->getVar('artist'),
            'file_path' => $this->request->getVar('file_path'),
            'duration' => $this->request->getVar('duration'),
        ];
        $this->model->save($data);
        return redirect()->to('/music_view');
       }

    public function music_view($music_view)
    {
        echo $music_view;
    }
    public function shekinah()
    {
        // Assuming you have loaded the database library and the MusicModel in your constructor
        $data['music_view'] = $this->model->getAllMusic(); // Replace with an appropriate method to fetch music data
    
        return view('music_view', $data);
    }
    public function index()
    {
       
    }
}