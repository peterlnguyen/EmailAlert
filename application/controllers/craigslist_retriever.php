<?php
	/*
	 * This class sends a GET request to craigslist to retrieve and scrape the page.
	 * It is built particularly for craigslist's link address structure.
	 */
	class Craigslist_retriever extends CI_Controller
	{
		public function get($query, $city)
		{
			$query = 'http://' . $city . '.craigslist.org/search/?areaID=7&subAreaID=&query=' . $query . '&catAbb=sss';
			$this->load->model('get_request');
			$this->load->helper('url');
			
			// calls on model to GET
			$get_response = get_request::get_request($query);
						
			$data = array('results' => $get_response,);
			
			$this->load->view('display', $data);
		}
	}
?>