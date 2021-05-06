<?php

namespace App\Controllers;

header('Access-Control-Allow-Origin: *');

class Main extends BaseController
{
	protected $res, $db;
	public $prettyJson = JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE;

	public function __construct()
	{
		$this->res = service('request');
		$this->db = \Config\Database::connect();
	}
	public function index()
	{
	}
	public function saveFile($file,$nameFile)
	{
		if ($file->getSize() > 0) {
			$file->move('public/uploads', $nameFile);
		}
	}
	public function getFilePost($nameFile)
	{
		return $this->res->getFile($nameFile);
	}
	public function getPostData()
	{
		return $this->res->getPost();
	}
	public function existFile($file,$nameFile)
	{
		return $file->getSize() > 0 ? $nameFile : 'Paciente sem foto';
	}
	public function updatePaciente()
	{
		$data = $this->getPostData();

		$pacienteModel = model('Paciente');

		
		$file = $this->getFilePost('Foto_Paciente');
		
		$nameFile = $file->getRandomName();

		$data['Foto_Paciente'] = $this->existFile($file,$nameFile);

		$this->saveFile($file,$nameFile);

		return $pacienteModel->updatePaciente($data['idUpdate'], $data);
	}
	public function manipulateSelectPaciente($paciente)
	{
		$newData = [];
		foreach ($paciente->getResultArray() as $valor) {
			$valor['Foto_Paciente'] = $valor['Foto_Paciente'] != 'Paciente sem foto' ? 'http://localhost:8080/public/uploads/' . $valor['Foto_Paciente'] : 'Paciente sem foto';
			array_push($newData, array_merge(['editar' => $valor['id']], $valor));
		}
		return $newData;
	}
	public function getPaciente()
	{
		$builder = $this->db->table('pacientes');
		$builder->select();
		$onlyPaciente = $builder->get();
		$builder->join('enderecos', 'enderecos.Client_ID = pacientes.id');
		$query = $builder->get();
		$newSelect = $this->manipulateSelectPaciente($onlyPaciente);
		return json_encode(['dadosCompletos' => $query->getResultArray(), 'onlyPaciente' => $newSelect], $this->prettyJson);
	}
	public function getEnderecos()
	{
		$builder = $this->db->table('enderecos');
		$builder->select();
		$query = $builder->get();
		return json_encode($query->getResult(), $this->prettyJson);
	}
	public function addPaciente()
	{
		$data = $this->res->getPost();
		$file = $this->res->getFile('Foto_Paciente');
		$nameFile = $file->getRandomName();
		$paciente = new \App\Entities\Paciente($data);
		$paciente->Foto_Paciente = $this->existFile($file,$nameFile);
		$this->saveFile($file,$nameFile);
		$pacienteModel = model('Paciente');
		$endereco = new \App\Entities\Endereco($data);
		$pacienteEndereco = model('Endereco');
		try {
			if ($pacienteModel->save($paciente) !== false) {
				$endereco->Client_ID = $this->db->insertID();
				$pacienteEndereco->save($endereco);
				return json_encode(['success' => 'O endereço foi salvo com sucesso!'], $this->prettyJson);
			} else {
				try {
					if ($pacienteEndereco->save($endereco) === false) {
						return json_encode(['errors' => array_merge($pacienteEndereco->errors(), $pacienteModel->errors())], $this->prettyJson);
					}
				} catch (\Exception $e) {
					return json_encode(['errors' => $pacienteModel->errors()], $this->prettyJson);
				}
			}
		} catch (\Exception $e) {
			echo $e->getMessage();
			return json_encode($pacienteModel->errors(), $this->prettyJson);
		}
	}

	public function deletarPaciente(){
		$data = $this->res->getJSON();
		$pacienteModel = model('Paciente');
		$pacienteModel->delete($data->id);
	}
}
