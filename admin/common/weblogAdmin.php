<?php

class WeblogAdmin {
	private $ser;	// server; 
	private $use;	// userName
	private $pas;	// passWord
	private $dat;	// database
	private $mysqli;

/*	function __construct() {
		$this->ser = 'localhost';
		$this->use = 'davidtru';
		$this->pas = 'tn23Se59';
		$this->dat = 'davidtru_gimaju'; */
		
	function __construct() {
		$this->ser = 'localhost';
		$this->use = 'root';
		$this->pas = '';
		$this->dat = 'gimaju';

		$this->mysqli = new mysqli($this->ser, $this->use, $this->pas, $this->dat);
	}

	public function checkAuthUser($email, $password) {
		$authUser = 'false'; 
		$password = crypt($password, 'rl'); 

		// USE EXCEPTION HERE
		if ($this->mysqli->connect_errno) {
			return 'Error: could not connect to database!'; 
			exit(); 
		} else {
			$query = "SELECT userId FROM users WHERE email='$email' AND password='$password' LIMIT 1"; 

			$result = $this->mysqli->query($query); 

			if (!$result) {
				return 'Error: no results! '.$this->mysqli->errno.': '.$this->mysqli->error.''; 
			} else {
				if ($result->num_rows > 0) {
					$authUser = 'true'; 
				}
			}
		}

		return $authUser; 
	}

	function __destruct() {
		$this->mysqli->close();
	}
}

?>