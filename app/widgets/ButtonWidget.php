<?php
namespace app\widgets;

class ButtonWidget
{
    /**
     * @param string $type
     * @param string $content
     */
    private static function button(string $type, string $content)
    {
        require PATH_WIDGETS_VIEWS . 'forms/button.php';
    }

    /**
     * @param string $content
     */
    public static function submit(string $content)
    {
        self::button('submit', $content);
    }
}