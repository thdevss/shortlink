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
        return $this->query("SELECT IFNULL(v_ua_browser, 'Unknown') as name, count(*) as cnt FROM `tb_viewer` group by v_ua_browser order by cnt desc")->getResultArray();
    }

    public function total_visitors()
    {
        return $this->query("SELECT count(*) as cnt FROM `tb_viewer`")->getResultArray()[0]['cnt'];
    }

    public function visitors_in_7days()
    {
        return $this->query("SELECT DATE(created_at) as date, count(*) as cnt FROM `tb_viewer` where created_at > now() - INTERVAL 15 day group by DATE(created_at)")->getResultArray();
    }
}