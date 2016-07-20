<h2>Bookwize Settings</h2>

<form method="POST" action="options.php">
	<?php
	settings_fields( 'bookwizeform' );
	do_settings_sections( 'bookwizeform' );
	submit_button();
	?>
</form>