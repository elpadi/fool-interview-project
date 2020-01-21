<?php
namespace WordpressLib\Widgets;

use WordpressLib\Theme\Frontend;

abstract class Widget extends \WP_Widget {

	abstract protected function getFormFields($instance);

	public function register() {
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget($args, $instance) {
		Frontend::tpl('widgets/widget', $this->id_base, apply_filters('preprocess_widget_values', array_merge($args, $instance, ['widget' => $this])));
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form($instance) {
		$widget = $this;
		$fields = $this->getFormFields($instance);
		Frontend::tpl('widgets/form', $this->id_base, compact('widget','fields'));
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update($new_instance, $old_instance) {
		return $new_instance;
	}

	protected static function sanitizer($type) {
		switch ($type) {
		case 'textarea': return 'esc_textarea';
		}
		return 'esc_attr';
	}

	protected function formField($name, $instance, $type='text', $default='') {
		$value = empty($instance[$name]) ? $default : $instance[$name];
		return [
			'id' => $this->get_field_id($name),
			'name' => $this->get_field_name($name),
			'label' => ucwords(str_replace('_', ' ', $name)),
			'value' => call_user_func(self::sanitizer($type), $value),
			'type' => $type,
		];
	}

}
