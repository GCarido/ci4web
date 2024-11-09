<?php

namespace App\Controllers;

use App\Models\AccountModel;

class AccountController extends BaseController
{

    public function register()
    {
        helper(['form']);
        $data = [];
        return view('register', $data);
    }


    public function sendMail()
    {
        $to = 'erningcards@gmail.com';
        $subject = 'Test Email PHP';
        $message = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eum, accusamus temporibus illum vel sint non. Mollitia tempore dignissimos ut perferendis sint? Autem minus culpa assumenda ipsa quos veniam distinctio facilis!';
        $email = \Config\Services::email();
        $email->setTo($to);
        $email->setFrom(
            'geraldcastcarido@gmail.com',
            $subject
        );
        $email->setMessage($message);

        if($email->send()){
            echo "Email sent successfully";
        } else{
            $data = $email->printDebugger(['headers']);
            print($data);
        }
    }

    public function token($length)
    {
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

        return substr(str_shuffle($str_result), 0, $length);
    }

    public function store()
    {
        helper(['form']);
        $rules = [
            'name'  => 'required|min_length[5]|max_length[50]',
            'email' => 'required|min_length[20]|max_length[100]|valid_email|is_unique[accounts.email]',
            'password' => 'required|min_length[8]|max_length[50]',
            'confirmpassword' => 'matches[password]'
        ];

        if($this->validate($rules)){
            $accountModel = new AccountModel();
            $data = [
                'name' => $this->request->getVar('name'),
                'email' => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'token' => $this->token(100),
                'type' => 'client'
            ];

            $accountModel->save($data);

            return redirect('/signin');
        } else{
            $data['validation'] = $this->validator;
            echo view('register', $data);
        }
    }

}
