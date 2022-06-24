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
        return $this->query("SELECT count(*) as cnt FROM `tb_link`")->getResultArray()[0]['cnt'];
    }

    public function get_top10_links()
    {
        return $this->query("SELECT tb_link.*, IF(tb_link.user_id != 0, (SELECT email_address FROM tb_user WHERE id = tb_link.user_id LIMIT 1) , '-- GUEST --') as creator, count(tb_viewer.id) as total_visitors FROM `tb_link` JOIN tb_viewer ON tb_viewer.link_id = tb_link.id GROUP BY tb_link.id ORDER BY total_visitors DESC")->getResultArray();
    }
}