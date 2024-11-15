<?php

namespace App\Controllers;
use App\Models\ProductModel;

class Home extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }

    public function homepage()
    {
        return view('test_one');
    }

    public function user($id = null)
    {
        $data['id'] = $id;

        return view('test_one', $data);
    }

    public function product()
    {
        $p = new ProductModel();

        // $data['pr'] = $p->where('status', 'active')->findAll();
        $data['products'] = $p->findAll();

        return view('products', $data);
    }

    public function edit($id = null)
    {
        $p = new ProductModel();

        $data['products'] = $p->where('product_id', $id)->first();

        return view('product_edit', $data);
    }

    public function update()
    {
        // $name = $this->request->getVar('name');
        // $description = $this->request->getVar('description');
        // $quantity = $this->request->getVar('quantity');
        // $price = $this->request->getVar('price');
        // $status = $this->request->getVar('status');
        // $product_id = $this->request->getVar('product_id');

        // $data = [
        //     'name' => $name,
        //     'description' => $description,
        //     'quantity' => $quantity,
        //     'price' => $price,
        //     'status' => $status
        // ];


        $product_id = $this->request->getVar('product_id');

        $p = new ProductModel();

        // SHORT METHOD
        $data = $this->request->getVar([
            'name',
            'description',
            'quantity',
            'price',
            'status'
        ]);

        $p->set($data)->where('product_id', $product_id)->update();

        $session = session();

        $session->setFlashdata('msg', 'Product was updated successfully.'); // Flash a message

        return redirect()->to('/product'); // Redirect
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

}
