<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class Book
 * @package App\Models
 *
 * @property int id
 * @property string isbn
 * @property string title
 * @property string cover_large
 *
 * @property Collection $authors
 */
class Book extends Model
{
}
