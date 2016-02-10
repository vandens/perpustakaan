<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome <?php echo ucfirst($this->session->userdata('user'));  ?></title>
	
   	<link href="<?php echo base_url(); ?>media/css/menu.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>media/css/global.css" rel="stylesheet">
    
	<script src="<?php echo base_url(); ?>asset/js/jquery172.js" type="text/javascript"></script>

	<script src="<?php echo base_url(); ?>media/editor/ckeditor.js" type="text/javascript"></script>

	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>/media/css/flexdropdown.css" />
	<script language="javascript" src="<?php echo base_url(); ?>/media/js/jquery172.js"></script>
	<script language="javascript" src="<?php echo base_url(); ?>/media/js/flexdropdown.js"></script>

<script>
// JavaScript popup window function
	function PopUp(url) {
popupWindow = window.open(url,'popUpWindow','height=500,width=750,left=400,top=200,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes')
	}

</script>




<script type="text/javascript" src="<?php echo base_url('media/js/jquery-1.9.1.min.js'); ?>"></script>

<link rel="stylesheet" type="text/css" href="speechbubbles.css" />

<script src="speechbubbles.js"></script>

<script type="text/javascript">

jQuery(function($){ //on document.ready
 	//Apply tooltip to links with class="addspeech", plus look inside 'speechdata.txt' for the tooltip markups
	$('a.addspeech').speechbubble({url:'speechdata.txt'})
})

</script>

</head>
<body>
<div id="container">
<div id="body">

	<?php echo $content; ?>

</div>
	<p class="footer">Powered By <?php echo $this->config->item('powered'); ?> | Page rendered in <strong>{elapsed_time}</strong> seconds </p>

</div>
</body>
</html>
