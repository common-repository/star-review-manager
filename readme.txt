=== Star Review Manager ===
Contributors: bramdnl
Tags: srm, review, manager, review form, form, rating, ratings, star rating, shortcode, business, feedback, rating categories
Requires at least: 3.1
Tested up to: 4.3
Stable tag: 1.3
License: GPLv2 or later

== Description ==

The Star Review Manager Plugin lets you manage reviews that were submitted to your website. The plugin handles the storing and presenting of the reviews and related review form. 

Major features of SRM include:

* Create one or multiple review containers that shows all active reviews using a shortcode (options are bullets or stars).
* Manage multiple reviews by approving or deleting them before they are shown on the website.
* Add a dynamic amount of rating categories to your review form
* Generate an easy to use review form using a shortcode.
* Style your own reviews and review form by uploading your own custom CSS or adding to the given CSS. 
* Extensive help page with information
* English and Dutch translation.

== Installation ==

Unzip the star-review-manager.zip file in your plugin folder and activate your plugin in the admin menu.

And you're done!

== Frequently Asked Questions ==

= What is a review instance =

A review instance is a container in which your reviews reside.

= How do I manage my reviews =
You can manage (approve or delete) your reviews by clicking on the manage reviews link on the Manage review instances page.

= I created a review instance but I do not see anything show up on the page? =
Make sure that you include the review container shortcode (do not forget to also include the id parameter that can be found in the review instances table). 
Next to the review container, make sure that you also include the review form short-tag (including the related container_id parameter).
More information about this can be found on the help page, located in the admin menu.

== Screenshots ==

1. Easily check wheter you have pending reviews that are waiting for approval
2. Add a dynamic amount of rating categories to your review instance. This way, you can customize the review perfectly for your business
3. You have the ability to add your own custom css on top of the already existing CSS. Style your reviews and review form just the way you want
4. Get a clear overview of reviews that are still pending or already active and make a choice to approve or delete them
5. Create a review form and related reviews just with two simple shortcodes

== Changelog ==
= 1.3 =
* Fixed error for php5.3 in class.user.php
* removed foreign keys in db because of limited support by dbDelta (this was causing many errors)
* changed crud to srm_crud calls to avoid collision with other plugins

= 1.2.1 =
* Changed identifier for pagination to srm-page because of issues with WP blogposts

= 1.2 =
* Added measures to prevent Sql injection.
* Added measures to avoid XSS
* Added pagination based on the review limit of the review instance
* Added the option to remove chosen categories when creating a review instance.
* Fixed IE bug that the form would not send because of ajax

= 1.1 =
* Added email feedback upon review submit.
* Added option to enter receiver email when creating a review instance
* Fixed some minor translation errors.
* Add notification when there are pending reviews.
* Added option to add multiple rating categories (e.g. service, maintenance)

NOTE: this version included a database change. 
Because of this you, reviews created using v1.0 will not have any categorized ratings (that did not exist in 1.0). If you really need to convert the data, please send me an e-mail and I will help you out.


= 1.0 =
* Release Date: 20 Feb 2015

== Upgrade Notice ==

= 1.1 =
You are able to add a dynamic amount of rating categories now, e.g., service, drinks,food.
