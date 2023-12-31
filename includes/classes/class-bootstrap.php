<?php
/**
 * Bootstrap class
 *
 * Do not namespace this class.
 * Bludit core admin files employ this class.
 *
 * @package    Configure 8 Admin
 * @subpackage Classes
 * @category   Helpers
 * @since      1.0.0
 * @author     Bludit
 */

// Stop if accessed directly.
if ( ! defined( 'BLUDIT' ) ) {
	die();
}

class Bootstrap {

	/**
	 * Modal windows
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array $args
	 * @return string Returns the modal markup.
	 */
	public static function modal( $args ) {

		$buttonSecondary      = $args['buttonSecondary'];
		$buttonSecondaryClass = $args['buttonSecondaryClass'];

		$buttonPrimary      = $args['buttonPrimary'];
		$buttonPrimaryClass = $args['buttonPrimaryClass'];

		$modalText  = $args['modalText'];
		$modalTitle = $args['modalTitle'];
		$modalId    = $args['modalId'];

		return <<<EOF
		<div id="$modalId" class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<h3>$modalTitle</h3>
						<p>$modalText</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn $buttonSecondaryClass" data-dismiss="modal">$buttonSecondary</button>
						<button type="button" class="btn $buttonPrimaryClass">$buttonPrimary</button>
					</div>
				</div>
			</div>
		</div>
		EOF;
	}

	/**
	 * Link markup
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array $args
	 * @return string Returns the link markup.
	 */
	public static function link( $args ) {

		$class = '';
		if ( isset( $args['class'] ) ) {
			$class = $args['class'];
		}

		$target = '_self';
		if ( isset( $args['target'] ) ) {
			$target = $args['target'];
		}

		$icon = '';
		if ( isset( $args['icon'] ) ) {
			$icon = "<span class='fa fa-{$args['icon']}'></span>";
		}

		$link = sprintf(
			'<a href="%s" target="%s" class="%s">%s%s</a>',
			$args['href'],
			$target,
			$class,
			$icon,
			$args['title']
		);

		return $link;
	}

	/**
	 * Admin page title
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array $args
	 * @return string Returns the heading markup.
	 */
	public static function pageTitle( $args ) {

		$icon = '';
		if ( $args['icon'] ) {
			$icon = "<span class='page-title-icon fa fa-{$args['icon']}'></span>";
		}
		$title = $args['title'];

		return sprintf(
			'<h1 class="page-title">%s<span class="page-title-text">%s</span></h1>',
			$icon,
			$title
		);
	}

	/**
	 * Form opening tag
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array $args
	 * @return string Returns the form opening tag.
	 */
	public static function formOpen( $args ) {

		// If isset (?) else (:).
		$id      = isset( $args['id'] )      ? $args['id']      : '';
		$class   = isset( $args['class'] )   ? $args['class']   : '';
		$method  = isset( $args['method'] )  ? $args['method']  : 'post';
		$action  = isset( $args['action'] )  ? $args['action']  : '';
		$enctype = isset( $args['enctype'] ) ? $args['enctype'] : '';

		$style = '';
		if ( isset( $args['style'] ) ) {
			$style = " style='{$args['style']}'";
		}

		return sprintf(
			'<form id="%s" class="%s" method="%s" action="%s" enctype="%s" autocomplete="off"%s>',
			$id,
			$class,
			$method,
			$action,
			$enctype,
			$style
		);
	}

	/**
	 * Form opening tag & script
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array $args
	 * @return string Returns the form closing tag and
	 *                a JavaScript block.
	 */
	public static function formClose() {

		?>
		</form>
		<script>
		$(document).ready( function() {

			// Prevent the form submit when press enter key.
			$( 'form' ).keypress( function(e) {
				if ( ( e.which == 13 ) && ( e.target.type !== 'textarea' ) ) {
					return false;
				}
			});
		});
		</script>
		<?php
	}

	/**
	 * Form section heading
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array $args
	 * @return string Returns the heading markup.
	 */
	public static function formTitle( $args ) {

		$element = 'h2';
		if ( isset( $args['element'] ) ) {
			$element = $args['element'];
		}

		$class = '';
		if ( isset( $args['class'] ) ) {
			$class = $args['class'];
		}

		$title = '';
		if ( isset( $args['title'] ) ) {
			$title = $args['title'];
		}

		return sprintf(
			'<%s class="form-heading %s">%s</%s>',
			$element,
			$class,
			$title,
			$element
		);
	}

	/**
	 * Input: text
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array $args
	 * @return string Returns the markup.
	 */
	public static function formInputText( $args ) {

		$name        = $args['name'];
		$disabled    = empty( $args['disabled'] ) ? '' : 'disabled';
		$readonly    = empty( $args['readonly'] ) ? '' : 'readonly';
		$placeholder = isset( $args['placeholder'] ) ? $args['placeholder'] : '';
		$value       = isset( $args['value'] ) ? $args['value'] : '';

		$id = 'js' . $name;
		if ( isset( $args['id'] ) ) {
			$id = $args['id'];
		}

		$tip = '';
		if ( isset( $args['tip'] ) ) {
			$tip = '<small class="form-text text-muted">' . $args['tip'] . '</small>';
		}

		$label = '';
		if ( isset( $args['label'] ) ) {
			$label = '<label for="' . $id . '" class="col-sm-2 col-form-label">' . $args['label'] . '</label>';
		}

		$class = 'form-control';
		if ( isset( $args['class'] ) ) {
			$class = $class . ' ' . $args['class'];
		}

		$type = 'text';
		if ( isset( $args['type'] ) ) {
			$type = $args['type'];
		}

		return <<<EOF
		<div class="form-group row">
			$label
			<div class="col-sm-10">
				<input class="$class" id="$id" name="$name" value="$value" placeholder="$placeholder" type="$type" $disabled $readonly>
				$tip
			</div>
		</div>
		EOF;
	}

	/**
	 * Input: text block
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array $args
	 * @return string Returns the markup.
	 */
	public static function formInputTextBlock( $args ) {

		$name        = $args['name'];
		$disabled    = empty( $args['disabled'] ) ? '' : 'disabled';
		$placeholder = isset( $args['placeholder'] ) ? $args['placeholder'] : '';
		$value       = isset( $args['value'] ) ? $args['value'] : '';

		$id = 'js' . $name;
		if ( isset( $args['id'] ) ) {
			$id = $args['id'];
		}

		$tip = '';
		if ( ! empty( $args['tip'] ) ) {
			$tip = '<small class="form-text text-muted">' . $args['tip'] . '</small>';
		}

		$class = 'form-group m-0';
		if ( isset( $args['class'] ) ) {
			$class = $args['class'];
		}

		$labelClass = 'mt-4 mb-2 pb-2 border-bottom text-uppercase w-100';
		if ( isset( $args['labelClass'] ) ) {
			$labelClass = $args['labelClass'];
		}

		$label = '';
		if ( ! empty( $args['label'] ) ) {
			$label = '<label class="' . $labelClass . '" for="' . $id . '">' . $args['label'] . '</label>';
		}

		$type = 'text';
		if ( isset( $args['type'] ) ) {
			$type = $args['type'];
		}

		return <<<EOF
		<div class="$class">
			$label
			<input type="text" value="$value" class="form-control" id="$id" name="$name" placeholder="$placeholder" $disabled>
			$tip
		</div>
		EOF;
	}

	/**
	 * input: file
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array $args
	 * @return string Returns the markup.
	 */
	public static function formInputFile( $args ) {

		$id = 'js' . $args['name'];
		if ( isset( $args['id'] ) ) {
			$id = $args['id'];
		}

		$class = 'custom-file';
		if ( isset( $args['class'] ) ) {
			$class = $class . ' ' . $args['class'];
		}

		$html  = '<div class="' . $class . '">';
		$html .= '<input type="file" class="custom-file-input" id="' . $id . '">';
		$html .= '<label class="custom-file-label" for="' . $id . '">' . $args['label'] . '</label>';
		$html .= '</div>';

		return $html;
	}

	/**
	 * Input: textarea
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array $args
	 * @return string Returns the markup.
	 */
	public static function formTextarea( $args ) {

		$id = 'js' . $args['name'];
		if ( isset( $args['id'] ) ) {
			$id = $args['id'];
		}

		$class = 'form-control';
		if ( isset( $args['class'] ) ) {
			$class = $class . ' ' . $args['class'];
		}

		$html = '<div class="form-group row">';

		if ( ! empty( $args['label'] ) ) {
			$html .= '<label for="' . $id . '" class="col-sm-2 col-form-label">' . $args['label'] . '</label>';
		}

		$html .= '<div class="col-sm-10">';
		$html .= '<textarea class="' . $class . '" id="' . $id . '" name="' . $args['name'] . '" rows="' . $args['rows'] . '" placeholder="' . $args['placeholder'] . '">' . $args['value'] . '</textarea>';
		if ( isset($args['tip'] ) ) {
			$html .= '<small class="form-text text-muted">' . $args['tip'] . '</small>';
		}
		$html .= '</div></div>';

		return $html;
	}

	/**
	 * Input: textarea block
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array $args
	 * @return string Returns the markup.
	 */
	public static function formTextareaBlock( $args ) {

		$id = 'js' . $args['name'];
		if ( isset( $args['id'] ) ) {
			$id = $args['id'];
		}

		$class = 'form-control';
		if ( ! empty( $args['class'] ) ) {
			$class = $class . ' ' . $args['class'];
		}

		$html = '<div class="form-group m-0">';
		if ( ! empty( $args['label'] ) ) {
			$html .= '<label class="mt-4 mb-2 pb-2 border-bottom text-uppercase w-100" for="' . $id . '">' . $args['label'] . '</label>';
		}

		$html .= '<textarea class="' . $class . '" id="' . $id . '" name="' . $args['name'] . '" rows="' . $args['rows'] . '" placeholder="' . $args['placeholder'] . '">' . $args['value'] . '</textarea>';
		if ( ! empty( $args['tip'] ) ) {
			$html .= '<small class="form-text text-muted">' . $args['tip'] . '</small>';
		}
		$html .= '</div>';

		return $html;
	}

	/**
	 * Input: checkbox
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array $args
	 * @return string Returns the markup.
	 */
	public static function formCheckbox( $args ) {

		$labelForCheckbox = isset( $args['labelForCheckbox'] ) ? $args['labelForCheckbox'] : '';
		$placeholder      = isset( $args['placeholder'] ) ? $args['placeholder'] : '';
		$tip   = isset( $args['tip'] ) ? '<small class="form-text text-muted">' . $args['tip'] . '</small>' : '';
		$value = isset( $args['value'] ) ? $args['value'] : '';
		$name  = $args['name'];
		$id    = 'js' . $name;

		if ( isset( $args['id'] ) ) {
			$id = $args['id'];
		}
		$disabled = isset( $args['disabled'] ) ? 'disabled' : '';

		$class = 'form-group m-0';
		if ( isset( $args['class'] ) ) {
			$class = $args['class'];
		}

		$labelClass = 'mt-4 mb-2 pb-2 border-bottom text-uppercase w-100';
		if ( isset( $args['labelClass'] ) ) {
			$labelClass = $args['labelClass'];
		}

		$type = 'text';
		if ( isset( $args['type'] ) ) {
			$type = $args['type'];
		}

		$label = '';
		if ( ! empty( $args['label'] ) ) {
			$label = '<label class="' . $labelClass.'">' . $args['label'] . '</label>';
		}

		$checked = $args['checked'] ? 'checked' : '';
		$value   = $checked ? '1' : '0';

		return <<<EOF
		<div class="$class">
			$label
			<div class="form-check">
				<input type="hidden" name="$name" value="$value"><input id="$id" type="checkbox" class="form-check-input" onclick="this.previousSibling.value=1-this.previousSibling.value" $checked>
				<label class="form-check-label" for="$id">$labelForCheckbox</label>
				$tip
			</div>
		</div>
		EOF;
	}

	/**
	 * Input: select
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array $args
	 * @return string Returns the markup.
	 */
	public static function formSelect( $args ) {

		$id = 'js'.$args['name'];
		if ( isset( $args['id'] ) ) {
			$id = $args['id'];
		}

		$class = 'custom-select';
		if ( isset( $args['class'] ) ) {
			$class = $class . ' ' . $args['class'];
		}

		$html = '<div class="form-group row">';

		if ( isset( $args['label'] ) ) {
			$html .= '<label for="'.$id . '" class="col-sm-2 col-form-label">' . $args['label'] . '</label>';
		}

		$html .= '<div class="col-sm-10">';
		$html .= '<select id="' . $id . '" name="' . $args['name'] . '" class="' . $class . '">';

		foreach ( $args['options'] as $key=>$value ) {
			$html .= '<option ' . ( ( $key==$args['selected'] ) ? 'selected' : '' ) . ' value="'.$key . '">'.$value . '</option>';
		}

		$html .= '</select>';
		if ( isset( $args['tip'] ) ) {
			$html .= '<small class="form-text text-muted">' . $args['tip'] . '</small>';
		}
		$html .= '</div></div>';

		return $html;
	}

	/**
	 * Input: select block
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array $args
	 * @return string Returns the markup.
	 */
	public static function formSelectBlock( $args ) {

		$id = 'js' . $args['name'];
		if ( isset( $args['id'] ) ) {
			$id = $args['id'];
		}

		$class = 'custom-select';
		if ( ! empty( $args['class'] ) ) {
			$class = $class . ' ' . $args['class'];
		}

		$html = '<div class="form-group m-0">';

		if ( ! empty( $args['label'] ) ) {
			$html .= '<label class="mt-4 mb-2 pb-2 border-bottom text-uppercase w-100" for="' . $id . '">' . $args['label'] . '</label>';
		}

		$html .= '<select id="' . $id . '" name="' . $args['name'] . '" class="' . $class . '">';

		if ( ! empty( $args['emptyOption'] ) ) {
			$html .= '<option value="">' . $args['emptyOption'] . '</option>';
		}

		foreach ( $args['options'] as $key=>$value ) {
			$html .= '<option ' . ( ( $key==$args['selected'] ) ? 'selected' : '') . ' value="' . $key.'">' . $value . '</option>';
		}
		$html .= '</select>';

		if ( ! empty( $args['tip'] ) ) {
			$html .= '<small class="form-text text-muted">' . $args['tip'] . '</small>';
		}
		$html .= '</div>';

		return $html;
	}

	/**
	 * Input: hidden
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array $args
	 * @return string Returns the markup.
	 */
	public static function formInputHidden( $args ) {
		return '<input type="hidden" id="js' . $args['name'] . '" name="' . $args['name'] . '" value="' . $args['value'] . '">';
	}

	/**
	 * Form alert
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array $args
	 * @return string Returns the markup.
	 */
	public static function alert( $args ) {

		$class = 'alert';
		if ( ! empty( $args['class'] ) ) {
			$class = $class . ' ' . $args['class'];
		}

		$text = $args['text'];

		return <<<EOF
		<div class="$class" role="alert">$text</div>
		EOF;
	}
}
