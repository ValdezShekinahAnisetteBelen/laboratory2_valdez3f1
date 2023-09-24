<?php 
namespace App\Controllers;

use CodeIgniter\Controller;

class MusicController extends Controller
{
    private $model;
    private $playlist_model;
    public function __construct()
    {
        $this->model = new \App\Models\MusicModel();
        $this->playlist_model = new \App\Models\PlaylistsModel();
    }

    public function insertAudio()
    {
        $title = $this->request->getVar('title');
        $artist = $this->request->getVar('artist');
        $file_path = $this->request->getVar('file_path');
        $duration = $this->request->getVar('duration');

        $data = [
            'title' => $title,
            'artist' => $artist,
            'file_path' => $file_path,
            'duration' => $duration,
            'created_at' => date('Y-m-d H:i:s')
        ];

        if ($this->model->insert($data)) {
            echo 'Audio record inserted successfully.';
        } else {
            echo 'Error inserting audio record: ' . $this->model->errors();
        }
    }

    public function delete($id)
    {
        // Check if there are any references in the music_playlists table
        $referencesExist = $this->model->hasReferencesInMusicPlaylists($id);
    
        if ($referencesExist) {
            // If references exist, remove them first
            $this->model->removeReferencesInMusicPlaylists($id);
        }
    
        // Now, delete the record by ID from the music table
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
    public function saveCreate()
    {
        $validation = \Config\Services::validation();
    
        $validation->setRules([
            'name' => 'required|min_length[3]|max_length[50]', 
        ]);
    
        // Check if validation passed
        if ($validation->withRequest($this->request)->run()) {
            $data = [
                'name' => $this->request->getVar('name'),
            ];
    
            // Use the insert method to insert a new record
            $this->playlist_model->insert($data);
    
            return redirect()->to('/music_view');
        } else {
            $validationErrors = $validation->getErrors();
    
            session()->setFlashdata('errors', $validationErrors);
            return redirect()->back();
        }
    }
    public function index()
    {
        // Fetch music data from the model using the getAllMusic method
        $musicData = $this->model->findAll();
        $playlist_model = $this->playlist_model->findAll();

        // Pass the music data to your view.
        $data = [
            'music_view' => $musicData,
            'playlist_model' => $playlist_model,
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
            'playlist_model' => $this->playlist_model->findAll(),
        ];

        return view('music_view', $data);
    }
}
?>