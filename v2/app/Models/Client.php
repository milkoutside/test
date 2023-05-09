<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    private $clientName = 'saha';

    private $homePage = 'localhost:8000';

    private $redirectUrl = 'http://localhost:8000';

    private $clientId = '1000.IRHZ7X8HJU8DD1ICKAWVQGRPGWY3KG';

    private $clientSecret = '497b85987e689f9613e1a213ff09859003c40ded16';

    public function getClient(): array
    {
        return [
            'client_name' => $this->clientName,
            'home_page' => $this->homePage,
            'redirect_url' => $this->redirectUrl,
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret
        ];
    }
}
