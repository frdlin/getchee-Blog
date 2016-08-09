<?php
/**
 * Template: Searchform.php
 *
 * @package WPFramework
 * @subpackage Template
 */
?>
<!--BEGIN #searchform-->
<form class="searchform" method="get" action="<?php bloginfo( 'url' ); ?>" onload="javascript:showDiv()">
	<input class="search" name="s" type="text" value="" tabindex="1"/>
	<div class="form-button">
		<!--input type="image" class="search-btn" src="<!?php echo IMAGES . '/btn-search.png'; ?>" alt="Search Button"/-->
		<input type="submit" class="search-btn" alt="Search Button" value=""/>
	</div>
	<input type="button" value="Search Switch" class="search-switch"/>

<!--END #searchform-->
</form>


