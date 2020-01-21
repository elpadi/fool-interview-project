<?php
namespace WordpressLib\Plugins;

abstract class Plugin {

	protected static $_instance;

	public static function instance() {
		if (!isset(static::$_instance)) {
			static::$_instance = new static();
		}
		return static::$_instance;
	}

	public function __construct() {
		add_action('init', [$this, 'init']);
	}

	public function init() {
	}

	public function onActivation() {
	}

	public function onDeactivation() {
	}

	public function __get($name) {
		return isset($this->$name) ? $this->$name : NULL;
	}

}
