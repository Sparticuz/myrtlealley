<form action="<?php bloginfo('url'); ?>" method="get">
	<fieldset>
		<input type="text" name="s" id="input" value="<?php the_search_query();?>" placeholder="Search" />
		<input type="submit" id="searchsubmit" value=""/>
	</fieldset>
</form>