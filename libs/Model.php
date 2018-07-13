<?php

class Model {

	function __construct() {
		$this->db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
		$this->db->exec("SET CHARACTER SET utf8");
	}
	
	public function check_empty($data, $fields)
	{
		$msgr = null;
		foreach ($fields as $value) {
			if (empty($data[$value])) {
				$msgr .= "$value field empty <br />";
			}
		} 
		return $msgr;
	}
	

}