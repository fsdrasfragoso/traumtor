<?php
namespace App\Libraries\Html;

use Spatie\Html\Elements\Input;
use Spatie\Html\Html as HtmlBuilder;

class Html extends HtmlBuilder {

    /**
     * @param string|null $type
     * @param string|null $name
     * @param string|null $value
     *
     * @return \Spatie\Html\Elements\Input
     */
    public function input($type = null, $name = null, $value = null)
    {
        $hasValue = $type != 'password' && $name && (! is_null($this->old($name, $value)) || ! is_null($value));

        return Input::create()
            ->attributeIf($type, 'type', $type)
            ->attributeIf($name, 'name', $this->fieldName($name))
            ->attributeIf($name, 'id', $this->fieldName($name))
            ->attributeIf($hasValue, 'value', $this->old($name, $value));
    }
}
