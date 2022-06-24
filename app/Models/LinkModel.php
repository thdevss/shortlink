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

    public function total_links()
    {
        $userModel = model('App\Models\UserModel');

        $this->select("count(*) as cnt");
        if(!$userModel->is_admin()) {
            $user_id = session()->get('user_id');
            $this->where('user_id', $user_id);
        }

        return $this->first()['cnt'];

    }

    public function get_top10_links()
    {
        $userModel = model('App\Models\UserModel');

        $this->select("tb_link.*, IF(tb_link.user_id != 0, (SELECT email_address FROM tb_user WHERE id = tb_link.user_id LIMIT 1) , '-- GUEST --') as creator, count(tb_viewer.id) as total_visitors");
        $this->join('tb_viewer', 'tb_viewer.link_id = tb_link.id');
        $this->groupBy('tb_link.id');
        $this->orderBy('total_visitors', 'DESC');

        if(!$userModel->is_admin()) {
            $user_id = session()->get('user_id');
            $this->where('user_id', $user_id);
        }

        return $this->findAll();


    }
}