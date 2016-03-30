<?php

class Weblog {
	private $ser;	// server; 
	private $use;	// userName
	private $pas;	// passWord
	private $dat;	// database
	private $mysqli;

	function __construct($DOC_ROOT) {
		include ($DOC_ROOT.'/blog/blog_login.php'); 

		$this->ser = $server;
		$this->use = $user;
		$this->pas = $password;
		$this->dat = $database;

		$this->mysqli = new mysqli($this->ser, $this->use, $this->pas, $this->dat);
	}

	// gets all posts
	public function getPosts() {
		$posts = array(); 

		// USE EXCEPTION HERE
		if ($this->mysqli->connect_errno) {
			return 'Error: could not connect to database!'; 
			exit(); 
		} else {
			$query = "SELECT * FROM blog_posts ORDER BY timestamp DESC"; 

			$result = $this->mysqli->query($query); 

			if (!$result) {
				return 'Error: no results!'; 
			} else {
				while($row = $result->fetch_row()) {
					array_push($posts, $row); 
				} 
			}

			return $posts; 
		}
	}

	// gets all post ids
	public function getPostIds($tagNameId, $month) {
		$postIdArray = array(); 

		// USE EXCEPTION HERE
		if ($this->mysqli->connect_errno) {
			return 'Error: could not connect to database!'; 
			exit(); 
		} else {
			if ($tagNameId) {
				$query = "SELECT blog_tags.postId FROM blog_tags WHERE blog_tags.tagNameId=$tagNameId ORDER BY (SELECT timestamp FROM blog_posts WHERE postId=blog_tags.postId) DESC"; 
			} elseif ($month) {
				date_default_timezone_set('Europe/London');

				$thisMonth = new DateTime($month); 
					$thisMonth = $thisMonth->format('Y-m-d H:i:s'); 
				$nextMonth = new DateTime($month); 
					$nextMonth->modify('+1 month'); 
					$nextMonth = $nextMonth->format('Y-m-d H:i:s'); 

				$query = "SELECT postId FROM blog_posts WHERE timestamp BETWEEN '$thisMonth' AND '$nextMonth' ORDER BY timestamp DESC"; 
			} else {
				$query = "SELECT postId FROM blog_posts ORDER BY timestamp DESC"; 
			}

			$result = $this->mysqli->query($query); 

			if (!$result) {
				return 'Error: no results!'; 
			} else {
				while($row = $result->fetch_row()) {
					array_push($postIdArray, $row[0]); 
				} 
			}

			return $postIdArray; 
		}
	}

	// gets single post from an id
	public function getPost($postId) {
		// USE EXCEPTION HERE
		if ($this->mysqli->connect_errno) {
			return 'Error: could not connect to database!'; 
			exit(); 
		} else {
			$query = "SELECT * FROM blog_posts WHERE postId=$postId"; 

			$result = $this->mysqli->query($query); 

			// echo '<br />result = '; print_r($result); echo '<br />'; 

			if (!$result) {
				return 'Error: no results!'; 
			} else {
				$postArray = $result->fetch_assoc(); 

				$query = "SELECT blog_tags.tagNameId, blog_tag_names.name FROM blog_tags, blog_tag_names WHERE blog_tags.postId=$postId AND blog_tag_names.tagNameId=blog_tags.tagNameId ORDER BY blog_tag_names.name"; 
				$result = $this->mysqli->query($query); 

				if (!$result) {
					return 'Error: no results!'; 
				} else {
					$tagArray = array(); 

					$i = 0; 

					while($row = $result->fetch_row()) {
						$tagArray[$i] = array('tagNameId'=>$row[0], 'name'=>$row[1]); 

						$i++; 
					} 
				}

				$postArray['tags'] = $tagArray; 
			}

			return $postArray; 
		}
	}

	// gets the number of comments from a post id
	public function getNumComments($postId) {
		$commentArray = array(); 

		// USE EXCEPTION HERE
		if ($this->mysqli->connect_errno) {
			return 'Error: could not connect to database!'; 
			exit(); 
		} else {
			$query = "SELECT commentId FROM blog_comments WHERE postId=$postId"; 
			$result = $this->mysqli->query($query); 

			if (!$result) {
				return 'Error: no results!'; 
			} else {
				while($row = $result->fetch_assoc()) {
					array_push($commentArray, $row); 
				} 
			}

			return count($commentArray); 
		}
	}

	// gets comments from a post id
	public function getComments($postId) {
		$commentArray = array(); 

		// USE EXCEPTION HERE
		if ($this->mysqli->connect_errno) {
			return 'Error: could not connect to database!'; 
			exit(); 
		} else {
			$query = "SELECT * FROM blog_comments WHERE postId=$postId ORDER BY timestamp ASC"; 
			$result = $this->mysqli->query($query); 

			if (!$result) {
				return 'Error: no results!'; 
			} else {
				while($row = $result->fetch_assoc()) {
					$row['author'] = $this->format($row['author'], '', 'get'); 
					$row['website'] = $this->format($row['website'], '', 'get'); 
					$row['body'] = $this->format($row['body'], '', 'get'); 
					$row['title'] = $this->format($row['title'], '', 'get'); 

					// echo 'row = '; print_r($row); echo '<br />';  

					array_push($commentArray, $row); 
				} 
			}

			return $commentArray; 
		}
	}

	// saves a comment
	public function saveComment($author, $email, $website, $postId, $body, $title, $notify, $ip) {
		$author = $this->format($author, '', 'put'); 
		$email = $this->format($email, '', 'put'); 
		$title = $this->format($title, '', 'put'); 
		$website = $this->format($website, 'website', 'put'); 
		$body = $this->format($body, 'body', 'put'); 

		$fields = array ($author, $email, $title, $website, $body); 
		
		/*
		 * check user input for possible header injection attempts!
		 * adapted from PHP Form Mailer - 
		 * phpFormMailer (easy to use and more secure than many cgi form mailers)
		 * FREE from: www.TheDemoSite.co.uk
		**/
		function is_forbidden($str, $check_all_patterns = true) {
			// echo 'is_forbidden!<br />'; 
			// echo $str.'<br />'; 
			
			$patterns[0] = '/content-type:/';
			$patterns[1] = '/mime-version/';
			$patterns[2] = '/multipart/';
			$patterns[3] = '/Content-Transfer-Encoding/';
			// $patterns[4] = '/to:/';
			// $patterns[5] = '/cc:/';
			// $patterns[6] = '/bcc:/';
		
			$forbidden = 0;
		
			for ($i=0; $i<count($patterns); $i++) {
				$forbidden = preg_match($patterns[$i], strtolower($str));
		
				if ($forbidden != 0) {
					break;
				}
			}
		
			//check for line breaks if checking all patterns
			if ($check_all_patterns AND $forbidden != 0) {
				$forbidden = preg_match("/(%0a|%0d|\\n+|\\r+)/i", $str);
			}
		
			// echo $forbidden.'<br />'; 
			
			return $forbidden; 
		}
		
		foreach ($fields as $key => $value) { 
			//check all input 
			if ($key == 'body') {
				//check input except for line breaks
				if (is_forbidden($value, false) != 0) {
					return 'Error: There are forbidden characters in some input fields!'; 
					exit();
				}
			} else {
				//check all
				if (is_forbidden($value) != 0) {
					return 'Error: There are forbidden characters in some input fields!'; 
					exit();
				}
			}
		}

		// USE EXCEPTION HERE
		if ($this->mysqli->connect_errno) {
			return 'Error: could not connect to database!'; 
			exit(); 
		} else {
			$query = "INSERT INTO blog_comments VALUES(NULL, NULL, '$author', '$email', '$website', $postId, '$body', '$title', '$notify', '$ip')"; 
			$result = $this->mysqli->query($query); 

			if (!$result) {
				return 'Error: no results(1)! '.$this->mysqli->errno.': '.$this->mysqli->error.''; 
			} else {
				// notify owner of comment
				$to = 'mail@davidtrussler.net'; 
				$subject = 'A comment has been posted on davidtrussler.net blog'; 
				$additional_headers = 'From: mail@davidtrussler.net'; 
				$message = 'From: '.$author."\n"; 
				$message .= 'Comment: '.$body; 

				mail($to, $subject, $message, $additional_headers);

				// notify comment authors of new comment on thread if requested
				$query = "SELECT email FROM blog_comments WHERE postId=$postId AND notify='true'"; 
				$result = $this->mysqli->query($query); 

				if (!$result) {
					return 'Error: no results(1)! '.$this->mysqli->errno.': '.$this->mysqli->error.''; 
				} else {
					$notifyArray = array(); 

					while($row = $result->fetch_assoc()) {
						if ($row['email'] != $email) {
							array_push($notifyArray, $row['email']); 
						}
					} 

					$notifyArray = array_unique($notifyArray); 

					// SEND A MAIL TO EACH IN NOTIFY ARRAY
					$subject = 'A new comment has been posted on davidtrussler.net blog'; 
					$additional_headers = 'From: mail@davidtrussler.net'; 
					$message = 'Posted by: '.$author."\n"; 
					$message .= 'Comment: '.$body; 

					foreach ($notifyArray as $to) {
						mail($to, $subject, $message, $additional_headers);
					}

					return 'Your comment has been posted!';
				}
			}
		}
	}

	// deletes a comment
	public function deleteComment($commentId) {
		// USE EXCEPTION HERE
		if ($this->mysqli->connect_errno) {
			return 'Error: could not connect to database!'; 
			exit(); 
		} else {
			$query = "DELETE FROM blog_comments WHERE commentId=$commentId"; 
			$result = $this->mysqli->query($query); 

			if (!$result) {
				return 'Error: could not delete this comment! '.$this->mysqli->errno.': '.$this->mysqli->error.''; 
			} else {
				return 'That comment was deleted!'; 
			}
		}
	}

	// gets months from all posts
	public function getMonths() {
		// USE EXCEPTION HERE
		if ($this->mysqli->connect_errno) {
			return 'Error: could not connect to database!'; 
			exit(); 
		} else {
			$query = "SELECT timestamp FROM blog_posts ORDER BY timestamp DESC"; 
			$result = $this->mysqli->query($query); 

			if (!$result) {
				return 'Error: no results(1)! '.$this->mysqli->errno.': '.$this->mysqli->error.''; 
			} else {
				$monthArray = array(); 

				while($row = $result->fetch_row()) {
					$timestamp = $row[0]; 
					$month = substr($timestamp, 0, 7); 
					array_push($monthArray, $month); 
				} 

				$monthArray = array_unique($monthArray); 

				return $monthArray; 
			}
		}
	}

	// gets all tags from posts
	public function getTags() {
		$tagArray = array(); 

		// USE EXCEPTION HERE
		if ($this->mysqli->connect_errno) {
			return 'Error: could not connect to database!'; 
			exit(); 
		} else {
			$query = "SELECT tagNameId, name FROM blog_tag_names ORDER BY name"; 
			$result = $this->mysqli->query($query); 

			if (!$result) {
				return 'Error: no results!'; 
			} else {
				$tagArray = array(); 

				$i = 0; 

				while($row = $result->fetch_row()) {
					$tagArray[$i] = array('tagNameId'=>$row[0], 'name'=>$row[1]); 

					$i++; 
				} 
			}

			return $tagArray; 
		}
	}

	// saves a post
	public function savePost($postId, $title, $body, $tagArray, $newTags) {
		$titleId = $this->format($title, 'titleid', 'put').'-'.$postId; 
		$newTagNameIdArray = array(); 
		$newTagsArray = array(); 
		$title = $this->format($title, '', 'put'); 
		// $title = $this->mysqli->real_escape_string($title); 
		$body = $this->format($body, '', 'put'); 
		// $body = $this->mysqli->real_escape_string($body); 

		// secho $titleId; 

		if ($newTags) {
			$newTagsArray = explode(',', $newTags); 
		}

		// insert/update text elements for post
		if ($this->mysqli->connect_errno) {
			return 'Error: could not connect to database!'; 
			exit(); 
		} else {
			if ($postId) {
				// update
				$query = "UPDATE blog_posts SET title='$title', titleId='$titleId', body='$body', timestamp=timestamp WHERE postId=$postId"; 
			} else {
				// insert
				$query = "INSERT INTO blog_posts VALUES(NULL, '$titleId', NULL, '$title', '$body')"; 
			}

			$result = $this->mysqli->query($query); 

			if (!$result) {
				return 'Error: no results(savePost:5)! '.$this->mysqli->errno.': '.$this->mysqli->error.''; 
				exit(); 
			} else {
				if (!$postId) {
					// update titleId
					$postId = $this->mysqli->insert_id; 
					$titleId .= '-'.$postId; 

					$query = "UPDATE blog_posts SET titleId='$titleId' WHERE postId=$postId"; 

					$result = $this->mysqli->query($query); 

					if (!$result) {
						return 'Error: no results(savePost:6)! '.$this->mysqli->errno.': '.$this->mysqli->error.''; 
						exit(); 
					} else {
						$returnMessage = 'That post has been saved/updated!'; 
					}

					/* update rss feed xml
					 * haven't implemented this yet
					 *
					if (file_exists('../gimaju.xml')) {
						date_default_timezone_set('GMT'); 

						$doc = new DOMDocument();
						$doc->load('../gimaju.xml');
						$firstItem = $doc->getElementsByTagName('item')->item(0); 
						$lastBuildDate = $doc->getElementsByTagName('lastBuildDate')->item(0); 
						$newItem = $doc->createElement('item'); 
						$url = 'http://www.gimaju.net/index.php?postId='.$postId; 
						$date = date('D, j M Y H:i:s e'); 
						$bodyArray = explode('. ', $body); 

						$lastBuildDate->nodeValue = $date; 

						$title = $doc->createElement('title', $title); 
						$link = $doc->createElement('link', $url); 
						$guid = $doc->createElement('guid', $url); 
						$pubDate = $doc->createElement('pubDate', $date); 
						$description = $doc->createElement('description', $bodyArray[0].'.'); 

						$newItem->appendChild($title); 
						$newItem->appendChild($link); 
						$newItem->appendChild($guid); 
						$newItem->appendChild($pubDate); 
						$newItem->appendChild($description); 

						$firstItem->parentNode->insertBefore($newItem, $firstItem); 

						// NB this file needs to be writeable!
						$doc->save('../gimaju.xml'); 
					}
					*/
				}
			}
		}

		// add new tags to database
		if (count($newTagsArray) > 0) {
			if ($this->mysqli->connect_errno) {
				return 'Error: could not connect to database!'; 
				exit(); 
			} else {
				foreach($newTagsArray as $name) {
					$name = trim($name); 

					$query = "INSERT INTO blog_tag_names VALUES(NULL, '$name')"; 
					$result = $this->mysqli->query($query); 

					if (!$result) {
						return 'Error: no results(savePost:1)! '.$this->mysqli->errno.': '.$this->mysqli->error.''; 
						exit(); 
					} else {
						// save id for each tag added
						array_push($newTagNameIdArray, $this->mysqli->insert_id); 
					}
				}
			}
		}

		// get existing tags for this post if updating
		if ($postId) {
			if ($this->mysqli->connect_errno) {
				return 'Error: could not connect to database!'; 
				exit(); 
			} else {
				$query = "SELECT tagNameId FROM blog_tags WHERE postId=$postId"; 
				$result = $this->mysqli->query($query); 

				if (!$result) {
					return 'Error: no results(savePost:2)! '.$this->mysqli->errno.': '.$this->mysqli->error.''; 
					exit(); 
				} else {
					$tagNameIdArray = array(); 

					while($row = $result->fetch_row()) {
						array_push($tagNameIdArray, $row[0]); 
					}
				}
			}

			// and compare existing tags with tags specified via edit and add new ones
			$addedTags = array_diff($tagArray, $tagNameIdArray);
			$addedTags = array_merge($addedTags, $newTagNameIdArray); 
		} else {
			// if new post only add new tags
			$addedTags = $newTagsArray; 
		}

		if (count($addedTags) > 0) {
			if ($this->mysqli->connect_errno) {
				return 'Error: could not connect to database!'; 
				exit(); 
			} else {
				foreach ($addedTags as $addedTag) {
					$query = "INSERT INTO blog_tags VALUES(NULL, $addedTag, $postId)"; 
					$result = $this->mysqli->query($query); 

					if (!$result) {
						return 'Error: no results(savePost:3)! '.$this->mysqli->errno.': '.$this->mysqli->error.''; 
						exit(); 
					}
				}
			}
		}

		// compare existing tags with tags specified via edit and delete ones that are no longer needed
		$deletedTags = array_diff($tagNameIdArray, $tagArray);

		if (count($deletedTags) > 0) {
			if ($this->mysqli->connect_errno) {
				return 'Error: could not connect to database!'; 
				exit(); 
			} else {
				foreach ($deletedTags as $deletedTag) {
					$query = "DELETE FROM blog_tags WHERE tagNameId=$deletedTag AND postId=$postId"; 
					$result = $this->mysqli->query($query); 

					if (!$result) {
						return 'Error: no results(savePost:4)! '.$this->mysqli->errno.': '.$this->mysqli->error.''; 
						exit(); 
					}
				}
			}
		}
	}

	// formats a date 
	// moved into new class
	// delete when no longer used from here
	public function formatDate($timestamp) {
		date_default_timezone_set('Europe/London');

		$date = new DateTime($timestamp); 
		return $date->format('l j F Y'); 
	}

	// validates an email address
	public function validateEmail($commentEmail) {
		// regular expression from http://www.totallyphp.co.uk/code/validate_an_email_address_using_regular_expressions.htm
		if(eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $commentEmail)) {
			return 'valid';
		} else {

			return 'invalid';
		}
	}

	// formats some text
	private function format($text, $field, $action) {
		/*
		$text = str_replace("\r", "\n", $text); 
		$text = str_replace("\n\n", "\n", $text); 
		$text = str_replace('  ', ' ', $text); 
		*/

		/* could add wysiwyg editor later
		// for now just deal in inputted html
				if ($field == 'body') {
					$text = str_replace("\n", '</p><p>', $text); 
					$text = '<p>'.$text.'</p>'; 
				} else {
					$text = str_replace("\n", ' ', $text); 
				}
		*/

		if ($field == 'website') {
			$text = str_replace('http://', '', $text); 
		} elseif ($field == 'titleid') {
			// echo $text.'<br />'; 

			// unencode tags and strip tags
			// $text = html_entity_decode($text); 
			// $text = strip_tags($text); 

			// echo $text.'<br />'; 

			// http://forum.codecall.net/topic/59486-php-create-seo-friendly-url-titles-slugs/
			// Unwanted:  {UPPERCASE} ; / ? : @ & = + $ , . ! ~ * ' ( )
			$text = strtolower($text);
			// Strip any unwanted characters
			$text = preg_replace("/[^a-z0-9_\s-]/", "", $text);
			// Clean multiple dashes or whitespaces
			$text = preg_replace("/[\s-]+/", " ", $text);
			// Convert whitespaces and underscore to dash
			$text = preg_replace("/[\s_]/", "-", $text);
		}

		if ($action == 'put') {
			// echo $text; 

			// $text = htmlentities($text); 
			$text = $this->mysqli->real_escape_string($text); 

			// echo $text; 
		} elseif ($action == 'get') {
			// not actually used at the minute ...
			$text = stripslashes($text); 
		}

		return $text; 
	}

	function __destruct() {
		$this->mysqli->close();
	}
}

?>