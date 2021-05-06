<?php

namespace App\Models;

use CodeIgniter\Model;

class Enderecos extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'enderecos';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'App\Entities\Endereco';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['Client_ID','Cep', 'Logradouro', 'Bairro', 'Localidade', 'Uf'];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [
		'Cep' => 'required|is_unique[enderecos.Cep]|string',
		'Uf' => [
			'label' => 'Estado',
			'rules' => 'required|max_length[2]',
		],
		'Bairro'=>'required',
		'Logradouro' => [
			'label' => 'Rua',
			'rules' => 'required',
		],
		'Localidade' => [
			'label' => 'Cidade',
			'rules' => 'required',
		],
	];
	protected $validationMessages = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];
}
