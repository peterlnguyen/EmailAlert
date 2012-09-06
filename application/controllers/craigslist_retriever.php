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
			
				// extract desirable nodes
				// $tags = $this->parse_html($get_response);
				
				// /* format nodes for display */
				// $results = '';
				// $results = $this->format_nodes_as_rows($tags);
						
			$data = array(
				'results' => $get_response,
			);
			
			$this->load->view('display', $data);
		}
		
		// retrieves appropriate nodes from html structure
		private function parse_html($get_response)
		{
			$dom = new DOMDocument();
			@$dom->loadHTML($get_response);
			$xpath = new DOMXPath($dom);
			
			$tags = $xpath->query('//p[@class="row"]');
			$titles = $xpath->query('//p[@class="row"]/a');
			
			foreach($tags as $row)
			{
				$links = $xpath->query('span[3]', $row);
				$asdf = $xpath->query('a', $row);
				foreach($links as $cols) 
				{
					echo $cols->nodeValue . '<br />';
				}
				// echo htmlspecialchars($links->nodeValue) . '<br />';
			}
			
			$links = $xpath->query('//p[@class="row"]/a/@href');
			$prices = $xpath->query('//p[@class="row"]/span[@class="itempp"');
			// $dates = $xpath->query('//p[@class="row"]/span[@class="itemdate"');
			// $locations = $xpath->query('//p[@class="row"]/span[@class="itempn"');
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
			$titles = $data['titles'];
			$links = $data['links'];
			$prices = $data['prices'];
			$dates = $data['dates'];
			$locations = $data['locations'];
			
			$data_rows = array();
			$this->nodelist_to_array($dates, $data_rows);
			$this->nodelist_to_array($titles, $data_rows);
			$this->nodelist_to_array($prices, $data_rows);
			$this->nodelist_to_array($locations, $data_rows);
			$this->nodelist_to_array($links, $data_rows);
			
			// foreach($links as $link) {
				// $results1 = $results1 . '<tr><td>' . $link->nodeValue . '</td></tr>';

			return $results1;
		}
		
		// 
		private function nodelist_to_array($nodelist, &$arr)
		{
			$row_num = 0;
			foreach($nodelist as $node) {
				if(count($arr)) {
					array_push($arr, array('<tr>'));
				}
				$row = $arr[$row_num];
				array_push($row, $node);
				$row_num++;
			}
		}
		
	}
?>