<?php

class DateFormatter {
	// formats a date 
	public function formatDate($timestamp) {
		date_default_timezone_set('Europe/London');

		$date = new DateTime($timestamp); 
		return $date->format('l j F Y'); 
	}
}

?>