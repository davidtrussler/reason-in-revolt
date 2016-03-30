<?php

class Sessions {
	// unset all session variables
	public function unsetAll() {
		if (isset($_SESSION['emptyFieldArray'])) {
			unset($_SESSION['emptyFieldArray']); 
		}
		
		if (isset($_SESSION['validatedEmail'])) {
			unset($_SESSION['validatedEmail']); 
		}
		
		if (isset($_SESSION['validCaptcha'])) {
			unset($_SESSION['validCaptcha']); 
		}
		
		if (isset($_SESSION['commentAuthor'])) {
			unset($_SESSION['commentAuthor']); 
		}
		
		if (isset($_SESSION['commentEmail'])) {
			unset($_SESSION['commentEmail']); 
		}
		
		if (isset($_SESSION['commentWebsite'])) {
			unset($_SESSION['commentWebsite']); 
		}
		
		if (isset($_SESSION['commentBody'])) {
			unset($_SESSION['commentBody']); 
		}
		
		if (isset($_SESSION['saveComment'])) {
			unset($_SESSION['saveComment']); 
		}
	}
}

?>