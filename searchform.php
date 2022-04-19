<div id="searchform">
    <form action="/" method="get" role="search" aria-label="Sitewide">
        <input type="text" placeholder="Enter a search term and press enter." name="s" id="s" value="<?php the_search_query(); ?>" />
        <input type="submit" class="search-submit btn btn-primary" value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" />
    </form>
</div>