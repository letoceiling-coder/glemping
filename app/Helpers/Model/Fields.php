<?php


namespace App\Helpers\Model;


use App\Http\Controllers\Api\v1\HelperTrait;
use App\Http\Controllers\Api\v1\UserController;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class Fields
{

    use HelperTrait;

    public array $names = [
        'image_id' => 'Фото',
        'images' => 'Файлы',
    ];
    public array $hidden = [
        'created_at',
        'updated_at',
        'id',
        'remember_token',
        'password'
    ];

    private string $table;
    /**
     * @var mixed
     */
    private $model;
    private array $fields;
    private array $foreign;

    public function __construct(string $table)
    {
        $this->table = $table;
        $this->model = $this->getModel($this->getModelName($table));
        $this->fields = Schema::getColumns($table);
        $this->foreign = $this->getForeign($this->table);
    }

    public function handler()
    {
        $arr = collect([]);

        foreach ($this->fields as $field) {
            if (!in_array($field['name'], $this->hidden)) {
                $t = null;
                if ($field['type_name'] == 'varchar') {
                    $t = [
                        'key' => $field['name'],
                        'type' => 'string',
                        'required' => $field['nullable'] == false,
                    ];
                }
                if ($field['type_name'] == 'text') {
                    $t = [
                        'key' => $field['name'],
                        'type' => 'text',
                        'required' => $field['nullable'] == false,
                    ];
                }
                if ($field['type_name'] == 'bigint' ) {

                    $t = [
                        'key' => $field['name'],
                        'required' => $field['nullable'] == false,
                    ];
                    foreach ($this->foreign as $foreign){
                        if (in_array($field['name'],$foreign['columns'])){
                            $t['fields'] = $this->fieldsModel($foreign['foreign_table']);
//                            $t['type'] = 'relations';
//                            $t['model'] = $this->getModelName($foreign['foreign_table']);
//                            $t['table'] = $foreign['foreign_table'];

                        }

                    }



                }
                if ($field['type_name'] == 'timestamp' && $field['name'] == 'date') {
                    $t =[
                        'key' => $field['name'],
                        'type' => 'date',
                        'required' => $field['nullable'] == false,
                    ];
                }
                if ($field['type_name'] == 'json' && $field['name'] == 'html') {
                    $t = [
                        'key' => $field['name'],
                        'type' => 'html',
                        'required' => $field['nullable'] == false,
                    ];
                }
                if ($field['type_name'] == 'json' && $field['name'] == 'images') {
                    $t = [
                        'key' => $field['name'],
                        'type' => 'images',
                        'required' => $field['nullable'] == false,
                    ];
                }

                if ($t){

                    if (array_key_exists($t['key'],$this->names)){

                        $t['name'] = $this->names[$t['key']];
                    }
                    $arr->push($t);
                }


            }
        }

return $arr;

    }

    public function getForeignIds($field){

        foreach ($this->foreign as $foreign){
            if (in_array($field['name'],$foreign['columns'])){

                return [
                    's' => $this->fieldsModel($foreign['foreign_table']),
                    'type' => 'relations',
                    "model" => $this->getModelName($foreign['foreign_table']),
                    "table" => $foreign['foreign_table'],
                ];
            }

        }
        return [];
    }
}
