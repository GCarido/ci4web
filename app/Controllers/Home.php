<?php

namespace App\Controllers;
use App\Models\ProductModel;

class Home extends BaseController
{
    public function index(): string
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
}