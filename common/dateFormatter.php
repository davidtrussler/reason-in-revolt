<?php

class DateFormatter {
	function __construct($timestamp) {
		date_default_timezone_set('Europe/London');

		$this->dateTime = new DateTime($timestamp); 
	}

	// returns a formatted date 
	public function formatDate() {
		return $this->dateTime->format('l j F Y'); 
	}

	// returns numeric year 
	public function getNumericYear() {
		return $this->dateTime->format('Y'); 
	}

	// returns numeric month 
	public function getNumericMonth() {
		return $this->dateTime->format('m'); 
	}

	// returns numeric day 
	public function getNumericDay() {
		return $this->dateTime->format('d'); 
	}
}

?>