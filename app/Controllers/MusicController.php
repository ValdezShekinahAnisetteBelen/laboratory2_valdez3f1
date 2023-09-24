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
        // Get the data from your form or request, I assume you have these variables defined.
        $title = $this->request->getVar('title');
        $artist = $this->request->getVar('artist');
        $file_path = $this->request->getVar('file_path');
        $duration = $this->request->getVar('duration');

        $data = [
            'title' => $title,
            'artist' => $artist,
            'file_path' => $file_path,
            'duration' => $duration,
            'created_at' => date('Y-m-d H:i:s') // You can set the created_at field to the current date and time
        ];

        // Insert the record into the database using $this->model
        if ($this->model->insert($data)) {
            echo 'Audio record inserted successfully.';
        } else {
            echo 'Error inserting audio record: ' . $this->model->errors();
        }
    }

    public function delete($id)
    {
        // Delete the record by ID using $this->model
        $this->model->delete($id);
        return redirect()->to('/music_view');
    }

    public function save()
    {
        // Get the data from your form or request
        $data = [
            'title' => $this->request->getVar('title'),
            'artist' => $this->request->getVar('artist'),
            'file_path' => $this->request->getVar('file_path'),
            'duration' => $this->request->getVar('duration'),
        ];

        // Save or update the record using $this->model
        $this->model->save($data);
        return redirect()->to('/music_view');
    }

    public function music_view()
    {
        // Fetch music data from the model using the getAllMusic method
        $musicData = $this->model->getAllMusic();

        // Pass the music data to your view.
        $data = [
            'music_view' => $musicData,
        ];

        return view('music_view', $data); // Load the 'music_view.php' view
    }

    public function index()
    {
        // Fetch music data from the model using the getAllMusic method
        $musicData = $this->model->getAllMusic();

        // Pass the music data to your view.
        $data = [
            'music_view' => $musicData,
        ];

        return view('music_view', $data);
    }

    public function search()
    {
        $searchQuery = $this->request->getGet('search');

        // Search for music data using $this->model->searchMusic($searchQuery)
        $filteredMusicData = $this->model->searchMusic($searchQuery);

        // Pass the filtered music data to your view.
        $data = [
            'music_view' => $filteredMusicData,
        ];

        return view('music_view', $data);
    }
}
?>