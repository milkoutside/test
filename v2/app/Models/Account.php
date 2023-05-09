<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    public function __construct($accountName, $WebSite, $Phone)
    {
        $this->accountName = $accountName;
        $this->WebSite = $WebSite;
        $this->Phone = $Phone;
    }

    private $accountName;
    private $WebSite;
    private $Phone;

    public function getAccount()
    {
        return [
            'data'=>[
                [
                    'Account_Name' => $this->accountName,
                    'Website' =>$this->WebSite,
                    'Phone' =>$this->Phone,
                ]
            ],
            'trigger'=>[
                'approval',
                'workflow',
                'blueprint'
            ]
        ];
    }
}
