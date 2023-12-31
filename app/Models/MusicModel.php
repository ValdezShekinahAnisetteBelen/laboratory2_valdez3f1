<?php

namespace App\Models;

use CodeIgniter\Model;

class MusicModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'music';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['title', 'artist', 'file_path', 'duration'];

    public function hasReferencesInMusicPlaylists($musicId)
    {
        
        return $this->db->table('music_playlists')
            ->where('music_id', $musicId)
            ->countAllResults() > 0;
    }

    public function removeReferencesInMusicPlaylists($musicId)
    {

        $this->db->table('music_playlists')
            ->where('music_id', $musicId)
            ->delete();
    }
    public function getAllMusic()
    {
        return $this->findAll();
    }
    public function searchMusic($searchQuery)
    {
        
    $terms = explode(' ', $searchQuery);

    $this->groupStart();

    foreach ($terms as $term) {
        $this->like('title', $term);
        $this->orLike('artist', $term);
    }

    // Close the group
    $this->groupEnd();

    // Get the search results
    return $this->findAll();
    }

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
    
}
