<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migrations extends CI_Controller {

	/**
	 * The constructor
	 * Load the dbforge library
	 */
	public function __construct()
	{  
		parent::__construct();
		$this->load->dbforge();
	}

	/**
	 * up
	 * Visit this route to run all migrations
	 *
	 * @return void
	 */
	public function up()
	{
		$this->dbforge->add_field(
			[
                'id' => [
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ],
                'username' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                    'null' => false,
                    'unique' => true
                ],
                'email' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                    'null' => false,
                    'unique' => true
                ],
                'is_active' => [
                    'type' => 'INT',
                    'constraint' => 1,
                    'default'  => 0,
                    'null' => false
                ],
                'is_verified' => [
                    'type' => 'INT',
                    'constraint' => 1,
                    'default'  => 0,
                    'null' => false
                ],
                'created_at' => [
                    'type' => 'INT',
                    'constraint' => 255,
                    'null' => false
                ],
                'updated_at' => [
                    'type' => 'INT',
                    'constraint' => 255,
                    'null' => true
                ]
            ]
		);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('users');

		$this->dbforge->add_field(
			[
                'id' => [
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ],
                'title' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                    'null' => false,
                    'unique' => true
                ],
                'description' => [
                    'type' => 'TEXT'
                ],
                'image' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                    'default' => 'default.jpg',
                    'null' => false
                ],
                'status' => [
                    'type' => 'INT',
                    'constraint' => 1,
                    'default'  => 0,
                    'null' => false
                ],
                'created_at' => [
                    'type' => 'INT',
                    'constraint' => 255,
                    'null' => false
                ],
                'updated_at' => [
                    'type' => 'INT',
                    'constraint' => 255,
                    'null' => true
                ]
            ]
		);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('products');

		$this->dbforge->add_field(
            [
                'id' => [
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ],
                'user_id' => [
                    'type' => 'INT',
                    'constraint' => 5,
                    'null' => false
                ],
                'product_id' => [
                    'type' => 'INT',
                    'constraint' => 255,
                    'null' => false
                ],
                'price' => [
                    'type' => 'INT',
                    'constraint' => 255,
                    'null' => 255,
                    'default' => 0
                ],
                'amount_in_stock' => [
                    'type' => 'INT',
                    'constraint' => 255,
                    'null' => false,
                    'default' => 0
                ],
                'created_at' => [
                    'type' => 'INT',
                    'constraint' => 255,
                    'null' => false
                ],
                'updated_at' => [
                    'type' => 'INT',
                    'constraint' => 255,
                    'null' => true
                ]
            ]
		);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('user_products');
	}

	/**
	 * down
	 * Call this route o roll back the changes to the database
	 *
	 * @return void
	 */
	public function down()
	{
		$this->dbforge->drop_table('users');
		$this->dbforge->drop_table('products');
		$this->dbforge->drop_table('user_products');

	}
}
