<html>
	<head>
		<title>Fetch It</title>
		<link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap/bootstrap.css" type="text/css" media="screen"/>
	</head>
	<body>
		
		<div id="searchbox">
			<?php echo validation_errors(); ?>

			<?php echo form_open('search_form/parse_input'); ?>

			<center>
			<form>
				<h3>Search Craigslist!</h3>
				<label>What are you looking for?</label>
				<input type="text" value="<?php echo set_value('search_query'); ?>" name="search_query" placeholder="Ex: DeLorean DMC-12">
				<br />
				
					<?php 
						$cities = array('Atlanta', 'Austin', 'Boston', 'Chicago', 'Dallas', 'Denver', 'Detroit', 'Houston', 'Las Vegas', 'Los Angeles', 'Miami', 'Minneapolis', 'New York', 'Orange County', 'Philadelphia', 'Phoenix', 'Portland', 'Raleigh', 'Sacramento', 'San Diego', 'Seattle', 'SFBay', 'Washington DC'); 
						echo '<select name="city" id="citySelect">';
						foreach ($cities as $city) {
							echo '<option value="' . $city . '">' . $city . '</option><br />';
						}
					?>
					
					<!-- @todo use cookies to restore response from last time -->
					<script language="javascript" type="text/js">
						document.getElementById('citySelect').value = <?php echo ($_COOKIE['location']!='' ? $_COOKIE['Los Angeles'] : 'Guest'); ?>
					</script>
					
					<?php echo '</select>'; ?>
				</script>
				<br />
				<div><input type="submit" value="Submit" class="btn-primary" /></div>
			</form>
			</center>
		</div>
		
		<style>
			#searchbox {
				position: relative;
				top: 125px;
			}
		</style>
	</body>
</html>
