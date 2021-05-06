<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Enderecos extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'Client_ID' => [
				'type' => 'INT',
				'unsigned' => TRUE,
			],
			'Cep' => [
				'type' => 'varchar',
				'constraint' => '9',
				'null' => false,
				'unique' => true
			],
			'Logradouro' => [
				'type' => 'varchar',
				'constraint' => '40',
			],
			'Complemento' => [
				'type' => 'varchar',
				'constraint' => '60',
			],
			'Bairro' => [
				'type' => 'varchar',
				'constraint' => '30',
			],
			'Localidade' => [
				'type' => 'varchar',
				'constraint' => '40',
			],
			'Uf' => [
				'type' => 'CHAR',
				'constraint' => 2,
			],
			'Ibge' => [
				'type' => 'integer',
			],
			'Gia' => [
				'type' => 'integer',
			],
			'ddd' => [
				'type' => 'integer',
				'constraint' => 2
			],
			'Siafi' => [
				'type' => 'integer',
			],
		]);
		$this->forge->addKey('id', true, true);
		$this->forge->addForeignKey('Client_ID','pacientes','id','CASCADE','CASCADE');
		$this->forge->createTable('enderecos');
	}

	public function down()
	{
		$this->forge->dropTable('enderecos', TRUE);
	}
}
