<?php
// message.php
 
class Message extends CI_Controller
{
 
    function index() {
        $msg1 = 'hello, world';
        $msg2 = 'a second message';
 
        $data = array(
            'msg1' => $msg1,
            'msg2' => $msg2
        );
 
        $this->load->view('display', $data);
    }
    
    function foobar() {
		$msg1 = 'foo';
		$msg2 = 'bar';
		
		$data = array(
			'msg1' => $msg1,
			'msg2' => $msg2
		);
		
		$this->load->view('display', $data);
	}
}