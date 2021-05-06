<?php

namespace App\Entities;

use CodeIgniter\Entity;

class Endereco extends Entity
{
    protected $attributes = [
        'Client_ID' => null,
        'Cep' => null,
        'Logradouro' => null,
        'Bairro' => null,
        'Localidade' => null,
        'Uf' => null,
    ];
}
