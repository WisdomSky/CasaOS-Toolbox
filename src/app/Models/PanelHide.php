<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanelHide extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "panelhide";

    protected $fillable = ['name', 'visible'];

}
