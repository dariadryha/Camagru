<?php
namespace app\helpers\builders;

class FormBuilder extends HtmlBuilder
{
    public static function buildLabel($attributes = [], $content = "") {
		return self::buildPairedTag('label', $attributes, $content);
	}

	public static function buildInput($attributes = []) {
		return self::buildUnpairedTag('input', $attributes);
	}

	public static function buildForm($attributes = [], $content = "") {
		return self::buildPairedTag('form', $attributes, $content);
	}

	public static function buildBeginForm($attributes = ['action' => '#', 'method' => 'post']) {
		return self::buildOpeningTag('form', $attributes);
	}

	public static function buildEndForm() {
		return self::buildClosingTag('form');
	}
}
