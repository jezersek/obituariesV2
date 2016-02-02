<?php 
	if(!defined('__ROOT__')){
	define('__ROOT__', dirname(dirname(__FILE__)));
	}
	
	if(!isset($_SESSION)) session_start();
?>

<body>
<h2>Published obituaries ...</h2>
<div class="container" id="obituaries"></div>
<button id="more">Show more ...</button>
<script>
$(document).ready(function() {
	var currentNumber = 0;
	printObituaries(0, 9);
	
	function printObituaries(start, limit)
	{
		$.post("ajax.php", {start: start, limit: limit}, function(data) {
			console.log(data)
			data = $.parseJSON(data)
			if(data.length < 9) {
				$('#more').hide();
			}
			$.each(data, function(key, obituary) {
				$('#obituaries').append('<a class="list" href="?obituaryid='+obituary.id+'"><b>'+obituary.name+' '+obituary.lastname+'</b><br /><i>'+obituary.dateOfBirth+' - '+obituary.dateOfDeath+'</i><br /><img src="images/'+obituary.religion+'.png" height=100/><br /></a>')
				currentNumber = currentNumber+1
				console.log(currentNumber)
			})
		})
	}
	$('#more').click(function() {
		printObituaries(currentNumber,9)
	})
})
</script>
</body>