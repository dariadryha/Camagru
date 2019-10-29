<?php
namespace app\helpers\builders;

class HtmlBuilder
{
	public static function buildUnpairedTag(string $tag, array $attributes = []): string
    {
		$attributes = !empty($attributes) ? self::buildAttributes($attributes) : "";
		return "<$tag $attributes>";
	}

	public static function buildOpeningTag($tag, $attributes = [])
    {
		return self::buildUnpairedTag($tag, $attributes);
	}

	public static function buildClosingTag($tag) {
		return "</$tag>";
	}

	public static function buildPairedTag($tag, $attributes = [], $content = "") {
		return self::buildOpeningTag($tag, $attributes).$content.self::buildClosingTag($tag);
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

	public static function buildButton($attributes = [], $content = "")
    {
        return self::buildPairedTag('button', $attributes, $content);
    }

    public static function buildH(int $level, array $attributes = [], string $content = '')
    {
        return self::buildPairedTag("h{$level}", $attributes, $content);
    }

    /**
     * @param string $content
     * @param array $attributes
     * @return string
     */
    public static function buildA(string $content = '', array $attributes = []): string
    {
        return self::buildPairedTag('a', $attributes, $content);
    }

    /**
     * @param array $attributes
     * @return string
     */
	public static function buildAttributes(array $attributes): string
    {
		$config = '';

		foreach ($attributes as $attribute => $values) {
			if (is_array($values))
				$values = implode(" ", $values);
			$config .= "$attribute='$values' ";
		}
		return trim($config);
	}
}