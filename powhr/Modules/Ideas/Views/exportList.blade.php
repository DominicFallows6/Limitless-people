<html
<head>
    <style>
	
	body {
	    font-family: Arial;
	}

	h3 {
	    
	    font-size: 22px;

	}


	p {
	  
	    font-size: 14px;

	}

    </style>
</head>
<body>

<?php
foreach ($ideas AS $key => $idea) {
?>
    <h3><?= $idea->idea_name?> by <?=$idea->user->first_name. ' '.$idea->user->surname?> on <?php echo date('dS F Y \a\t H:i',strtotime($idea->created_at))?></h3>
    <p><?php echo strip_tags($idea->description)?></p>
    <br /><br /><br /><br /><br /><br /><br /> <hr />
<?php
}
?>
</body>
</html>
