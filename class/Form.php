<?php
class Form {

    public static $class = "form-control";

    public static function checkbox (string $name, string $value = null, array $data = []): string
    {
        $attributes = '';
        if (isset($data[$name]) && in_array($value, $data[$name])) {
            $attributes .= 'checked';
        }
        $attributes = ' class="' . self::$class . '"'; // appel propriété static
        return <<<HTMl
        <input type="checkbox" name="{$name}[]" value="$value" $attributes>
HTMl; 
    }

    public static function radio (string $name, string $value, array $data): string
    {
        $attributes = '';
        if (isset($data[$name]) && $value === $data[$name]) {
            $attributes .= 'checked';
        }
        
        return <<<HTMl
        <input type="radio" name="{$name}" value="$value" $attributes>
HTMl; 
    }

    public static function select (string $name, $value, array $options): string
    {
        $html_options = [];
        foreach ($options as $k => $option) {
            $attributes = $k == $value ? ' selected' : '';
            $html_options[] = "<option value='$k' $attributes>$option</option>";
        }

        return "<select class='form-control' name='$name'>" . implode($html_options) . "</select>";
    }

}