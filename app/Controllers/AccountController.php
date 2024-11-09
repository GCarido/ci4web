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
        // $headers = 'MIME-Version:1.0'. "\r\n";
        // $headers = 'Content-type: text/html; charset=iso8859-1'. "\r\n";
        $email = \Config\Services::email();
        $email->setMailType("html"); // Make styling and html tags work
        $email->setTo($to);
        $email->setFrom(
            'geraldcastcarido@gmail.com',
            $subject
        );
        $email->setMessage($message);

        if ($email->send()) {
            echo "Email sent successfully";
        } else {
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

        if ($this->validate($rules)) {
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
            $message = "Hello {$name}! Welcome to the website. To continue, please confirm your account by clicking this <a href='" . base_url() . "/verify/{$token}'>link</a>";

            $this->sendMail($to, $subject, $message);

            return redirect('signin');
        } else {
            $data['validation'] = $this->validator;
            echo view('register', $data);
        }
    }

    public function verify($id = null)
    {
        $accountModel = new AccountModel();
        $account = $accountModel->where('token', $id)->first();
        $session = session();

        if ($account) {
            $data = [
                'token' => $this->token(100),
                'status' => 'active'
            ];

            $accountModel->set($data)->where('token', $id)->update();

            $session->setFlashdata('msg', 'Your account was verified!');
            $session->setFlashdata('msg_type', 'success');
        } else {
            $session->setFlashdata('msg', 'Invalid link or it expired already.');
            $session->setFlashdata('msg_type', 'danger');
        }

        return redirect('signin');
    }

    public function signin()
    {
        return view('signin');
    }

    public function auth()
    {
        $session = session();

        $accountModel = new AccountModel();

        $email = $this->request->getVar('email');

        $password = $this->request->getVar('password');

        $account = $accountModel->where('email', $email)->first();

        if ($account) { // Check if email exists
            $pass = $account['password'];
            $authPassword = password_verify($password, $pass);

            if ($authPassword) { // Check if password is correct
                if ($account['status'] === 'active') {
                    $session_data = [
                        'id' => $account['id'],
                        'name' => $account['name'],
                        'email' => $account['email'],
                        'isLoggedIn' => TRUE
                    ];

                    $session->set($session_data);
                    return redirect()->to('home');
                } else {
                    $session->setFlashdata('msg', 'Account was not verified');
                    return redirect('signin');
                }
            } else {
                $session->setFlashdata('msg', 'Invalid Email or Password');
                return redirect('signin');
            } 
        } else {
            $session->setFlashdata('msg', 'Account does not Exist');
            return redirect('signin');
        }
    }
}
