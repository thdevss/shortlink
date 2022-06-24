<?php

namespace App\Controllers;

class Backoffice extends BaseController
{
    protected $link;
    protected $viewer;

    // Prefered way
    public function __construct()
    {
        // check tb_user.session_key

        $this->user  = model('App\Models\UserModel');
        helper(["app", "text", "session"]);

    }
    
    public function login()
    {
        $session = session();

        $rules = [
            'email'         => 'required|min_length[4]|max_length[100]|valid_email',
            'password'      => 'required|min_length[4]|max_length[50]',
        ];

        if($this->validate($rules)){
            $email = $this->request->getVar('email');
            $password = $this->request->getVar('password');
            
            $data = $this->user->where('email_address', $email)->first();
            if($data) {

                if( password_verify($password, $data['password']) ) {
                    $SESSION_KEY = random_string('crypto', 32);
                    $this->user->where('email_address', $email)->set('session_key', $SESSION_KEY)->update();
                    $ses_data = [  
                        'user_id' => $data['id'],
                        'session_key' => $SESSION_KEY,
                        'isLoggedIn' => TRUE
                    ];
                    $session->set($ses_data);

                    return redirect()->to('/backoffice/dashboard?1');
                    // var_dump($ses_data);
                
                } else {
                    $session->setFlashdata('msg', 'Password is incorrect.');
                    return redirect()->to('/backoffice/login');
                }
            } else {
                $session->setFlashdata('msg', 'Account not found.');
                return redirect()->to('/backoffice/login');
            }
        } else {
            if( $this->validator && ( $this->request->getVar('email') || $this->request->getVar('password')) ) {
                $session->setFlashdata('msg', $this->validator->listErrors());
            }
        }

        return view('page/backoffice/login');
    }

    public function logout()
    {
        if(session()->has('session_key')) {
            $this->user->set('session_key', null)->where('session_key', session()->get('session_key'))->update();
            session()->destroy();
        }
       
        return redirect()->to('/backoffice/login');

    }

    public function dashboard()
    {
        $stats = [
            'link' => $this->link->total_links(),
            'visitors' => $this->viewer->total_visitors(),
            'browsers' => $this->viewer->get_browser_summary(),
            'top10_links' => $this->link->get_top10_links(),
            'visitors_in_7days' => [
                "label" => [],
                "val" => []
            ]
        ];

        foreach($this->viewer->visitors_in_7days() as $r) {
            array_push($stats['visitors_in_7days']['label'], $r['date']);
            array_push($stats['visitors_in_7days']['val'], $r['cnt']);
        }

        

        echo view('page/backoffice/header', [ 
            'userdata' => $this->userdata(),
            'head_title' => 'Dashboard'
        ]);
        echo view('page/backoffice/dashboard', [
            'stats' => $stats
        ]);
        echo view('page/backoffice/footer');
        return;

    }

    public function link_lists()
    {
        echo "<h3>LINK LISTS</h3>";

        // return view('page/backoffice/login');
    }

    public function link_detail($id = null)
    {
        echo "<h3>LINK DETAIL</h3>";

        // return view('page/backoffice/login');
    }

    private function userdata()
    {
        return $this->user->select('email_address, is_admin, updated_at')->where('session_key', session()->get('session_key'))->first();
    }



}