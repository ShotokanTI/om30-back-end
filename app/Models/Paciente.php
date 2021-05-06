<?php

namespace App\Models;

use CodeIgniter\Model;

class Paciente extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'pacientes';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'App\Entities\Paciente';
	protected $useSoftDelete        = false;
	protected $allowedFields        = ['Nome', 'Sobrenome', 'Data_Nascimento', 'Foto_Paciente', 'Nome_Mae', 'Sobrenome_Mae', 'Cpf', 'CNS'];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [
		'Nome' => 'required|alpha|max_length[12]',
		'Sobrenome' => 'required|alpha|max_length[25]',
		'Nome_Mae' => [
			'label' => 'Nome da mãe',
			'rules' => 'required|alpha|max_length[12]',
		],
		'Sobrenome_Mae' => [
			'label' => 'Sobrenome da mãe',
			'rules' => 'required|alpha|max_length[25]',
		],
		'Data_Nascimento' => [
			'label' => 'Data de nascimento',
			'rules' => 'required',
		],
		'Cpf' => 'required|is_unique[pacientes.Cpf]|string|ValidarCpf',
		'CNS' => 'required|integer|is_unique[pacientes.CNS]|ValidaCns',
	];
	protected $validationMessages   = [];
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

	public function updatePaciente($data, $dataUpdate)
	{
		try {
			if (!$this->update($data, $dataUpdate)) {
				return json_encode(['errors' => $this->errors()]);
			}
		} catch (\Exception $e) {
			return json_encode(['noData' => $e->getMessage()]);
		}
	}
}
