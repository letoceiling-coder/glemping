<?php


namespace App\Helpers\Data;


class ModelForm
{


    private string $field;
    private string $name;
    private string $type;
    private bool $required;
    private array $selects;
    /**
     * @var false|string[]
     */
    private string|null $size = null;
    private int $sort = 1000;
    /**
     * @var false
     */
    private bool $hide = true;
    private mixed $value ;
    private int $files = 1;
    private int $defailtValue = 0;


    public function __construct(string $field, string $name, string $type = 'string', bool $required = false, array $selects = [])

    {
        $this->field = $field;
        $this->name = $name;
        $this->type = $type;
        $this->required = $required;
        $this->selects = $selects;
        $this->value = '';



    }

    public function selects(array $select, int $default = 0){
        $this->selects = $select;
        $this->type = 'select';
        $this->value = $default;
        return $this;
    }

    public function array(){
        $this->value = [];
        return $this;
    }


    public function deleted()
    {
        $this->type = 'deleted';
        return $this;
    }
    public function active()
    {
        $this->type = 'active';
        $this->value = true;
        return $this;
    }
    public function video()
    {
        $this->type = 'video';
        return $this;
    }
    public function rating()
    {
        $this->type = 'rating';
        $this->value = 0;
        return $this;
    }
    public function confirmed()
    {
        $this->type = 'confirmed';
        $this->value = false;

        return $this;
    }
    public function text()
    {
        $this->type = 'text';
        return $this;
    }
    public function date()
    {
        $this->type = 'date';
        $this->value = now();
        return $this;
    }
    public function integer()
    {
        $this->type = 'integer';
        return $this;
    }
    public function image()
    {
        $this->type = 'image';
        return $this;
    }
    public function images($files = null)
    {
        $this->type = 'images';
        $this->value = [];
        if ($files){
            $this->files = $files;
        }
        return $this;
    }
    public function value($value)
    {
        $this->value = $value;
        return $this;
    }

    public function files(int $files)
    {
        $this->files = $files;
        return $this;
    }

    public function sort(int $sort)
    {
        $this->sort = $sort;
        return $this;
    }

    public function hide()
    {
        $this->hide = false;
        return $this;
    }

    public function size(string $size)
    {
        $this->size = $size;
        return $this;
    }

    public function send()
    {

        $response = [
            'field' => $this->field,
            'name' => $this->name,
            'type' => $this->type,
            'required' => $this->required,
            'value' => $this->value,
            'files' => $this->files,

        ];
        if (!empty($this->selects)) {
            $response['selects'] = $this->selects;
            $response['value'] = $this->defailtValue;

        }
        if ($this->size) {
            $response['size'] = $this->size;

        }
        $response['sort'] = $this->sort;
        $response['view'] = $this->hide;

        return $response;
    }


}
