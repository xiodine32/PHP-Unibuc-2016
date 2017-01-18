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

            if ($value === null)
                continue;
            if (is_array($value)) {
                if (count($value) === 0)
                    continue;
                if ($value[0] === null)
                    continue;
            }

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
        if ($type === "textarea")
            return self::textarea($id, $name, $title, $optionals);
        if ($type === "select")
            return self::select($id, $name, $title, $optionals);

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

    private static function textarea($id, $name, $title, $optionals = [])
    {
        $content = "";
        if (!empty($optionals['value'])) {
            $content = $optionals['value'];
            unset($optionals['value']);
        }
        self::assure($optionals, 'id', $id);
        self::assure($optionals, 'name', $name);
        self::assure($optionals, 'class', 'form-control');
        self::assure($optionals, 'placeholder', $title);

        $text = "<div class=\"form-group\">\n";
        $text .= "<label class=\"col-sm-4 control-label\" for=\"{$id}\">{$title}:</label>";
        $text .= "<div class=\"col-sm-4\">\n";
        $text .= "<textarea " . self::aToM($optionals) . ">{$content}</textarea>";
        $text .= "</div>\n";
        $text .= "</div>\n";
        return $text;

    }

    private static function select($id, $name, $title, $optionals = [])
    {
        $content = "<option value=''>--- Select ---</option>\"";
        if (!empty($optionals['value'])) {
            foreach ($optionals['value'] as $key => $value) {

                $content .= "<option value='{$key}'>{$value}</option>";
            }
            unset($optionals['value']);
        }
        self::assure($optionals, 'id', $id);
        self::assure($optionals, 'name', $name);
        self::assure($optionals, 'class', 'form-control');
        self::assure($optionals, 'placeholder', $title);

        $text = "<div class=\"form-group\">\n";
        $text .= "<label class=\"col-sm-4 control-label\" for=\"{$id}\">{$title}:</label>";
        $text .= "<div class=\"col-sm-4\">\n";
        $text .= "<select " . self::aToM($optionals) . ">{$content}</select>";
        $text .= "</div>\n";
        $text .= "</div>\n";
        return $text;

    }

    public static function submit($title, $optionals = [])
    {
        $id = mt_rand() . mt_rand() . mt_rand();
        self::assure($optionals, 'type', 'submit');
        self::assure($optionals, 'id', $id);
        self::assure($optionals, 'class', 'btn btn-lg btn-default');

        $text = "<div class=\"form-group\">\n";
        if (!empty($optionals['label']))
            $text .= "<label class=\"col-sm-4 control-label\" for=\"{$id}\">{$optionals['label']}:</label>";
        $text .= "<div class=\"col-sm-4 " . (empty($optionals['label']) ? 'col-sm-offset-4' : '') . "\">\n";
        $text .= "<button " . self::aToM($optionals) . ">{$title}</button>";
        $text .= "</div>\n";
        $text .= "</div>\n";

        return $text;
    }
}