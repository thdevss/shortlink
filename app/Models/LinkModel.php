<?php
namespace App\Models;

use CodeIgniter\Model;

class LinkModel extends Model
{
    protected $table      = 'tb_link';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['destination_link', 'link_key', 'remark', 'ipaddr_created', 'user_id'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = '';

    protected $validationRules    = [
        'link_key'     => 'required',
        'destination_link'     => 'required|valid_url_strict',
        'ipaddr_created' => 'required|valid_ip'
    ];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}