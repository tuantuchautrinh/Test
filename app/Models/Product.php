<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // #Eloquent ORM - Getting Started #Defining Models #Eloquent Model Conventions - Table Names
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product';

    // #Eloquent ORM - Getting Started #Defining Models #Inserting & Updating Models #Mass Assignment
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // fillable bao gồm các cột được phép tương tác đến
    protected $fillable = ['id', 'name', 'price', 'image', 'intro', 'content', 'status', 'created_at', 'updated_at'];
}
