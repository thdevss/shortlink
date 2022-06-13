<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('page/home');
    }

    public function goToLink($link_key = null)
    {
        // save data to viewer
        $row = $this->link->where('link_key', $link_key)->select('id, destination_link')->first();

        $this->viewer->insert([
            'link_id' => $row['id'],
            'v_ipaddr' => getClientIpAddress(),
            'raw_referrer' => isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null,
            'raw_useragent' => isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : null
        ]);

        unset($row['id']);
        echo "<script>window.location.replace(`".$row['destination_link']."`);</script>";
    }
}
