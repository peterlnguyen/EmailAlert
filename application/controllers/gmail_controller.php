<?php 
	class Gmail_Controller extends CI_Controller
	{
	 
		function index() 
		{
			$host = '{imap.gmail.com:993/imap/ssl}INBOX';
			$user = 'peterlongnguyen@gmail.com';
			$pass = 'peaches123';
			
			$this->load->model('gmail_connection_model');
			$this->gmail_connection_model->initialize($host, $user, $pass);
			$msg1 = $this->gmail_connection_model->connect_retrieve_return_emails();
			// $this->gmail_connection_model->close_connection();
	 
			$data = array(
				'msg1' => $msg1,
			);
			
			$this->load->view('display', $data);
		}
		
		function post()
		{
			$query = 'http://losangeles.craigslist.org/search/?areaID=7&subAreaID=&query=mattress&catAbb=sss';
			$this->load->model('get_request');
			$get_response = get_request::get_request($query);
			
			// echo htmlentities($get_response);
			
			$dom = new DOMDocument();
			@$dom->loadHTML($get_response);
			$xpath = new DOMXPath($dom);
			
			// $tags = $xpath->query('//p[@class="row"]/span[@class="itempn"]');
			$tags = $xpath->query('//p[@class="row"]');
			
			foreach ($tags as $tag) {
				// print $tag->nodeValue . '<br />';
			}
			
			$msg1 = 'hello world!';
			
			$data = array(
				'msg1' => $msg1,
			);
			
			$this->load->view('display', $data);
		}
	}
?>