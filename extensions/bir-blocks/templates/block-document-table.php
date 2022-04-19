<?php

# ------------------------------------------
# GUTENBERG: DOCUMENT TABLE
# ------------------------------------------ 

$id = 'block-' . $block['id'];
if( !empty($block['anchor']) ) {
	$id = $block['anchor'];
}

$className = 'bir-block document_table';

if( !empty($block['className']) ) {
	$className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
	$className .= ' align' . $block['align'];
}

$terms = [];
$terms_string = '';
foreach (get_field('document_type') as $document_type_key => $document_type)
{
	$terms[] = $document_type->term_id;
	$terms_string = $terms_string . sanitize_title($document_type->name) .' ';
}

$posts_per_page = -1;
$limit = get_field('limit_items');
if ($limit['enable'] == true) {
	$posts_per_page = $limit['number_of_items'];
}
?>


<div class="<?php echo esc_attr($className); ?>">

	<?php
		$args = array(
			'post_type' => 'documents',
			'posts_per_page' => $posts_per_page,
			'order' => 'DESC',
			'tax_query' => array(
			    array(
			        'taxonomy' => 'document-type',
			        'field' => 'id',
					'terms' => $terms
			    )
			)
		);

		$sort_by_options = get_field('sort_by');
		if ($sort_by_options['enable'] == true)
        {
            switch ($sort_by_options['field'])
            {
                case 'document_date' :
                    $args['meta_key'] = 'date';
                    $args['orderby'] = 'meta_value_num';
                    break;

                case 'file_name' :
                    $args['orderby'] = 'title';
                    break;

                case 'custom_sort' :
                    $args['meta_key'] = 'custom_sort';
                    $args['orderby'] = 'meta_value_num';
                    break;
            }

            $args['order'] = $sort_by_options['direction'];
        }


		$file_query = new WP_Query( $args );
		global $post;
	?>
	
	<?php
	    $columns = get_field('columns');
		if ($file_query->have_posts()):
	?>
		<div class="document-table-container">
			<table class="document-table <?= $terms_string ?>">
				<thead>
					<tr>
						<?php if($columns): foreach($columns as $column) : ?>
							<th class="<?php echo $column['acf_fc_layout'] ?>"><?php echo $column['label'] ?></th>
						<?php endforeach; endif; ?>
					</tr>
				</thead>
				<tbody>
				<?php
                    while ($file_query->have_posts()): $file_query->the_post();
                    $document_fields = get_fields(get_the_id());
                    $file = $document_fields['file_select'];
	                $file_type = get_file_type($file['mime_type']);
                ?>
					<tr>
						<?php if($columns): foreach($columns as $column) : ?>
							<td class="<?php echo $column['acf_fc_layout'] ?>">
								<?php switch($column['acf_fc_layout']) :

									case 'file_name' :
									    if($column['link_to_file'] == true) :
                                            echo '<a href="'.$file['url'].'" target="_blank" class="'.$document_fields['custom_class'].'">';
									    endif;
										the_title();
										if($column['link_to_file'] == true) :
											echo '</a>';
										endif;
										break;

                                    case 'file_size' :
	                                    echo get_file_size($file['url']);
                                        break;

                                    case 'download' :
                                        echo '<a href="'.$file['url'].'" target="_blank" class="'.$document_fields['custom_class'].'" download><i class="fa-solid fa-download"></i></a>';
                                        break;

									case 'document_date' :
										$date = $document_fields['date'];
										$format = $column['format'];

										if($date && $format) :
	                                        $date_object = DateTime::createFromFormat('Ymd', $date);
	                                        $date = $date_object->format($format);
	                                    else :
                                            $date = 'N/A';
                                        endif;

										echo $date;
										break;

                                    case 'date_published' :
                                        echo get_the_date($column['format']);
                                        break;

                                    case 'file_type' :
	                                    echo $file_type;
                                        break;

                                    case 'thumbnail' :
	                                    if($column['link_to_file'] == true) :
		                                    echo '<a href="'.$file['url'].'" target="_blank" class="'.$document_fields['custom_class'].'">';
	                                    endif;

	                                    if ($file_type == 'PDF') :
                                            $img_url = rtrim($file['url'], '.pdf').'-pdf.jpg';
		                                    echo '<img src="'.$img_url.'" alt="'.get_the_title().'" />';
	                                    else :
		                                    echo '<i class="far fa-file no-thumbnail"></i>';
	                                    endif;

	                                    if($column['link_to_file'] == true) :
		                                    echo '</a>';
	                                    endif;
                                        break;
                                    case 'category' :
                                        $categories = get_the_terms( $post->ID, 'document-type' );
	                                    foreach($categories as $category) :
		                                    echo $category->name.' ';
	                                    endforeach;
                                        break;
									default :
									    echo '';

								endswitch; ?>
							</td>
						<?php endforeach; endif; ?>
					</tr>
				<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	<?php endif; wp_reset_query(); ?>

</div>

<?php if ( is_admin() ) { ?>
	<style type="text/css">
        table {
            border: 1px solid black;
            width: 100%;
            border-collapse: collapse;
        }

        table th {
            text-align: left;
            border-bottom: 1px solid black;
            padding: 5px;
        }

        table td {
            padding: 5px;
        }

        table td img {
            width: 30px;
        }
	</style>
<?php } ?>

