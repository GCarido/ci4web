<?php

namespace App\Controllers;

class AccountController extends BaseController
{
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

}
