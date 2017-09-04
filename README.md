# Bookwize Hotel Booking Form Vertical
* Contributors: Bookwize
* Tags: bookwize, booking system, booking form, hotel booking engine, booking, system, engine, bookings, hotel, accommodations
* Tested up to: 4.8

# Description
This Plugin will help you to easily connect your Bookwize hotel booking system with your WordPress website or blog. The bookwize booking form will display a form for users to choose dates and guests and check the availability of your hotel.


# Installation
1. Install the plugin by uploading the zip file (Plugins > Add New > Upload)
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to the settings page of the plugin to setup the form
4. You can insert your Bookwize form in pages/posts using shortcode [bookwizeform] or add Bookwize Booking Form Widget


# Frequently Asked Questions 

###Can i override the default template?

Yes, simply create a file bookwize-form-template.php in your theme directory

###How to get your API Key and Hotel ID ? 

Contact Bookwize Support Team www.bookwize.com - support@bookwize.com

### Google analytics cross-domain tracking
If you would like to setup cross-domain linking, then you will have to require the "linker plugin" and call its autoLink method in Google Analytics code.
Replace destinationLink with your hotel url on Bookwize (eg: presentation.bookwize.com).

ga('create', 'UA-XXXXX-Y', 'auto', {'allowLinker': true});

// Loads the Linker plugin
ga('require', 'linker');

// Instructs the Linker plugin to automatically add linker parameters
// to all links and forms pointing to the domain "destination.com".
ga('linker:autoLink', ['destinationLink'], false, true);

Contact Bookwize Support Team on support@bookwize.com. Please note that you will need to have an active subscription to <a href="https://www.bookwize.com/">Bookwize Hotel Booking System</a>.


# Screenshots 

1. https://github.com/bookwize/bookwize-form-vertical/blob/master/assets/screenshot-1.png
2. https://github.com/bookwize/bookwize-form-vertical/blob/master/assets/screenshot-2.png
3. https://github.com/bookwize/bookwize-form-vertical/blob/master/assets/banner-772x250.png
4. https://github.com/bookwize/bookwize-form-vertical/blob/master/assets/banner-1544x500.png


