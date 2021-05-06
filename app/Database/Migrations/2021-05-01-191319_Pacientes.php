<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pacientes extends Migration
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
			'Nome' => [
				'type' => 'varchar',
				'constraint' => '15',
				'null' => false,
			],
			'Sobrenome' => [
				'type' => 'varchar',
				'constraint' => '40',
				'null' => false,
			],
			'Data_Nascimento' => [
				'type' => 'DATETIME',
				'null' => false,
			],
			'Foto_Paciente' => [
				'type' => 'varchar',
				'constraint' => '55',
				'null' => true,
			],
			'Nome_Mae' => [
				'type' => 'varchar',
				'constraint' => '15',
				'null' => false,
			],
			'Sobrenome_Mae' => [
				'type' => 'varchar',
				'constraint' => '40',
				'null' => false,
			],
			'Cpf' => [
				'type' => 'varchar',
				'constraint' => '15',
				'null' => false,
				'unique' => true,
			],
			'CNS' => [
				'type' => 'varchar',
				'constraint' => '40',
				'null' => false,
				'unique' => true,
			],
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('pacientes',TRUE);
	}

	public function down()
	{
		$this->forge->dropTable('pacientes', TRUE);
	}
}
