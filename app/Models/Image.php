<?php

namespace App\Models;


use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
class Image extends Model
{
    use Filterable;
    protected $guarded = false;
    public $timestamps = false;

    protected $appends = [
        'webp','src','video','original'
    ];

    protected $with = ['folder'];

    public function getVideo(): ?string
    {
        if ($this->preview_id){
            return "/videos/".$this->path. "." .$this->extension;
        }
        return null;
    }
    public function video(): Attribute
    {
        return Attribute::make(

            get: fn() => $this->getVideo(),
        );
    }
    public function webp(): Attribute
    {
        return Attribute::make(

            get: fn() => "/uploads/webp/" . $this->width . "x" . $this->height . "/".$this->path.".webp",
        );
    }
    public function original(): Attribute
    {
        return Attribute::make(

            get: fn() => "/uploads/original/" . $this->width . "x" . $this->height . "/".$this->path.".webp",
        );
    }
    public function src(): Attribute
    {
        return Attribute::make(

            get: fn() =>  "/" .$this->disk  . $this->path. "." .$this->extension,
        );
    }



    public function folder(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Folder::class,'id','folder_id');
    }
}
