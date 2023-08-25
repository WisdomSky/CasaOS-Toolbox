<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppHide extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "apphide";

    protected $fillable = ['app_id', 'hide'];

}
