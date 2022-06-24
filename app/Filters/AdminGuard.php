<?php 
namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\UserModel;

class AdminGuard implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $user  = model('App\Models\UserModel');

        if (!session()->has('session_key')) {
            return redirect()->to('/backoffice/login?1');
        } else {
            $row_user = $user->where('is_admin', 1)->where('session_key', session()->get('session_key'))->findAll();
            if(count($row_user) !== 1) {
                // var_dump($row_user);
                session()->destroy();
                return redirect()->to('/backoffice/login?2');
            }
        }

    }
    
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        
    }
}