<?php

use App\Helpers\Data\ModelForm;

function addForm(string $field , string $name , string $type = 'string', bool $required = false, array $selects = [])
{
    return (new ModelForm($field,$name,$type,$required,$selects));
}

function modelForm(string $field , string $name , string $type = 'string', bool $required = false, array $selects = [])
{
    return (new ModelForm($field,$name,$type,$required,$selects))->send();
}


function modelFormSizeImage(string $field , string $name , string $type = 'string', string $size = '100x100', bool $required = false, array $selects = [])
{
    return (new ModelForm($field,$name,$type,$required,$selects))->size($size)->send();
    return (new ModelForm($field,$name,$type,$required,$selects))->send(true,$size);
}

function modelFormSizeImageHide(string $field , string $name , string $type = 'string', string $size = '100x100', bool $required = false, array $selects = [])
{
    return (new ModelForm($field,$name,$type,$required,$selects))->hide()->size($size)->send();
    return (new ModelForm($field,$name,$type,$required,$selects))->send(false,$size);
}
function modelFormHide(string $field , string $name , string $type = 'string', bool $required = false, array $selects = [])
{
    return (new ModelForm($field,$name,$type,$required,$selects))->hide()->send();
    return (new ModelForm($field,$name,$type,$required,$selects))->send(false);
}

function isBoolean($booleable) {
    return filter_var($booleable, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
}

function ex_apiCurrency()
{
    try {
        $xml = simplexml_load_file('http://www.cbr.ru/scripts/XML_daily.asp?date_req=' . date('d/m/Y'));
    }catch (Exception $exception){

    }
    return $xml;
}
