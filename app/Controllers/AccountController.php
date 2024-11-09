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


    public function sendMail($to, $subject, $message)
    {
        $to = $to;
        $subject = $subject;
        $message = $message;
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
            'email' => 'required|min_length[10]|max_length[100]|valid_email|is_unique[accounts.email]',
            'password' => 'required|min_length[8]|max_length[50]',
            'confirmpassword' => 'matches[password]'
        ];

        if($this->validate($rules)){
            $accountModel = new AccountModel();
            $token = $this->token(100);
            $to = $this->request->getVar('email');
            $name = $this->request->getVar('name');

            $data = [
                'name' => $name,
                'email' => $to,
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'token' => $token,
                'type' => 'client',
                'status' => 'inactive'
            ];

            $accountModel->save($data);

            $subject = "Confirm your registration";
            $message = "Hello {$name}! Welcome to the website. To continue, please confirm your account by clicking this <a href='/verify/{$token}'>link</a>";

            $this->sendMail($to, $subject, $message);

            return redirect('/signin');
        } else{
            $data['validation'] = $this->validator;
            echo view('register', $data);
        }
    }

}
