=== Bookwize Form ===
Contributors: Bookwize
Tags: bookwize, booking system, booking form, booking engine, booking, system, engine, bookings, hotel, accommodations
Requires at least: 4.0.1
Tested up to: 4.8
Stable tag: 1.6
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Connect easily Bookwize Hotel Booking System with your WordPress website and let visitors search availability and rates directly from your website.

== Description ==
This Plugin will help you to easily connect your <a href="https://www.bookwize.com/" target="_blank">Bookwize Hotel Booking System</a> with your WordPress website or blog. Bookwize Booking Form will display a form for users to choose dates and guests and check the availability of your hotel.

In order to use the plugin you will need to have an active supscription with Bookwize Hotel Booking System and the necessary credentials provided by <a href="https://www.bookwize.com/more/customer-support/">Bookwize Support</a> team.



== Installation ==

1. Install the plugin by uploading the zip file (Plugins > Add New > Upload)
2. Activate the plugin through the ​_Plugins_​ menu in WordPress
3. Go to the settings page of the plugin to setup the form
4. Add the credentials provided by <a href="https://www.bookwize.com/more/customer-support/">Bookwize Support</a> (API Key, Hotel ID, Hotel Url) and customize your form
5. You can insert Bookwize Form in pages/posts adding shortcode [bookwizeform] or use Bookwize Booking Form Widget on ​Appearance > Widgets section



== Frequently Asked Questions ==
###Can I override the default template?

Yes, simply create a file bookwize-form-template.php in your theme directory

###​How can I get my API Key, Hotel ID and Hotel Url ?

Contact Bookwize Support Team on support@bookwize.com. Please note that you will need to have an active subscription to <a href="https://www.bookwize.com/">Bookwize Hotel Booking System</a>.


###Google analytics cross-domain tracking
If you would like to setup cross-domain linking, then you will have to require the "linker plugin" and call its autoLink method in Google Analytics code.
Replace destinationLink with your hotel url on Bookwize (eg: presentation.bookwize.com).

ga('create', 'UA-XXXXX-Y', 'auto', {'allowLinker': true});

// Loads the Linker plugin
ga('require', 'linker');

// Instructs the Linker plugin to automatically add linker parameters
// to all links and forms pointing to the domain "destination.com".
ga('linker:autoLink', ['destinationLink'], false, true);

Contact Bookwize Support Team on support@bookwize.com. Please note that you will need to have an active subscription to <a href="https://www.bookwize.com/">Bookwize Hotel Booking System</a>.


== Screenshots ==

1. Bookwize Default Theme
2. Bookwize Horizontal Theme 1
3. Bookwize Horizontal Theme 2
4. Bookwize Vertical Theme 1
5. Add Extra Fields (Boards & Coupon Code) & Themes


7. /assets/banner-772x250.png
8. /assets/banner-1544x500.png


