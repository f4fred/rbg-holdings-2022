<?php

# ------------------------------------------
# GUTENBERG: CALENDAR TABLE
# ------------------------------------------ 

$id = 'block-' . $block['id'];
if( !empty($block['anchor']) ) {
	$id = $block['anchor'];
}

$className = 'bir-block calendar_table';

if( !empty($block['className']) ) {
	$className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
	$className .= ' align' . $block['align'];
}

$posts_per_page = -1;

$show_add_content = get_field('include_additional_content');
$content_accordian = get_field('display_additional_content');

?>

<div class="<?php echo esc_attr($className); ?>">

	<?php
		$args = array(
			'post_type'      => 'calendar',
            'meta_key'  => 'event_date',
			'posts_per_page' => $posts_per_page,
            'orderby'        => 'meta_value_num',
			'order'          => 'DESC'
		);

		$file_query = new WP_Query( $args );
		global $post;
	?>
	
	<?php
		if ($file_query->have_posts()):
	?>
		<div class="calendar-container">

            <h3>Upcoming Events</h3>
				<?php
                while ($file_query->have_posts()): $file_query->the_post();

                    $calendar_fields = get_fields(get_the_id());
                    $the_date = strtotime($calendar_fields['event_date']);
                    $add_to_calendar = date('Ymd', $the_date);
                    $next_day = date('Ymd', strtotime($add_to_calendar . ' +1 days'));
                    $additional_content = $calendar_fields['additional_content'];
                    
                    if($the_date > time()): ?>

                        <div class="event <?php if($additional_content && $content_accordian || $show_add_content): echo 'additional-info'; endif; if(!$content_accordian){echo ' open';}elseif($additional_content){echo ' click';}; ?>">
                            <div class="event-date">
                                <?php echo date('jS F Y', $the_date); ?>
                            </div>
                            <div class="event-title">
                                <?php if($additional_content && $content_accordian): echo '<strong>'; endif; the_title(); if($additional_content && $content_accordian): echo '<i class="fa-solid fa-circle-info"></i></strong>'; endif; ?>
                            </div>
                            <div class="add-to-calendar">
                                <a href="https://www.google.com/calendar/render?action=TEMPLATE&text=<?php the_title(); ?>&dates=<?php echo $add_to_calendar . "/" . $next_day; ?>"><span>Add to calendar</span> <i class="fa-solid fa-calendar-check"></i></a>
                            </div>
                            <?php if($additional_content && $show_add_content): ?>
                            <div class="additional-content fancy-box">
                                <h5>Additional Information</h5>
                                <?php echo $additional_content;?>
                            </div>
                            <?php endif;?>
                        </div>

                    <?php endif;
                endwhile; ?>
                
            <h3>Past Events</h3>
                <?php
                while ($file_query->have_posts()): $file_query->the_post();

                    $calendar_fields = get_fields(get_the_id());
                    $the_date = strtotime($calendar_fields['event_date']);                    
                    $additional_content = $calendar_fields['additional_content'];

                    if($the_date < time()): ?>

                        <div class="event past <?php if($additional_content && $content_accordian || $show_add_content): echo 'additional-info'; endif; if(!$content_accordian){echo ' open';}elseif($additional_content){echo ' click';}; ?>">
                            <div class="event-date">
                                <?php echo date('jS F Y', $the_date); ?>
                            </div>
                            <div class="event-title">
                                <?php if($additional_content && $content_accordian): echo '<strong>'; endif; the_title(); if($additional_content && $content_accordian): echo '<i class="fa-solid fa-circle-info"></i></strong>'; endif; ?>
                            </div>
                            <?php if($additional_content && $show_add_content): ?>
                            <div class="additional-content fancy-box">
                                <h5>Additional Information</h5>
                                <?php echo $additional_content;?>
                            </div>
                            <?php endif;?>
                        </div>

                    <?php endif;

                endwhile; ?>
		</div>
	<?php endif; wp_reset_query(); ?>

</div>

<?php if ( is_admin() ) { ?>
	<style type="text/css">

        h3{
            margin-top: 4rem;
        }

        .event{
            display: flex;
            align-items: center;
            padding: 0.5em 1em;
            margin-bottom: 0.5em;
            background: rgba($secondary, 0.5);
            transition: 450ms $smooth;
        }

        .event-date{
            width: 25%;
            font-weight: 500;
            margin-right: 1em;
            color: #444;
        }

        .event-title{
            width: 50%;
        }

        .add-to-calendar{
            width: 20%;
            text-align: center;
            font-size: 2rem;
        }
        .add-to-calendar a{
            font-size: 1.6rem;
            transition: 450ms $smooth;
            cursor: pointer;
        }

        .additional-content{
            display: none;
        }

	</style>
<?php } ?>

