<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
 
	<head>
		<title>Results</title>
		<link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap/bootstrap.min.css" type="text/css" media="screen"/>
		<script type="text/javascript" src="<?php echo base_url();?>js/jquery.min.js"></script>
	</head>
	<body>
		<script language="javascript" type="text/javascript">
			var html = <?php echo json_encode($results); ?>;
			// document.write(escapeHTML(html));
			
			var string = "sdsds<div>sdd<a href='http://google.com/image1.gif' class='hello'>image1</a>  sd</div>sdsdsdssssssssssssssssssssssssssssssssssss <p> <a href='some/href'></a> sdsdsdsds  </p>sdsds<div>sdd<img src='http://google.com/image1.gif' alt='car for family' />  sd</div>";
			var craig = '<p class="row" data-latitude="" data-longitude=""><span class="ih" id="images:5Ef5K85M93L63M23J9c8h021d04a4990e1b94.jpg">&nbsp;</span> <span class="itemdate">Aug 20</span><span class="itemsep">-</span><a href="http://losangeles.craigslist.org/wst/fuo/3213144343.html">Pali Crib with Mattress</a> <span class="itemsep">-</span><span class="itempp">$199</span><span class="itempn"><font size="-1">(Westwood)</font></span> <span class="itemcg" title="fuo"><small class="gc"><a href="/fuo/">furniture - by owner</a></small></span><span class="itempx"><span class="p">pic</span></span><br class="c" /></p>';

			var $container = $('<div/>').html(html);

			var result = [];
			
			var tags = 'a[href], span.itemdate, span.itempp, span.itempn';
			$container.find('p.row').find(tags).each(function() {
					if(this.tagName.toUpperCase() == 'SPAN') {
						result.push(this.innerHTML + ' ***');
					}
					
					if(this.tagName.toUpperCase() == 'A') {
						result.push(this.innerHTML + ' ***', this.href + ' ***');
					}
					// result.push('<br />');
			});

			for(i = 1; i < result.length + 1; i++) {
				if((i%6 != 0) || (i%7 != 0))
					document.write(result[i-1]);
			}
			
			/****************************/
			
			function escapeHTML(unsafe) {
			  return unsafe
				  .replace(/&/g, "&amp;")
				  .replace(/</g, "&lt;")
				  .replace(/>/g, "&gt;")
				  .replace(/"/g, "&quot;")
				  .replace(/'/g, "&#039;");
			}
			
			/*
			var html = <?php echo json_encode($results); ?>;
			
			// var string = "sdsds<div>sdd<a href='http://google.com/image1.gif' class='hello'>image1</a>  sd</div>sdsdsdssssssssssssssssssssssssssssssssssss <p> <a href='some/href'></a> sdsdsdsds  </p>sdsds<div>sdd<img src='http://google.com/image1.gif' alt='car for family' />  sd</div>";
			var string = '<p class="row" data-latitude="" data-longitude=""><span class="ih" id="images:5Ef5K85M93L63M23J9c8h021d04a4990e1b94.jpg">&nbsp;</span> <span class="itemdate">Aug 20</span><span class="itemsep">-</span><a href="http://losangeles.craigslist.org/wst/fuo/3213144343.html">Pali Crib with Mattress</a> <span class="itemsep">-</span><span class="itempp">$199</span><span class="itempn"><font size="-1">(Westwood)</font></span> <span class="itemcg" title="fuo"><small class="gc"><a href="/fuo/">furniture - by owner</a></small></span><span class="itempx"><span class="p">pic</span></span><br class="c" /></p>';
			var $container = $('<div/>').html(string);

			var result = [];

			$container.find('p.row').each(function() {
				if(this.tagName.toUpperCase() == 'a') {
					result.push('hello');
					// result.push([this.tagName,this.innerHTML,this.href]);
				} else {
					// result.push([this.tagName,this.src,this.alt]);
				}
			});

			document.write(result);
			*/
		</script>
	</body>
</html>
