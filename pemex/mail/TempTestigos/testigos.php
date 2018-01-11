<html>
	<head>
		<script type="text/javascript" src="jquery.js"></script>
		<script type="text/javascript">	
			$(function()
			{
				var fecha = "";
				var dia = 6;
				var personaje = ["TlE9PQ==","Tmc9PQ==","Tnc9PQ==","T0E9PQ==","TVE9PQ==","TXc9PQ==","TWc9PQ==","TkE9PQ=="];
				while(dia<32)
				{
					if(dia>9)
					{
						fecha = "2014-11-"+dia;
					}
					else
					{
						fecha = "2014-11-0"+dia;
					}
					
					for(var i in personaje)
					{
						$("#links").append("<a href='http://192.168.3.154/external/services/mail/TempTestigos/exportTamaulipas.php?p="+personaje[i]+"&f="+fecha+"'>http://192.168.3.154/external/services/mail/TempTestigos/exportTamaulipas.php?p="+personaje[i]+"&f="+fecha+"</a><br>");
						
					}
					$("#links").append("<br><br>");
					dia++;
				}
			})
		</script>
	</head>

	<body>
	<input type="button" onclick="javascript:testigo();" value="Testigos">
		<div id='links'>
			
		</div>
	</body>
</html>
