<?php
namespace App\Models;

use CodeIgniter\Model;

class ViewerModel extends Model
{
    protected $table      = 'tb_viewer';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['link_id', 'raw_useragent', 'raw_referrer', 'v_ipaddr', 'v_useragent',' v_referrer'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = '';

    protected $validationRules    = [
        'link_id'     => 'required',
        'v_ipaddr' => 'required|valid_ip'
    ];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}