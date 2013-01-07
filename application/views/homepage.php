

<html>
<head>
<title>Search Form</title>
<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
</head>
<body>



 <form action="" method="GET"> 
                    First name:         <input type="text" name="firstname" id="firstname">
                    Last name:          <input type="text" name="lastname" id="lastname">
                    Department Name:    <input type="text" name="dept" id="dept">
                    Current job Title:  <input type="text" name="jobtitle" id="jobtitle">
			<input type="submit" id="findsubmit"/>
                </form>
<div id="result"></div>
</body>
<script language="javascript">
$('#findsubmit').click(function() {
	var form = { firstname: $('#firstname').val(), lastname: $('#lastname').val(), dept: $('#dept').val(), jobtitle: $('#jobtitle').val() };
	$.get("/w1278380/index.php/find/findemp",form,function(data) {
		var table = '<table><tr><th>First Name</th><th>Last Name</th><th>Department Name</th><th>Job Title</th></tr>';
		for (x = 0; x < data.length; x++) {
			table = table + '<tr><td>' + data[x]["firstname"] + '</td><td>' + data[x]["lastname"] + '</td><td>' + data[x]["dept"] + '</td><td>' + data[x]["jobtitle"] + '</td></tr>';
		}
		table = table + '</table>';
		$('#result').html(table);
	},"json");
	return false;
});
</script>
</html>