<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /*
    |--------------------------------------------------------------------------
    | Protected Variables
    |--------------------------------------------------------------------------
    */

    protected $table = 'products';

    protected $fillable = [
        'name',
        'phot',

        'description',
    ];

    protected $hidden = [
    ];

    /*
    |--------------------------------------------------------------------------
    | Public Const Variables
    |--------------------------------------------------------------------------
    */

    public const PHOTO_PATH = 'products';

    public const PHOTO_MAX_SIZE = 5000;

    public const ATTRIBUTE_LIMIT = [
        'name' => [
            'min' => 1,
            'max' => 255,
        ],
        'phot' => [
            'min' => 1,
            'max' => 255,
        ],
        'description' => [
            'min' => 0,
            'max' => 1000,
        ],
    ];
}
