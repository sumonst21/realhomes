<?php
/**
 * Displays agent info for agent detail page.
 *
 * @package    realhomes
 * @subpackage modern
 */

global $post;
$agent_id = get_the_ID();

$facebook_url    = get_post_meta( $agent_id, 'REAL_HOMES_facebook_url', true );
$twitter_url     = get_post_meta( $agent_id, 'REAL_HOMES_twitter_url', true );
$google_plus_url = get_post_meta( $agent_id, 'REAL_HOMES_google_plus_url', true );
$linked_in_url   = get_post_meta( $agent_id, 'REAL_HOMES_linked_in_url', true );
$instagram_url   = get_post_meta( $agent_id, 'inspiry_instagram_url', true );

/* Agent Contact Info */
$agent_mobile       = get_post_meta( $agent_id, 'REAL_HOMES_mobile_number', true );
$agent_whatsapp     = get_post_meta( $agent_id, 'REAL_HOMES_whatsapp_number', true );
$agent_office_phone = get_post_meta( $agent_id, 'REAL_HOMES_office_number', true );
$agent_office_fax   = get_post_meta( $agent_id, 'REAL_HOMES_fax_number', true );
$agent_email        = get_post_meta( $agent_id, 'REAL_HOMES_agent_email', true );

$listed_properties = inspiry_get_listed_properties( $agent_id );

?>

<div class="rh_agent_profile">

	<div class="rh_agent_profile__wrap">

		<div class="rh_agent_profile__head">

			<div class="rh_agent_profile__dp">

				<?php if ( has_post_thumbnail() ) : ?>
					<figure class="picture">
						<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'agent-image' ); ?>
						</a>
					</figure>
					<!-- /.picture -->
				<?php endif; ?>

				<div class="listed_properties">
					<p class="number"><?php echo ( ! empty( $listed_properties ) ) ? esc_html( $listed_properties ) : 0; ?></p>
					<!-- /.number -->
					<p class="heading"><?php ( 1 === $listed_properties ) ? esc_html_e( 'Listed Property', 'framework' ) : esc_html_e( 'Listed Properties', 'framework' ); ?></p>
					<!-- /.heading -->
				</div>
				<!-- /.listed_properties -->

			</div>
			<!-- /.rh_agent_profile__dp -->

			<div class="rh_agent_profile__details">
				<div class="rh_agent_profile__name">
					<h3 class="name"><?php the_title(); ?></h3>
					<!-- /.name -->
					<div class="rh_agent_profile__social">
						<?php
						if ( ! empty( $facebook_url ) ) {
							?>
							<a target="_blank" href="<?php echo esc_url( $facebook_url ); ?>"><i class="fa fa-facebook-official"></i></a>
							<?php
						}

						if ( ! empty( $twitter_url ) ) {
							?>
							<a target="_blank" href="<?php echo esc_url( $twitter_url ); ?>"><i class="fa fa-twitter"></i></a>
							<?php
						}

						if ( ! empty( $linked_in_url ) ) {
							?>
							<a target="_blank" href="<?php echo esc_url( $linked_in_url ); ?>"><i class="fa fa-linkedin-square"></i></a>
							<?php
						}

						if ( ! empty( $google_plus_url ) ) {
							?>
							<a target="_blank" href="<?php echo esc_url( $google_plus_url ); ?>"><i class="fa fa-google-plus"></i></a>
							<?php
						}

						if ( ! empty( $instagram_url ) ) {
							?>
							<a target="_blank" href="<?php echo esc_url( $instagram_url ); ?>"><i class="fa fa-instagram"></i></a>
							<?php
						}
						?>
					</div>
					<!-- /.rh_agent_profile__social -->
				</div>
				<!-- /.rh_agent_profile__name -->
				<div class="rh_agent_profile__contact">
					<?php if ( ! empty( $agent_office_phone ) ) : ?>
						<p class="detail office">
							<?php esc_html_e( 'Office', 'framework' ); ?>:
							<a href="tel:<?php echo esc_attr( $agent_office_phone ); ?>"><?php echo esc_html( $agent_office_phone ); ?></a>
						</p>
						<!-- /.detail -->
					<?php endif; ?>

					<?php if ( ! empty( $agent_mobile ) ) : ?>
						<p class="detail mobile">
							<?php esc_html_e( 'Mobile', 'framework' ); ?>:
							<a href="tel:<?php echo esc_attr( $agent_mobile ); ?>"><?php echo esc_html( $agent_mobile ); ?></a>
						</p>
						<!-- /.detail -->
					<?php endif; ?>

					<?php if ( ! empty( $agent_office_fax ) ) : ?>
						<p class="detail fax">
							<?php esc_html_e( 'Fax', 'framework' ); ?>:
							<a href="tel:<?php echo esc_attr( $agent_office_fax ); ?>"><?php echo esc_html( $agent_office_fax ); ?></a>
						</p>
						<!-- /.detail -->
					<?php endif; ?>

					<?php if ( ! empty( $agent_whatsapp ) ) : ?>
						<p class="detail whatsapp">
							<?php esc_html_e( 'WhatsApp', 'framework' ); ?>:
							<a href="tel:<?php echo esc_attr( $agent_whatsapp ); ?>"><?php echo esc_html( $agent_whatsapp ); ?></a>
						</p>
						<!-- /.detail -->
					<?php endif; ?>

					<?php if ( ! empty( $agent_email ) ) : ?>
						<p class="detail email">
							<?php esc_html_e( 'Email', 'framework' ); ?>:
							<a href="mailto:<?php echo esc_attr( antispambot( $agent_email ) ); ?>"><?php echo esc_html( antispambot( $agent_email ) ); ?></a>
						</p>
						<!-- /.detail -->
					<?php endif; ?>
				</div>
				<!-- /.rh_agent_profile__contact -->
			</div>
			<!-- /.rh_agent_profile__details -->

		</div>
		<!-- /.rh_agent_profile__head -->

		<div class="rh_content rh_agent_profile__excerpt">
			<?php the_content(); ?>
		</div>
		<!-- /.rh_agent_profile__excerpt -->

		<div class="rh_agent_profile__contact_form">
			<?php get_template_part( 'assets/modern/partials/agent/single/contact-form' ); ?>
		</div>
		<!-- /.rh_agent_profile__contact_form -->

	</div>
	<!-- /.rh_agent_profile__wrap -->

</div>
<!-- /.rh_agent_profile -->
