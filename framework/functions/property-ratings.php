<?php
/**
 * Property Rating System
 *
 * Functions file for property ratings system.
 *
 * @package realhomes
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! function_exists( 'inspiry_rating_average' ) ) {
	/**
	 * Display rating average based on approved comments with rating
	 */
	function inspiry_rating_average() {

		$args = array(
			'post_id' => get_the_ID(),
			'status' => 'approve',
		);

		$comments = get_comments( $args );
		$ratings = array();
		$count = 0;

		foreach ( $comments as $comment ) {

			$rating = get_comment_meta( $comment->comment_ID, 'inspiry_rating', true );

			if ( ! empty( $rating ) ) {
				$ratings[] = absint( $rating );
				$count++;
			}
		}

		$allowed_html = array(
			'span' => array(
				'class' => array(),
			),
			'i' => array(
				'class' => array(),
			),
		);

		if ( 0 !== count( $ratings ) ) {

			$avg = round( array_sum( $ratings ) / count( $ratings ) );

			echo '<div class="stars-avg-rating">';
			echo wp_kses( inspiry_rating_stars( $avg ), $allowed_html );
			echo '<span class="rating-span">' . esc_html( $avg ) . ' / ' . esc_html__( '5 based on', 'framework' ) . ' ' . esc_html( $count ) . ' ' . esc_html__( 'reviews', 'framework' ) . '</span>';
			echo '</div>';
		}
	}
}


if ( ! function_exists( 'inspiry_rating_stars' ) ) {
	/**
	 * Display rated stars based on given number of rating
	 *
	 * @param int $rating - Average rating.
	 * @return string
	 */
	function inspiry_rating_stars( $rating ) {

		$output = '';

		if ( ! empty( $rating ) ) {

			$output = '<span class="rating-stars">';

			for ( $count = 1; $count <= $rating; $count++ ) {
				$output .= '<i class="fa fa-star-o rated"></i>';
			}

			$unrated = 5 - $rating;
			for ( $count = 1; $count <= $unrated; $count++ ) {
				$output .= '<i class="fa fa-star-o"></i>';
			}

			$output .= '</span>';
		}

		return $output;
	}
}


if ( ! function_exists( 'inspiry_rating_form_field' ) ) {
	/**
	 * Add fields after default fields above the comment box, always visible
	 */
	function inspiry_rating_form_field() {
		if ( 'property' === get_post_type() ) {
			?>
			<div class="stars-comment-rating">
				<div class="rating-box">
					<select id="rate-it" name="inspiry_rating">
						<?php
						for ( $i = 1; $i <= 5; $i++ ) {
							$selected = ( $i == 5 ) ? 'selected' : '';
							echo '<option value="' . esc_attr( $i ) . '" '. $selected . '>' . esc_html( $i ) . '</option>';
						}
						?>
					</select>
				</div>
			</div>
			<?php
		}
	}
}


if ( ! function_exists( 'inspiry_verify_comment_rating' ) ) {
	/**
	 * Add the filter to check whether the comment rating has been set
	 *
	 * @param array $comment_data - Comment Data.
	 *
	 * @return mixed $comment_data
	 */
	function inspiry_verify_comment_rating( $comment_data ) {

		// Filter $_POST array for security.
		$post_array = filter_input_array( INPUT_POST );

		if ( ( isset( $post_array['inspiry_rating'] ) ) && ( empty( $post_array['inspiry_rating'] ) ) ) {

			wp_die( esc_html__( 'Error: You did not add a rating. Hit the Back button on your Web browser and resubmit your comment with a rating.', 'stars-rating' ) );
		}

		return $comment_data;
	}
}


if ( ! function_exists( 'inspiry_save_comment_rating' ) ) {
	/**
	 * Save the comment rating along with comment
	 *
	 * @param int $comment_id - Comment ID.
	 */
	function inspiry_save_comment_rating( $comment_id ) {

		// Filter $_POST array for security.
		$post_array = filter_input_array( INPUT_POST );

		if ( ( isset( $post_array['inspiry_rating'] ) ) && ( ! empty( $post_array['inspiry_rating'] ) ) ) {
			$rating = wp_filter_nohtml_kses( $post_array['inspiry_rating'] );
			if ( $rating ) {
				add_comment_meta( $comment_id, 'inspiry_rating', $rating );
			}
		}

	}
}


if ( ! function_exists( 'inspiry_modify_rating_comment' ) ) {
	/**
	 * Add the comment rating (saved earlier) to the comment text
	 * You can also output the comment rating values directly to the comments template
	 *
	 * @param string $comment - Comment text.
	 * @return string
	 */
	function inspiry_modify_rating_comment( $comment ) {
		$rating = get_comment_meta( get_comment_ID(), 'inspiry_rating', true );
		if ( $rating && 'property' === get_post_type() ) {
			$rating = '<p>' . inspiry_rating_stars( $rating ) . '</p>';
			return $comment . $rating;
		} else {
			return $comment;
		}
	}
}


if ( ! function_exists( 'inspiry_add_property_ratings_hooks' ) ) {
	/**
	 * Function to add hooks for property ratings.
	 *
	 * @since 3.3.1
	 */
	function inspiry_add_property_ratings_hooks() {

		// Check if property ratings is enabled.
		$property_ratings = get_option( 'inspiry_property_ratings', 'false' );
		if ( 'false' === $property_ratings ) {
			return;
		}

		// Add ratings field.
		add_action( 'comment_form_logged_in_before', 'inspiry_rating_form_field' );
		add_action( 'comment_form_top', 'inspiry_rating_form_field' );

		// Make it required.
		add_filter( 'preprocess_comment', 'inspiry_verify_comment_rating' );

		// Save ratings.
		add_action( 'comment_post', 'inspiry_save_comment_rating' );

		// Add ratings to comments text.
		add_filter( 'comment_text', 'inspiry_modify_rating_comment' );

	}
	add_action( 'init', 'inspiry_add_property_ratings_hooks' );
}
