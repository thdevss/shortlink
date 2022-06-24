<?php

namespace App\Controllers;

class Cron extends BaseController
{

    public function generate_report()
    {
        $Browser = new \foroco\BrowserDetection();

        // save data to viewer
        $row = $this->viewer->where('v_ua_browser', null)->where('raw_useragent !=', null)->first();
        if(@$row['raw_useragent']) {
            var_dump($row);
            var_dump($UA_report);

            $UA_report = $Browser->getAll($row['raw_useragent']);

            $status = $this->viewer
                ->set('v_ua_browser', $UA_report['browser_name'])
                ->set('v_ua_os', $UA_report['os_name'])
                ->set('v_ua_device', $UA_report['os_type'])
                ->where('id', $row['id'])
                ->update();
            
            var_dump($status);
        }

        return;

        
    }
}
