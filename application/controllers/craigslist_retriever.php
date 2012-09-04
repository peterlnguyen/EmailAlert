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
		
		// retrieves appropriate nodes from html structure
		private function parse_html($get_response)
		{
			$dom = new DOMDocument();
			@$dom->loadHTML($get_response);
			$xpath = new DOMXPath($dom);
			
			// $tags = $xpath->query('//p[@class="row"]');
			$titles = $xpath->query('//p[@class="row"]/a');
			$links = $xpath->query('//p[@class="row"]/a/@href');
			$prices = $xpath->query('//p[@class="row"]/span[@class="itempp"');
			$dates = $xpath->query('//p[@class="row"]/span[@class="itemdate"');
			$locations = $xpath->query('//p[@class="row"]/span[@class="itempn"');
			// $tags = $xpath->query('//p[@class="row"]/span[@class="itempn"]');
			
			// @todo trying to extract from the rows instead of querying every single time
			// $dom_tags = new DOMDocument();
			// @$dom_tags->loadHTML($tags);
			// $xpath_tags = new DOMXPath($dom_tags)
			// $links = $xpath_tags->query('//a/@href');
			
			$data = array(
				// 'tags' => $tags, 
				'titles' => $titles,
				'links' => $links,
				'prices' => $prices,
				'dates' => $dates,
				'locations' => $locations,
			);
			return $data;
		}
		
		// takes node lists and formats into display html
		private function format_nodes_as_rows($data) 
		{
			// $tags = $data['tags'];
			$links = $data['links'];
			$titles = $data['titles'];
			$prices = $data['prices'];
			$dates = $data['dates'];
			$locations = $data['locations'];
			
			$data_rows = array();
			$
			
			// foreach($links as $link) {
				// $results1 = $results1 . '<tr><td>' . $link->nodeValue . '</td></tr>';
			// }
			// foreach($tags as $tag) {
				// $results = $results . '<tr><td>' . $tag->nodeValue . '</td></tr>';
			// }
			// foreach($titles as $title) {
				// $results1 = $results1 . '<tr><td>' . $title->nodeValue . '</td></tr>';
			// }
			// foreach($prices as $price) {
				// $results = $results . '<tr><td>' . $price->nodeValue . '</td></tr>';
			// }
			// foreach($locations as $location) {
				// $results = $results . '<tr><td>' . $location->nodeValue . '</td></tr>';
			// }
			
			/*			
			$results = '<h1><center>Results</center></h1><table class="table table-striped">';
			$results1 = '<h1><center>Results</center></h1><table class="table table-striped">';
			
			foreach($links as $link) {
				$results1 = $results1 . '<tr><td>' . $link->nodeValue . '</td></tr>';
			}
			foreach($tags as $tag) {
				$results = $results . '<tr><td>' . $tag->nodeValue . '</td></tr>';
			}
			$results = $results . '</table>';
			$results1 = $results1 . '</table>';
			*/
			return $results1;
		}
		
		// 
		private function nodelist_to_array($nodelist, &$arr)
		{
			$row_num = 0;
			foreach($nodelist as $node) {
				if(count($arr) <= $row_num) array_push($arr, array());
				$row = $arr[$row_num];
				array_push($row, $node);
				$row_num++;
			}
		}
		
	}
?>