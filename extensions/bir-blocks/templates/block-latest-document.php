<?php

# ------------------------------------------
# GUTENBERG: LATEST DOCUMENT
# ------------------------------------------ 

$id = 'latest-documents-' . $block['id'];
if( !empty($block['anchor']) ) {
	$id = $block['anchor'];
}

$className = 'bir-block latest-documents';
if( !empty($block['className']) ) {
	$className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
	$className .= ' align' . $block['align'];
}

$category = get_field('latest_doc_category');

?>

<div id="<?php echo $id; ?>" class="<?php echo esc_attr($className); ?>">
	
	<?php
		$args = array(
			'post_type' => array( 'documents' ),
            'posts_per_page' =>  1,
			'meta_key' => 'date',
			'orderby' => 'meta_value',
			'order' => 'DESC',
            'tax_query' => array(
                array(
                    'taxonomy' => 'document-type',
                    'field' => 'term_id',
                    'terms' => $category
                )
			),
			
		);
		$documentsQuery = new WP_Query( $args );
	?>

    <?php if ($documentsQuery->have_posts()) : ?>
        
		<?php while ($documentsQuery->have_posts()) : $documentsQuery->the_post(); ?>
		
		<?php 
		
			$file = '';
			$file = get_field('file_select', get_the_ID());
		
		?>

            <div class="latest-document-item">
                <span><?php the_time('j M Y'); ?></span>
                <h3><a href="<?php echo $file['url']; ?>" target="_blank"><?php the_title(); ?></a></h3>
            </div>
            
        <?php endwhile; ?>
            
	<?php endif; wp_reset_query(); ?>

</div>

<?php if ( is_admin() ) { ?>
	<style type="text/css">
		.latest-document-item {
			margin: 0 0 10px 0;
			padding: 15px;
			background: #fafafa;
		}
		.excerpt h3 {
			font-size: 18px!important;
			margin: 0!important;
		}
		.excerpt h3 a {
			text-decoration: none;
			color: #444;
		}
	</style>
<?php } ?>