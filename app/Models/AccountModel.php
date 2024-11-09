<?php

namespace App\Models;
use CodeIgniter\Model;

class AccountModel extends Model
{
    protected $table = 'accounts';
    protected $primaryKey = 'account_id';
    protected $allowedFields = [
        'name',
        'email',
        'password',
        'token',
        'type',
        'status'
    ];
}