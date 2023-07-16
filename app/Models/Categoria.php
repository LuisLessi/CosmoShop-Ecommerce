<?php

namespace App\Models;

use App\Models\RModel;

class Categoria extends RModel
{
    protected $table = "categorias";
    protected $fillable = ['categoria'];
}

