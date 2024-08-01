<form class="search" action="<?php echo esc_url( home_url( '/' ) ); ?>/" method="get">
	<input type="text" value="<?php esc_attr_e('Search and hit enter', 'harington') ?>" onblur="if(this.value == '') { this.value = '<?php esc_attr_e('Search and hit enter', 'harington') ?>'; }" onfocus="if(this.value == '<?php esc_attr_e('Search and hit enter', 'harington') ?>') { this.value = ''; }" size="30" id="search-field" name="s">
	<label class="input_label"></label>
</form>