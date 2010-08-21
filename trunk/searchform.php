<form action="<?php bloginfo('url'); ?>" method="get">
	<fieldset class="search">
		<input type="text" name="s" id="input" value="<?php the_search_query();?>" />
		<input type="submit" id="searchsubmit" value=""/>
	</fieldset>
	</form>