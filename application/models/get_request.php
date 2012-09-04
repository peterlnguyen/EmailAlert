 <?php

	/* send text message, returns message status */
	class Get_request extends CI_Model
	{
		public function __construct() {
			parent::__construct();
		}
		
		// @todo need to add in a cache-check to prevent excess searches
		public static function get_request($get_url) 
		{
			/* get with curl */
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $get_url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_TIMEOUT, '3');
			
			/* print errors and responses */
			
			$response = curl_exec($ch);
			
			/* response used only for debugging */
			// if($response != '') echo ' RESPONSE: ' . $response;
			// $err = curl_error($ch);
			// if($err != '') echo ' ERROR: ' . $err;
			// $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			// if($httpCode != '') echo ' HTTP CODE: ' . $httpCode;
			
			curl_close($ch);
			return $response;
		}
	}
 ?>