<?php
namespace App\Models;

use CodeIgniter\Model;

class LinkModel extends Model
{
    protected $table      = 'tb_link';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['destination_link', 'link_key', 'remark', 'ipaddr_created', 'user_id'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

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


    public function getAll()
    {
        $userModel = model('App\Models\UserModel');

        $this->select("*");
        if(!$userModel->is_admin()) {
            $user_id = session()->get('user_id');
            $this->where('user_id', $user_id);
        }

        return $this->findAll();

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

    public function isOwner($link_id)
    {
        $userModel = model('App\Models\UserModel');

        if($userModel->is_admin()) {
            return true; // bypass all if ur admin.
        }

        $this->select("count(*) as cnt");
        $this->where('user_id', session()->get('user_id'));
        $this->where('id', $link_id);


        if($this->first()['cnt'] == 1) {
            return true;
        }

        return false;
        
    }
}