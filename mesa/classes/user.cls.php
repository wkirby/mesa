<?php

class user extends record {

	public function getTableName() {
		return 'users';
	}

	public function getRequiredColumns() {
		return array(
			'email' => "string",
			'hashword' => "string"
		);
	}

	public function setDefaultValues() {
		$this->email = "";
		$this->hashword = "";
	}

	public static function getByID( $id ) {
		return new self( db::getByName('users.json'), $id );
	}

	public static function getByEmail( $email ) {
		$users = db::getByName('users.json')->get('users');
		$id = db::getIndexForItem($users, 'email', $email);

		if ( $id !== false ) {
			return self::getByID($id);
		} else {
			throw new Exception( sprintf("User %s does not exist", $email) );
			return false;
		}
	}
}