<?php

class record {
	
	private $db;
	private $table;
	public $data;

	public function __construct( db $db, $id = null ) {
		$this->db = $db;
		$this->table = $db->get( $this->getTableName() );
		
		if ( array_key_exists($id, $this->table) ) {
			$this->id = $id;
			$this->data = $this->table[$id];
		} else {
			$this->id = count($this->table);
			$this->data = $this->setDefaultValues();
		}
	}

	public function id() {
		return $this->id;
	}

	public function save() {
		foreach ( $this->getRequiredColumns() as $column => $type ) {
			if ( empty($this->data[$column]) ) {
				throw new Exception(sprintf("Column %s cannot be empty", $column));
				return false;
			} elseif ( gettype($this->data[$column]) !== $type ) {
				throw new Exception(sprintf("The value for %s must be %s, you passed in %s.", $column, $type, gettype($this->data[$column])));
			}
		}

		$this->table[$this->id()] = $this->data;
		$this->doSave();
	}

	public function delete() {
		array_splice($this->table, $this->id(), 1);
		$this->id = count($this->table); // reset the id, in case someone does something stupid.
		$this->doSave();
	}

	private function doSave() {
		$this->db->set( $this->getTableName(), $this->table);
		$this->db->save();
	}

	public final function get( $key ) {
		if ( array_key_exists($key, $this->data) ) {
			return $this->data[$key];
		}

		return false;
	}

	public final function set( $key, $value ) {
		return $this->data[$key] = $value;
	}
}