<?php
if ( ! class_exists( 'Inspiry_Dragdrop_Control' ) ) {
	return null;
}

/**
 * Class Inspiry_Dragdrop_Control
 *
 * Custom control to display separator
 */
class Inspiry_Dragdrop_Control extends WP_Customize_Control {
	public function render_content() {

		$this->embed_js();
		$this->embed_css();

		$ordered_sections = $this->sections_ordered_array();
		?>
		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
		<div id="sections">
			<?php
				foreach ( $ordered_sections as $key => $value ) {
					echo '<div class="section" draggable="true" ><span data-value="' . $key . '">' . $value . '</span></div>';
				}
			?>
		</div><input id="sorting-db" type="text" <?php $this->link(); ?>>
		<?php
	}

	public function embed_js() {
		?>
		<script>
			var dragSrcEl = null;

			function handleDragStart(e) {
				this.style.opacity = '0.4';

				dragSrcEl = this;

				e.dataTransfer.effectAllowed = 'move';
				e.dataTransfer.setData('text/html', this.innerHTML);
			}

			function handleDragOver(e) {
				if (e.preventDefault) {
					e.preventDefault();
				}

				e.dataTransfer.dropEffect = 'move';

				return false;
			}

			function handleDragEnter(e) {

				this.classList.add('over');
			}

			function handleDragLeave(e) {
				this.classList.remove('over');
			}

			function handleDrop(e) {

				if (e.stopPropagation) {
					e.stopPropagation();
				}

				if (dragSrcEl != this) {
					dragSrcEl.innerHTML = this.innerHTML;
					this.innerHTML = e.dataTransfer.getData('text/html');
				}

				return false;
			}

			function handleDragEnd(e) {

				this.style.opacity = '1';

				[].forEach.call(sections, function (section) {
					section.classList.remove('over');
				});

				var optionTexts = [];
				jQuery('#sections .section').each(function () {
					optionTexts.push(jQuery(this).children('span').data('value'))
				});

				var quotedCSV = optionTexts.join(',');

				var db_input = jQuery('#sorting-db');
				db_input.val(quotedCSV).trigger('change');
			}

			var sections = document.querySelectorAll('#sections .section');
			[].forEach.call(sections, function (section) {
				section.addEventListener('dragstart', handleDragStart, false);
				section.addEventListener('dragenter', handleDragEnter, false)
				section.addEventListener('dragover', handleDragOver, false);
				section.addEventListener('dragleave', handleDragLeave, false);
				section.addEventListener('drop', handleDrop, false);
				section.addEventListener('dragend', handleDragEnd, false);
			});
		</script>
		<?php

	}

	public function embed_css() {
		?>
		<style>
			[draggable] {
				-moz-user-select: none;
				-khtml-user-select: none;
				-webkit-user-select: none;
				user-select: none;
				-khtml-user-drag: element;
				-webkit-user-drag: element;
			}

			.section {
				height: auto;
				padding: 15px 0;
				width: 100%;
				float: left;
				border: 1px solid #cccccc;
				background-color: #fff;
				margin-bottom: 5px;
				text-align: center;
				font-weight: 700;
				cursor: move;
			}

			.section.over {
				border: 1px dashed #000;
			}

			#sorting-db {
				display: none;
			}
		</style>
		<?php
	}

	public function sections_ordered_array() {

		$saved_order    = explode( ',', $this->value() );
		$sections_order = $this->clean_ordered_array( $saved_order, $this->choices );

		return array_merge( array_flip( $sections_order ), $this->choices );
	}

	public function clean_ordered_array( $order, $choices ) {

		$sections_order = array();

		foreach ( $order as $section ) {
			if ( array_key_exists( $section, $choices ) ) {
				$sections_order[] = $section;
			}
		}

		return $sections_order;
	}
}
