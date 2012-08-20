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
			$this->gmail_connection_model->close_connection();
	 
			$data = array(
				'msg1' => $msg1,
			);
	 
			$this->load->view('display', $data);
		}
	}
?>