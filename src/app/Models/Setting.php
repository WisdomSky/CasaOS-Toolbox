<?php

namespace App\Models;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JsonSerializable;

class Setting extends Model implements Arrayable, JsonSerializable
{
    use HasFactory;

    protected $table = 'settings';

    protected $fillable = ['name', 'type', 'value'];

    public $timestamps = false;

    protected function value(): Attribute
    {
        return Attribute::make(
            get: function($value) {
                    $_value = $value;
                    settype($_value, $this->type);
                    return $_value;
                },
            set: function ($value) {
                    $this->type = gettype($value);
                    return strval($value);
                }
        );
    }

    public function jsonSerialize(): mixed
    {
        return [
            "name" => $this->name,
            "value" => $this->value
        ];
    }

}
