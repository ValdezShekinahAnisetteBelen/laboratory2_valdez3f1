<?php 
namespace App\Controllers;

use CodeIgniter\Controller;

class MusicController extends Controller
{
    private $music_model;
    private $playlist_model;
    private $playlist_track;
    private $db;
    public function __construct()
    {
        $this->music_model = new \App\Models\MusicModel();
        $this->playlist_model = new \App\Models\PlaylistsModel();
        $this->playlist_track = new \App\Models\MusicPlayModel();
        $this->db = \Config\Database::connect();
        helper('form');
    }

    public function index()
    {
        $where = 'home';
        // Fetch music data from the model using the getAllMusic method
        $musicData = $this->music_model->findAll();
        $playlist_model = $this->playlist_model->findAll();
        // var_dump($musicData);
        // Pass the music data to your view.
        $data = [
            'music_view' => $musicData,
            'playlist_model' => $playlist_model,
            'playlist_track'=> $this->playlist_track->findAll(),
            'where' => $where,
            
        ];
        // var_dump($data['music_view']);

        return view('music_view', $data);
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
    public function save()
    {
        // Get the data from your form or request
        $data = [
            'title' => $this->request->getVar('title'),
            'artist' => $this->request->getVar('artist'),
            'file_path' => $this->request->getVar('file_path'),
            'duration' => $this->request->getVar('duration'),
        ];

        // Save or update the record using $this->request
        $this->music_model->save($data);
        return redirect()->to('/music_view');
    }
    // public function insertAudio()
    // {
    //     $title = $this->music_model->getVar('title');
    //     $artist = $this->music_model->getVar('artist');
    //     $file_path = $this->music_model->getVar('file_path');
    //     $duration = $this->music_model->getVar('duration');

    //     $data = [
    //         'title' => $title,
    //         'artist' => $artist,
    //         'file_path' => $file_path,
    //         'duration' => $duration,
    //         'created_at' => date('Y-m-d H:i:s')
    //     ];

    //     if ($this->music_model->insert($data)) {
    //         echo 'Audio record inserted successfully.';
    //     } else {
    //         echo 'Error inserting audio record: ' . $this->music_model->errors();
    //     }
    // }
    public function saveEdit()
    {
        try {
            // Fetch the music ID from the request
            $musicID = $this->request->getVar('musicID');
            
            // Fetch the selected playlist ID from the request
            $playlistID = $this->request->getVar('playlist');

            // Prepare the data to be inserted into the music_playlists table
            $data = [
                'music_id' => $musicID,
                'playlist_id' => $playlistID,
            ];

            // Insert the data into the music_playlists table
            $insertResult = $this->playlist_track->insert($data);

            if ($insertResult) {
                // Redirect back to the music view or wherever appropriate
                return redirect()->to('/music_view');
            } else {
                // Handle the case where the insertion fails
                return redirect()->to('/music_view')->with('error', 'Failed to add music to playlist');
            }
        } catch (\Exception $e) {
            // Handle any exceptions that occur during database operations
            return redirect()->to('/music_view')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    
    public function viewPlaylist($playlistID)
    {

        $where = 'playlist';
        $builder = $this->db->table('music_playlists');

        $builder->select('music_playlists.id, music.*');

        $builder->join('music', 'music.id = music_playlists.music_id');

        $builder->where('music_playlists.playlist_id', $playlistID);

        $musicInPlaylist = $builder->get()->getResultArray();

        $data = [
            'music_view' => $musicInPlaylist,
            'playlist_model' => $this->playlist_model->findAll(),
            'where' => $where,
            'playlist_track'=> $this->playlist_track->findAll(),
  
          
        ];

        return view('music_view', $data);
    }
    

//     public function playlist($playlistId)
// {
//     log_message('debug', 'Playlist ID: ' . $playlistId);
  
//     $playlist = $this->playlist_model->find($playlistId);

//     if ($playlist) {
       
//         $musicItems = $this->playlist_track->getMusicByPlaylist($playlistId);

       
//         $data = [
//             'playlist' => $playlist,
//             'musicItems' => $musicItems,
//         ];

//         return view('playlist_view', $data); 
//     } else {
      
//         return view('playlist_not_found'); 
//     }

    
// }
public function removeFromPlaylist($musicID)
{
    
    try {
        // Perform the removal operation in your model
        $result = $this->playlist_track->removeMusicFromPlaylist($musicID);

        if ($result) {
            return redirect()->to('/music_view');
        } else {
            // Handle errors as needed
            echo "Failed to remove music from the playlist.";
        }
    } catch (\Exception $e) {
        // Log the exception or display an error message
        log_message('error', $e->getMessage());
        echo "An error occurred: " . $e->getMessage();
    }
}



  

     public function delete($id)
     {
       
         $referencesExist = $this->music_model->hasReferencesInMusicPlaylists($id);
    
         if ($referencesExist) {
             
             $this->music_model->removeReferencesInMusicPlaylists($id);
         }
    
        
         $this->music_model->delete($id);
    
         return redirect()->to('/music_view');
     }

    


    
    public function search()
{
    $where = 'home';

    // Get the search query parameter from the request
    $searchQuery = $this->request->getVar('search');

    // Search for music data using $this->model->searchMusic($searchQuery)
    $filteredMusicData = $this->music_model->searchMusic($searchQuery);

    // Pass the filtered music data to your view.
    $data = [
        'music_view' => $filteredMusicData,
        'playlist_model' => $this->playlist_model->findAll(),
        'where' => $where,
        'playlist_track'=> $this->playlist_track->findAll(),
    ];

    return view('music_view', $data);
}
}
?>