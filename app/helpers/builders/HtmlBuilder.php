<?php
namespace app\helpers\builders;

class HtmlBuilder {
	protected function __construct() {}


	public static function buildUnpairedTag($tag, $attributes = []) {
		$attributes = !empty($attributes) ? self::buildAttributes($attributes) : "";
		return "<$tag $attributes>";
	}

	public static function buildOpeningTag($tag, $attributes = []) {
		return self::buildUnpairedTag($tag, $attributes);
	}

	public static function buildСlosingTag($tag) {
		return "</$tag>";
	}

	public static function buildPairedTag($tag, $attributes = [], $content = "") {
		return self::buildOpeningTag($tag, $attributes).$content.self::buildСlosingTag($tag);
	}

	public static function buildDiv($attributes = [], $content = "") {
		return self::buildPairedTag('div', $attributes, $content);
	}

	public static function buildP($attributes = [], $content = "") {
		return self::buildPairedTag('p', $attributes, $content);
	}

	public static function buildSpan($attributes = [], $content = "") {
		return self::buildPairedTag('span', $attributes, $content);
	}
	
	public static function buildAttributes($attributes) {
		$config = '';
		foreach ($attributes as $attribute => $values) {
			if (is_array($values))
				$values = implode(" ", $values);
			$config .= "$attribute=$values ";
		}
		return trim($config);
	}
}