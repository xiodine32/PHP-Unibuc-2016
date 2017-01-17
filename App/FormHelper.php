<?php
/**
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/15/2017
 * Time: 12:52 AM
 */

namespace App;


class FormHelper
{
    public static function start($action, $method, $title, $optionals = [])
    {
        self::assure($optionals, 'action', $action);
        self::assure($optionals, 'method', $method);

        if (!empty($title))
            self::assure($optionals, 'class', 'form-horizontal');

        $text = "<form " . self::aToM($optionals) . ">\n";
        if (!empty($title)) {
            $text .= "<fieldset>\n";
            $text .= "<legend>{$title}</legend>\n";
        }
        return $text;
    }

    private static function assure(&$optionals, $type, $class)
    {
        if (empty($optionals[$type]))
            $optionals[$type] = [$class];
    }

    private static function aToM($optionals)
    {
        $returns = [];
        foreach ($optionals as $key => $value) {

            if (is_array($value))
                $value = join(" ", $value);

            // required => true becomes required="required"
            if (!!$value === $value)
                $value = $key;

            $returns[] = "$key=\"$value\"";
        }
        return join(" ", $returns);
    }

    public static function end()
    {
        $text = "</fieldset>\n";
        $text .= "</form>\n";

        return $text;
    }

    public static function input($type, $id, $name, $title, $optionals = [])
    {
        self::assure($optionals, 'type', $type);
        self::assure($optionals, 'id', $id);
        self::assure($optionals, 'name', $name);
        self::assure($optionals, 'class', 'form-control');
        self::assure($optionals, 'placeholder', $title);

        $text = "<div class=\"form-group\">\n";
        $text .= "<label class=\"col-sm-4 control-label\" for=\"{$id}\">{$title}:</label>";
        $text .= "<div class=\"col-sm-4\">\n";
        $text .= "<input " . self::aToM($optionals) . ">";
        $text .= "</div>\n";
        $text .= "</div>\n";

        return $text;
    }

    public static function submit($title, $optionals = [])
    {
        self::assure($optionals, 'type', 'submit');
        self::assure($optionals, 'class', 'btn btn-lg btn-default');

        $text = "<div class=\"form-group\">\n";
        $text .= "<div class=\"col-sm-4 col-sm-offset-4\">\n";
        $text .= "<button " . self::aToM($optionals) . ">{$title}</button>";
        $text .= "</div>\n";
        $text .= "</div>\n";

        return $text;
    }
}