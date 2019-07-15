<?php
namespace app\helpers\builders;
use \app\helpers\builders\HtmlBuilder;
use app\models\forms\InputField;

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

//    public static function buildBeginForm($model) {
//        return self::buildOpeningTag('form', ['action' => $model->getAction(), 'method' => $model->getMethod()]);
//    }

	public static function buildEndForm() {
		return self::buildСlosingTag('form');
	}

    /**
     * @param InputField $input
     * @return string
     */
    public static function renderInput(InputField $input): string
    {
        $attributes = $input->getAttributes();
        $value = $input->getValue();
        if (!empty($value)) {
            $attributes['value'] = $value;
        }
        return self::buildInput($attributes);
    }

    public static function renderBlock(InputField $input): string
    {
        $block = self::buildLabel(['for' => $input->getName()], $input->getLabel());
        $block .= self::buildBr();
        $block .= self::renderInput($input);
        $block .= self::buildBr();
        $error = $input->getError();
        if (!empty($error)) {
            $block .= self::buildSpan([], $error);
        }
        return self::buildDiv([], $block);
    }

    public static function renderInputs($model)
    {
        $content = "";

        $inputs = $model->getInputs();
        foreach ($inputs as $input) {
            $content .= self::renderBlock($input);
        }
        return $content;
    }

    public static function renderButton($model)
    {
        return self::buildDiv([], self::buildInput([
            'name' => 'submit',
            'type' => $model->getType(),
            'value' => $model->getValue()
        ]));
    }

	public static function renderForm($model) {
		$content = self::renderInputs($model);
        $content .= self::renderButton($model);
		$form = self::buildForm(['action' => $model->getAction(), 'method' => $model->getMethod()], $content);
		return $form;
	}
}
