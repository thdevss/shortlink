<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\LinkModel;

class Link extends ResourceController
{
    protected $link;
    protected $viewer;

    protected $format    = 'json';
    // Prefered way
    public function __construct()
    {
        $this->link  = model('App\Models\LinkModel');
        $this->viewer  = model('App\Models\ViewerModel');
        helper(["app", "text"]);

    }
    
    public function create()
    {

        $saveData = (array) $this->request->getJSON();
        $saveData['ipaddr_created'] = getClientIpAddress();
        $saveData['link_key'] = random_string('crypto', 8);

        $created = $this->link->insert($saveData);

        if(!$created) {
            return $this->respond([
                'status' => false,
                'data' => $this->link->errors(),
                'message' => 'failed.'
            ]);
        }

        // get latest link_key
        $link_key = $this->link->where('id', $this->link->insertID())->select('link_key')->first();
        return $this->respond([
            'status' => true,
            'data' => $link_key,
            'message' => 'successful'
        ]);
    }

}