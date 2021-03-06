<?php
if ( ! class_exists( 'Inspiry_Intro_Customize_Control' ) ) {
	return null;
}

/**
 * Class Inspiry_Intro_Customize_Control
 *
 * Custom control to display intro text
 */
class Inspiry_Intro_Customize_Control extends WP_Customize_Control {
	public function render_content() {
		?>
		<label>

			<?php if ( ! empty( $this->label ) ) : ?>
				<span class="customize-control-title"><?php echo $this->label; ?></span>
			<?php endif; ?>

			<?php if ( ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description"><?php echo $this->description; ?></span>
			<?php endif; ?>

		</label>
		<?php
	}
}
