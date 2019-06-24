<?php
namespace app\helpers\builders;
use \app\helpers\builders\HtmlBuilder;

class FormBuilder extends HtmlBuilder {

	public static function buildLabel($attributes = [], $content = "") {
		return self::buildPairedTag('label', $attributes, $content);
	}

	public static function buildInput($attributes = [], $content = "") {
		return self::buildUnpairedTag('input', $attributes, $content);
	}

	public static function buildForm($attributes = [], $content = "") {
		return self::buildPairedTag('form', $attributes, $content);
	}

	public static function buildBeginForm($attributes = ['action' => '#', 'method' => 'post']) {
		return self::buildOpeningTag('form', $attributes);
	}

	public static function buildEndForm() {
		return self::buildСlosingTag('form');
	}

	public static function renderFormContent($model) {
		$content = '';
		$config = $model->getConfig();
		$labels = $model->getLabels();
		$errors = $model->getErrors();
		$values = $model->getFieldValues();
		foreach ($config['elements'] as $name => $attributes) {
			$block = self::buildLabel(['for' => $name], $labels[$name]);
			$block .= self::buildUnpairedTag('br');
			if (!empty($values[$name])) {
				$attributes['value'] = $values[$name];
			}
			$block .= self::buildInput(array_merge($attributes, ['name' => $name]));
			$block .= self::buildUnpairedTag('br');
			if (isset($errors[$name])) {
				$block .= self::buildSpan(['class' => 'error'], $errors[$name]);
			}
			$content .= self::buildDiv([], $block);
		}
		if (isset($config['submit'])) {
			$content .= self::buildDiv([], self::buildInput(array_merge($config['submit'], ['name' => 'submit'])));
		}
		return $content;
	}

	public static function renderForm($model, $attributes = ['action' => '#', 'method' => 'post']) {
		$content = self::renderFormContent($model);
		$form = self::buildForm($attributes, $content);
		return $form;
	}
}
