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
			
			// calls on model to GET
			$get_response = get_request::get_request($query);
			
			// extract desirable nodes
			$tags = $this->parse_html($get_response);
			
			/* format nodes for display */
			$results = '';
			$results = $this->format_nodes_as_rows($tags);
						
			$data = array(
				'results' => $results,
			);
			
			$this->load->view('display', $data);
		}
		
		private function parse_html($get_response)
		{
			$dom = new DOMDocument();
			@$dom->loadHTML($get_response);
			$xpath = new DOMXPath($dom);
			
			// $tags = $xpath->query('//p[@class="row"]/span[@class="itempn"]');
			$tags = $xpath->query('//p[@class="row"]');
			return $tags;
		}
		
		private function format_nodes_as_rows($tags) 
		{
			$results = '<ol>';
			foreach ($tags as $tag) {
				$results = $results . '<li>' . $tag->nodeValue . '</li><br />';
			}
			$results = $results . '</ol>';
			return $results;
		}
	}
?>