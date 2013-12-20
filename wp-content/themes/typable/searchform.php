<form action="<?php echo home_url( '/' ); ?>" class="search-form clearfix">
	<fieldset>
		<input type="text" class="search-form-input text" name="s" onfocus="if (this.value == '<?php _e('Type your search here and press enter...','okay'); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Type your search here and press enter...','okay'); ?>';}" value="<?php _e('Type your search here and press enter...','okay'); ?>"/>
		<input type="submit" value="Search" class="submit search-button" />
	</fieldset>
</form>