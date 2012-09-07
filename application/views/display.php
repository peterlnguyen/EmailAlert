<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
 
	<head>
		<title>Results</title>
		<link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap/bootstrap.min.css" type="text/css" media="screen"/>
		<script type="text/javascript" src="<?php echo base_url();?>js/jquery.min.js"></script>
	</head>
	<body>
		<h3><center>Results</center></h3>
		<script language="javascript" type="text/javascript">
			var html = <?php echo json_encode($results); ?>;

			var $container = $('<div/>').html(html);
			var result = [];
			var tags = 'a[href], span.itemdate, span.itempp, span.itempn';
			// @todo need to learn how to pass in jquery objects into javascript functions to modularize
			$container.find('p.row').find(tags).each(function() {
					if(this.tagName.toUpperCase() == 'SPAN') {
						result.push(this.innerHTML);
					}
					if(this.tagName.toUpperCase() == 'A') {
						result.push(this.innerHTML, this.href);
					}
			});
			
			printTable(result);
			
			/* wraps and prints html table format around array of results */
			function printTable(result) {
				document.write('<table class="table table-striped">');
				document.write('<tr> <th>#</th> <th>Date</th> <th>Title</th> <th>URL</th> <th>Price</th> <th>Location</th> </tr>');
				var a = 1, count = 1;
				for(i = 0; i < result.length; i++) {
					if(a == 1) {
						document.write('<tr><td>' + count + '</td>');
						document.write('<td>' + result[i] + '</td>');
						count++;
					} else if(a == 3) {
						// wraps a href around link
						document.write('<td><a href="' + result[i] + '">Link</a></td>');
					} else if(a == 5) {
						// strips parentheses and corrects case (e.g. san diego -> San Diego)
						document.write('<td>' + toTitleCase(stripParentheses(result[i])) + '</td>');
					} else if(a == 6 || a == 7) {
						// document.write in next if statement will still fire at a = 6,7 for some reason without this if/else block
					} else {
						document.write('<td>' + result[i] + '</td>');
					}
					a++;
					if(a == 8) {
						a = 1;
						document.write('</tr>');
					}
				}		
				document.write('</table>');
			}
			
			function stripParentheses(text) {
				return text.replace(/\(|\)/g, '');
			}
			
			function toTitleCase(str)
			{
				return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
			}
			
		</script>
	</body>
</html>
