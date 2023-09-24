<?php

namespace App\Models;

use CodeIgniter\Model;

class MusicPlayModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'music_playlists';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['music_id', 'playlist_id'];

    

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

    public function removeMusicFromPlaylist($musicID)
{
    $builder = $this->db->table('music_playlists');
    $builder->where('music_id', $musicID);
    $builder->delete();

    // Return true if the deletion was successful, or false otherwise
    return $this->db->affectedRows() > 0;
}

}
