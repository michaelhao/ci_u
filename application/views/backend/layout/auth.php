<?php
	$output = $this->curl->simple_post('http://datavalidation.info/index.php/session/add', 
		array(
			'account'=> $this->input->get('acc'),
			'password'=> $this->input->get('pwd'),
			'domain'=> site_url(),
		));

	echo $output;
?>