<html>
	<head>
		<title>My Form</title>
		<link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap/bootstrap.css" type="text/css" media="screen"/>
	</head>
	<body>
		
		<center>
		<h1>Search!</h1>
		</center>

		<?php echo validation_errors(); ?>

		<?php echo form_open('search_form/parse_input'); ?>

		<center>
		<form>
			<legend>Craigslist</legend>
			<label>What are you looking for?</label>
			<input type="text" value="<?php echo set_value('search_query'); ?>" name="search_query" placeholder="Ex: DeLorean DMC-12">
			<br />
			<?php 
				$cities = array('Atlanta', 'Austin', 'Boston', 'Chicago', 'Dallas', 'Denver', 'Detroit', 'Houston', 'Las Vegas', 'Los Angeles', 'Miami', 'Minneapolis', 'New York', 'Orange County', 'Philadelphia', 'Phoenix', 'Portland', 'Raleigh', 'Sacramento', 'San Diego', 'Seattle', 'SFBay', 'Washington DC'); 
				echo '<select name="city">';
				foreach ($cities as $city) {
					echo '<option value="' . $city . '">' . $city . '</option><br />';
				}
				echo '</select>';
			?>
			<br />
			<div><input type="submit" value="Submit" class="btn-primary" /></div>
		</form>
		</center>
	
	</body>
</html>
