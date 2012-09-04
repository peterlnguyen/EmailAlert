<?php

	/*
	 * This class is responsible for setting up the search form, receiving and cleaning the input,
	 * and passing it on to the controller responsible for screen scraping.
	 */
	class Search_form extends CI_Controller 
	{
		// loads form view
		public function load_form()
		{
			$this->load->helper(array('form', 'url'));			
			$this->load->view('search_form');
		}
		
		// buffer before actual GET method
		public function parse_input()
		{
			$query = $_POST['search_query'];
			$city = $_POST['city'];
			// remove spaces from city location so we can use it as part of GET link address
			// change to lowercase just to be safe in case some craigslist links are case sensitive
			$city = str_replace(' ', '', strtolower($city));
			$this->fetch_data($query, $city);
		}
		
		// redirects to controller responsible for GET
		private function fetch_data($query, $city)
		{
			$this->load->helper('url'); 
			redirect('/craigslist_retriever/get/' . $query . '/' . $city);
		}

	}
?>