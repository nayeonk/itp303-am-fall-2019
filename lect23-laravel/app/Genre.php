<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
	// This represents the table genres in our DB
	protected $table = 'genres';
	protected $primaryKey = 'genre_id';
}

?>