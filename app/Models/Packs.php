<?php

namespace App\Models;

use CodeIgniter\Model;

class Packs extends Model
{
    protected $table            = 'packs';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id',
        'name',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules = [
        'id'   => 'permit_empty|integer',
        'name' => 'required|max_length[255]|min_length[1]|is_unique[packs.name]',
    ];
    protected $validationMessages = [
        'name' => [
            'is_unique' => 'Sorry. That pack name is already in use.',
        ],
    ];
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

    public function getPacks(): array
    {
        $sql = "
        SELECT packs.id, packs.name, COUNT(cards.id) AS cardCount
        FROM packs
        LEFT JOIN cards ON
         packs.id = cards.pack_id
        GROUP BY packs.name";

        return $this->db->query($sql)->getResult('array');
    }
}
