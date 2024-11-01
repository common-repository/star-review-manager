<div class="wrap">
	<h2>Help</h2>
	<span><?php _e('Thank you for taking the time to take a look at this help page. On this page I will try to give an explanation of the features of this plugin.', 'star-review-manager'); ?></span><br>
	<h3><?php _e('Review instances', 'star-review-manager'); ?></h3>
	<span><?php _e('This page contains information about the following features', 'star-review-manager'); ?>:</span>
	<ul class="list-group list-nonfluid">
		<li class="list-group-item"><?php _e('Creating a review instance', 'star-review-manager'); ?></li>
		<li class="list-group-item"><?php _e('Creating a review form', 'star-review-manager'); ?></li>
		<li class="list-group-item"><?php _e('Creating a review instance', 'star-review-manager'); ?></li>
		<li class="list-group-item"><?php _e('Activating or deleting a review', 'star-review-manager'); ?></li>
		<li class="list-group-item"><?php _e('How to apply new styles to the review form and reviews (advanced)', 'star-review-manager'); ?></li>
		<li class="list-group-item"><?php _e('How to create your own review form (advanced)', 'star-review-manager'); ?></li>
	</ul>
	
	<span><?php _e('One of the most important features of this plugin are the review instances.', 'star-review-manager'); ?></span><br>
	<span><?php _e('A review instance is an instance in which the review items reside.', 'star-review-manager'); ?></span>
	<span><?php _e('The instance makes it possible to create multiple review pages, using the shortcode, instances can be placed on different pages.', 'star-reveiew-manager'); ?></span><br><br>
	<span><?php _e('Use the shortcode', 'star-review-manager'); ?> <b>[srm_review]</b> <?php _e('to add a review instance to your page. The review instance will now automatically loads all active reviews.', 'star-review-manager'); ?></span><br>
	<span><?php _e('In this version we enabled support for the following shortcode parameters:', 'star-review-manager'); ?></span><br>
	<h4><?php _e('Shortcode params', 'star-review-manager'); ?></h4>
	<table class="table table-nonfluid">
		<tr>
			<th><?php _e('Param', 'star-review-manager'); ?></th>
			<th><?php _e('Values', 'star-review-manager'); ?></th>
			<th><?php _e('Mandatory', 'star-review-manager'); ?></th>
		</tr>
		<tr>
			<td>id</td>
			<td><i>1 <?php _e('[id that corresponds to the created review instance (you can find this id in the managing menu)]', 'star-review-manager'); ?></i></td>
			<td><?php _e('Yes', 'star-review-manager'); ?></td>
		</tr>
		<tr>
			<td>option_type</td>
			<td><i>bullets | stars</i></td>
			<td><?php _e('No', 'star-review-manager'); ?></td>
		</tr>
	</table>
	
	<div><b><?php _e('Example', 'star-review-manager'); ?>: [srm_review id=1 option_type="bullets"]</b></div>
	
	<h3><?php _e('Review form', 'star-review-manager'); ?></h3>
	<span><?php _e('We created a review form for your convenience. It is also possible to create your own form, to do this see the section: Create your own form (advanced)', 'star-review-manager'); ?></span><br>
	<span><?php _e('To add the given form to your page, add the shortcode ', 'star-review-manager'); ?> <b>[srm_review_form]</b> <?php _e(' to your page together with the review instance id that the form needs to send its data to.', 'star-review-manager'); ?></span>
	<h4><?php _e('Shortcode params', 'star-review-manager'); ?></h4>
	<table class="table table-nonfluid">
		<tr>
			<th><?php _e('Param', 'star-review-manager'); ?></th>
			<th><?php _e('Values', 'star-review-manager'); ?></th>
			<th><?php _e('Mandatory', 'star-review-manager'); ?></th>
		</tr>
		<tr>
			<td>container_id</td>
			<td><i>1 <?php _e('[id of the related review instance on this page]','star-review-manager'); ?></i></td>
			<td><?php _e('Yes', 'star-review-manager'); ?></td>
		</tr>
	</table>
	<div><b><?php _e('Example', 'star-review-manager'); ?>: [srm_review_form container_id=1]</b></div><br>
	<h3><?php _e('Reviews', 'star-review-manager'); ?></h3>
	<span><?php _e('As mentioned do reviews reside in a review instance.', 'star-review-manager'); ?></span><br>
	<span><?php _e('Click on manage reviews in the manage review instances menu to see all approved and pending reviews.', 'star-review-manager'); ?></span><br>
	<h4><?php _e('Pending', 'star-review-manager'); ?></h4>
	<span><?php _e('After someone submitted a review on your website, the review is pending until you as an administrator agrees with the content.', 'star-review-manager'); ?></span><br>
	<span><?php _e('When you agree with the content of the review, you have the possibility to approve the review, to do this: click on the approve button related to the review.', 'star-review-manager'); ?></span>
	<h4><?php _e('Approved', 'star-review-manager'); ?></h4>
	<span><?php _e('All approved reviews are being shown on the place of the srm_reviewcontainer shortcode.', 'star-review-manager'); ?></span><br>
	<span><?php _e('If you would like to remove a review, click on the delete button next to the review. The review will now be removed.', 'star-review-manager'); ?></span>
	<span>Here you have the ability to add css by uploading a css file or by adding your own custom css in the textarea.', 'star-review-manager'); ?></span><br>
	<br>
	<h2><?php _e('Advanced', 'star-review-manager'); ?></h2>
	<h4><?php _e('Style the given form and reviews', 'star-review-manager'); ?></h4>
	<span><?php _e('It is possible to style the form and reviews that are provided by the plugin. To do this, go to the Star Review Manager Settings page (located in Settings) and add CSS code.', 'star-review-manager'); ?></span><br>
	<h4><?php _e('Create your own form (Advanced)', 'star-review-manager'); ?></h4>
	<span><?php _e('It is also possible to create your own form. To do this create a form tag with an empty action and a post method.', 'star-review-manager'); ?></span>
	<span><?php _e('Next to that, make sure that you include a few (hidden)-tags within the form. The following tags are available:', 'star-review-manager'); ?></span>
	<br>
	<table class="table table-nonfluid">
		<tr>
			<th><?php _e('Tag name attribute', 'star-review-manager'); ?></th>
			<th><?php _e('Description', 'star-review-manager'); ?></th>
			<th><?php _e('Mandatory', 'star-review-manager'); ?></th>
			<th><?php _e('Hidden', 'star-review-manager'); ?></th>
		</tr>
		<tr>
			<td>crud[container_id]</td>
			<td><i><?php _e('Related instance id. Make sure that this id corresponds to the id of the review instance on this page.', 'star-review-manager'); ?></i></td>
			<td><b><?php _e('Yes', 'star-review-manager'); ?></b></td>
			<td><b><?php _e('Yes', 'star-review-manager'); ?></b></td>
		</tr>
		<tr>
			<td>crud[action]</td>
			<td><i>make sure that this value is create.</i></td>
			<td><b><?php _e('Yes', 'star-review-manager'); ?></b></td>
			<td><b><?php _e('Yes', 'star-review-manager'); ?></b></td>
		</tr>
		
		<tr>
			<td>crud[firstname]</td>
			<td><i><?php _e('A user will be created with this as his firstname (make sure that you also add lastname)', 'star-review-manager'); ?></i></td>
			<td><?php _e('No', 'star-review-manager'); ?></td>
			<td><?php _e('No', 'star-review-manager'); ?></td>
		</tr>
		<tr>
			<td>crud[lastname]</td>
			<td><i><?php _e('A user will be created with this as his lastname (make sure that you also add firstname)', 'star-review-manager'); ?></i></td>
			<td><?php _e('No', 'star-review-manager'); ?></td>
			<td><?php _e('No', 'star-review-manager'); ?></td>
		</tr>
	</table>
	<span><?php _e('Next to the fields, make sure that your submit button has the name property', 'star-review-manager'); ?> <b>crud[review]</b><?php _e(', because we want to create a review.', 'star-review-manager'); ?></span><br>
	<div><b><?php _e('Example: see the code of the generated form when you add it through a shortcode :)', 'star-review-manager'); ?></b></div><br>
	<br><br><br>
	<h4><?php _e('Any questions about or feedback on the plugin?', 'star-review-manager'); ?></h4>
	<a href="mailto:bram.dekker.nl@gmail.com"><?php _e('Send me an e-mail (in Dutch, English or German otherwise you will get a google translated e-mail back)', 'star-review-manager'); ?></a>
</div>