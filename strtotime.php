<?php

date_default_timezone_set('America/New_York');

if (isset($_POST['strtotime'])) {
	$strtime=strtotime($_POST['strtotime']);
	echo json_encode(array('strtotime' => $strtime, 'newtime' => date("d F Y H:i:s",$strtime)));
	exit;
} else if (isset($_POST['unixtimestamp'])) {
	if (is_numeric($_POST['unixtimestamp'])) {
		echo json_encode(array('date' => date("d F Y H:i:s",$_POST['unixtimestamp'])));
	}
	exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>PHP Strtotime</title>
<style>
fieldset {
	border:1px solid gray;
	border-radius:5px;
}
</style>
<script src="jquery2.1.1.js"></script>
<script>
$(function () {
	$('#submitTime1').click(function () {
		$.ajax({type: "POST", url : "strtotime.php", dataType: 'json', data : {"strtotime" : $('#strtimeTxt').val()}, timeout : 10000}).done(function (data) {
			$('#strtotimeResult').html('Strtotime Format:&nbsp;&nbsp;' + data.strtotime + '<br />' + data.newtime);
		}).fail(function(){
			//
		});
	});

	$('#submitTime2').click(function () {
		if (typeof $('#unixTimestampTxt').val() == 'number') {
			return;
		}

		$.ajax({type: "POST", url : "strtotime.php", dataType: 'json', data : {"unixtimestamp" : $('#unixTimestampTxt').val()}, timeout : 10000}).done(function (data) {
			$('#unixTimestampResult').html('Date:&nbsp;&nbsp;' + data.date);
		}).fail(function(){
			//
		});
	});

	$('#strtimeTxt').keyup(function (e) {
		if (e.which==13) {
			$('#submitTime1').trigger('click');
		}
	});

	$('#unixTimestampTxt').keyup(function (e) {
		if (e.which==13) {
			$('#submitTime2').trigger('click');
		} else {
			$('#unixTimestampResult').html('');
		}
	});
});
</script>
</head>
<body>
<!--<form action="strtotime.php" method="post" id="form1">//-->
<fieldset style="margin-bottom:40px; width:500px;">
	<legend>Strtotime</legend>
	Convert: <input type="text" value="<?php echo date('Y-m-d H:i:s'); ?>" id="strtimeTxt" style="width:250px;" placeholder="<?php echo date('Y-m-d H:i:s'); ?>" />&nbsp;<input type="button" value="Submit" id="submitTime1" />
	<div style="margin-top:10px; padding-left:5px;" id="strtotimeResult"></div>
</fieldset>
<fieldset style="margin-bottom:5px; width:500px;">
	<legend>Unix Timestamp to Date</legend>
	Timestamp: <input type="text" value="" id="unixTimestampTxt" style="width:250px;" />&nbsp;<input type="button" value="Submit" id="submitTime2" />
	<div style="margin-top:10px; padding-left:5px;" id="unixTimestampResult"></div>
</fieldset>
<!--</form>//-->
</body>
</html>
