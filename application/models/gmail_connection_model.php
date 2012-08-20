<?php	
	/**
	 * Provides layer of abstraction to retrieve _emails from gmail via IMAP.
	 * Functions must be used in a sequence to successfully authenticate and retrieve.
	 *
	 * @variable $_hostname the servername to connect to (e.g. {imap.gmail.com:993/imap/ssl}INBOX)
	 * @variable $_username the account login (e.g. peter@gmail.com)
	 * @variable $_password the password login (e.g. password123)
	 */
	class Gmail_Connection_Model extends CI_Model
	{
		/* global variables */
		
		// credentials
		private $_hostname, $_username, $_password;
		// actual emails
		private $_inbox, $_emails;
		
		/* constructor and initalizer */

		public function __construct()
		{
			parent::__construct();
		}	
		
		public function initialize($host, $user, $pass)
		{
			$this->_hostname = $host;
			$this->_username = $user;
			$this->_password = $pass;
		}	
		
		/* all in one retrieval function */
		public function connect_retrieve_return_emails()
		{
			$this->connect_to_gmail();
			$this->retrieve_emails('UNSEEN');
			$emails = $this->get_emails_pretty_print();
			$this->close_connection();
			return $emails;
		}
		
		/* connection and retrieving _emails */
		
		// connection
		public function connect_to_gmail() 
		{
			$this->_inbox = imap_open($this->_hostname, $this->_username, $this->_password) 
								or die('Cannot connect to Gmail: ' . imap_last_error());
			
			$str = imap_errors();  
			if($str != '') {
				echo("imap_errors():\n");  
				print_r($str);
			}
		}
		
		// retrieval
		public function retrieve_emails($criteria) 
		{
			$criteria_possible = array(	'ALL', 'ANSWERED', 'BEFORE', 'BODY', 'CC', 'DELETED', 'FLAGGED', 'FROM', 
										'KEYWORD', 'NEW', 'OLD', 'ON', 'RECENT', 'SEEN', 'SINCE', 'SUBJECT', 
										'TEXT', 'TO', 'UNANSWERED', 'UNDELETED', 'UNFLAGGED', 'UNKEYWORD', 'UNSEEN'
									  );
			
			// if criteria isn't valid, defaults to retrieving unseen _emails
			if(!in_array($criteria, $criteria_possible)) {
				$criteria = 'UNSEEN';
				echo 'ERROR: Criteria for retrieve_emails is invalid, defaulting to "UNSEEN"\n';
			}
			$this->_emails = imap_search($this->_inbox, $criteria);
		}
		
		// gets the email object as an object (non-human-readable format)
		public function get_emails() {
			if($this->_emails) return $this->_emails[0];
			else echo 'No emails to return!';
		}
		
		// display emails
		public function get_emails_pretty_print()
		{
			// if retrieval is successful, cycles through and displays
			if($this->_emails) 
			{
				$output = '';

				// put the newest _emails on top
				rsort($this->_emails);
				
				foreach($this->_emails as $email_number) {
					// grab specifics from email
					$overview = imap_fetch_overview($this->_inbox, $email_number, 0);
					$message = imap_fetchbody($this->_inbox, $email_number, 1);
					
					// set date from default +000 timezone to pst
					$original_datetime = $overview[0]->date;
					$datetime = new DateTime($original_datetime);
					$la_time = new DateTimeZone('America/Los_Angeles');
					$datetime->setTimezone($la_time);
					$datetime = $datetime->format('H:i:s Y-m-d');

					// output the email header information
					$output.= $overview[0]->from . ':';
					$output.= '"' . $overview[0]->subject . '"';
					$output.= ' at ' . $datetime;

					// output the email body
					// $output.= '<div class="body">'.$message.'</div>';
				}
				
				/* send a text message using sendhub */
				return $output;
				
			} else {
				echo 'No _emails to display!';
			}
		}

		// close connection
		public function close_connection() {
			imap_close($this->_inbox);
		}
			
		/* getters and setters */
		
		public function set_hostname($host) {
			$this->_hostname = $host;
		}
		
		public function get_hostname() {
			return $this->_hostname;
		}
		
		public function set_username($username) {
			$this->_username = $username;
		}
		
		public function get_username() {
			return $this->_username;
		}
		
		public function set_password($password) {
			$this->_password = $password;
		}
		
		public function get_password() {
			return $this->_password;
		}
	}
	

	
?>