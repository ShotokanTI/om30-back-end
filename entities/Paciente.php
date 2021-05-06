<?php

namespace App\Entities;

use CodeIgniter\Entity;

class Paciente extends Entity
{
    protected $attributes = [
        'Nome' => null,
        'Sobrenome' => null,
        'Data_Nascimento' => null,
        'Foto_Paciente' => null,
        'Nome_Mae' => null,
        'Sobrenome_Mae' => null,
        'Cpf' => null,
        'CNS' => null,
    ];
}
