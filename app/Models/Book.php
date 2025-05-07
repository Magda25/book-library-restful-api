<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function author() {

        return $this->belongsTo(Author::class);
    }

    protected $fillable = ['title', 'isbn', 'cover_url', 'author_id'];

}
