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

    public static function renderFormContent($config, $model) {
	    $content = "";
	    $inputs = $model->getInputs();
	   // var_dump($config);
        foreach ($config['inputs'] as $name => $fieldConfig) {
            $block = self::buildLabel(['for' => $name], $inputs[$name]->getLabel());
            $block .= self::buildUnpairedTag('br');
            $value = $inputs[$name]->getValue();
            if (!empty($value)) {
                $fieldConfig['attributes']['value'] = $value;
            }
            $block .= self::buildInput($fieldConfig['attributes']);
            $block .= self::buildUnpairedTag('br');
//            if (is_null($inputs[$name]->getError()))
//                echo "true";
            $block .= self::buildPairedTag('span', [], $inputs[$name]->getError());
            $content .= self::buildDiv([], $block);
            //break ;
        }
        if (isset($config['submit'])) {
			$content .= self::buildDiv([], self::buildInput(array_merge($config['submit'], ['name' => 'submit'])));
		}
        return $content;
    }

	public static function renderForm($config, $model) {
		$content = self::renderFormContent($config, $model);
		$form = self::buildForm(['action' => $model->getAction(), 'method' => $model->getMethod()], $content);
		return $form;
	}
}
