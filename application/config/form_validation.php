<?php

	$config = array(
					 'signup' => array(
										array(
												'field' => 'username',
												'label' => 'Username',
												'rules' => 'trim|required|min_length[5]|max_length[12]|xss_clean'
											 ),
										array(
												'field' => 'password',
												'label' => 'Password',
												'rules' => 'trim|required|matches[passconf]|md5'
											 ),
										array(
												'field' => 'passconf',
												'label' => 'PasswordConfirmation',
												'rules' => 'trim|required'
											 ),
										array(
												'field' => 'email',
												'label' => 'Email',
												'rules' => 'trim|required|valid_email'
											 )
										),
					 'email' => array(
										array(
												'field' => 'emailaddress',
												'label' => 'EmailAddress',
												'rules' => 'required|valid_email'
											 ),
										array(
												'field' => 'name',
												'label' => 'Name',
												'rules' => 'required|alpha'
											 ),
										array(
												'field' => 'title',
												'label' => 'Title',
												'rules' => 'required'
											 ),
										array(
												'field' => 'message',
												'label' => 'MessageBody',
												'rules' => 'required'
											 )
										)                          
				   );
			   
?>