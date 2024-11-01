<?php
	$file_path = ABSPATH . 'wp-content/plugins/star-review-manager' . '/css/custom-frontend-style.css';
	if($_POST['css_text'] && !empty($_POST['css_text'])) {
		$succeed = file_put_contents ( $file_path, $_POST['css_text'], FILE_TEXT);
	}
?>

<div class="wrap">
	<h2><?php _e('Star Review Manager Settings', 'star-review-manager'); ?></h2>
	<h4><?php _e('Upload your CSS file', 'star-review-manager'); ?></h4>
	<form action="" method="post">
		<input type="file" name="custom_css_file" id="custom_css_file">
		<h4><?php _e('Or enter your CSS code below', 'star-review-manager'); ?></h4>
		<textarea id="css_text" name="css_text" class="custom-css-textarea"><?php echo file_get_contents ($file_path, true);?></textarea>
		<br>
		<input value="<?php _e('Save', 'star-review-manager'); ?>" class="button" type="submit" />
		<br><br>
		<h4><?php _e('Any questions about or feedback on the plugin?', 'star-review-manager'); ?></h4>
		<a href="mailto:bram.dekker.nl@gmail.com"><?php _e('send me an e-mail (in Dutch, English or German otherwise you will get a google translated e-mail back)', 'star-review-manager'); ?></a>
</div>
<script>     
	
	jQuery(document).ready(function($) {
		
		jQuery('#custom_css_file').change(function() {
			
			handleFileSelect();
			
		});
	
	});
   
  function handleFileSelect()
  {              
    if (!window.File || !window.FileReader || !window.FileList || !window.Blob) {
      alert('The File APIs are not fully supported in this browser.');
      return;
    }   

    input = document.getElementById('custom_css_file');
    if (!input) {
      alert("Um, couldn't find the fileinput element.");
    }
    else if (!input.files) {
      alert("This browser doesn't seem to support the `files` property of file inputs.");
    }
    else if (!input.files[0]) {
      alert("Please select a file before clicking 'Load'");               
    }
    else {
      file = input.files[0];
      fr = new FileReader();
      fr.onload = receivedText;
      fr.readAsText(file);
    }
  }

  function receivedText() {           
    document.getElementById('css_text').appendChild(document.createTextNode(fr.result))
  }           

</script>