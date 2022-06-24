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

    protected $allowedFields = ['link_id', 'raw_useragent', 'raw_referrer', 'v_ipaddr', 'v_useragent',' v_referrer', 'v_ua_browser', 'v_ua_device', 'v_ua_os'];

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

    public function get_browser_summary()
    {
        $userModel = model('App\Models\UserModel');

        $this->select("IFNULL(v_ua_browser, 'Unknown') as name, count(*) as cnt");
        $this->groupBy("v_ua_browser");
        $this->orderBy("cnt", "desc");
        
        if(!$userModel->is_admin()) {
            $user_id = session()->get('user_id');
            $this->where("`link_id` IN (SELECT `id` FROM `tb_link` WHERE user_id = '".$user_id."')", NULL, FALSE);
        }

        return $this->findAll();
    }

    public function total_visitors()
    {
        $userModel = model('App\Models\UserModel');

        $this->select("count(*) as cnt");
        if(!$userModel->is_admin()) {
            $user_id = session()->get('user_id');
            $this->where("`link_id` IN (SELECT `id` FROM `tb_link` WHERE user_id = '".$user_id."')", NULL, FALSE);
        }

        return $this->first()['cnt'];
    }

    public function visitors_in_7days()
    {
        $userModel = model('App\Models\UserModel');

        $this->select("DATE(created_at) as date, count(*) as cnt");
        $this->where('created_at >', 'now() - interval 15 day');
        $this->groupBy('DATE(created_at)');
        if(!$userModel->is_admin()) {
            $user_id = session()->get('user_id');
            $this->where("`link_id` IN (SELECT `id` FROM `tb_link` WHERE user_id = '".$user_id."')", NULL, FALSE);
        }

        return $this->findAll();
    }
}