<?php	
	
	/*
	 * This class is responsible for setting up the sign up, receiving and cleaning the input,
	 * and passing it on to the controller responsible for storing it into the database.
	 */
	class Sign_Up extends CI_Controller
	{
		public function index()
		{
			$this->load->helper(array('form', 'url'));

			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('username', 'Username', 'callback_username_check');
			$this->form_validation->set_rules('search_query', 'Search_Query', 'trim|required|min_length[5]|max_length[12]|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|matches[passconf]|md5');
			$this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			
			$this->form_validation->set_message('valid_email', 'Your email is required!');

			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('myform');
				echo 'hello';
			}
			else
			{
				$this->load->view('formsuccess');
				
			}
		}
	}
?>