<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Rel_books_with_authors
 * @package App\Models
 *
 * @property int id
 * @property int book_id
 * @property int author_id
 *
 */
class Rel_books_with_authors extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function book_with_authors()
    {
        return $this->belongsTo();
    }
}
