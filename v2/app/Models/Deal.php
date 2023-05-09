<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    use HasFactory;

    public function __construct($dealName, $dealStage)
    {
        $this->dealName = $dealName;
        $this->dealStage = $dealStage;
    }

    private $dealName;

    private $dealStage;
    public function getDeal()
    {
        return [
            'data'=>[
                [
                    'Deal_Name' => $this->dealName,
                    'Stage' => $this->dealStage,
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
