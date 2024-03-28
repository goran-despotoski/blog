<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tiptap\Editor;

/**
 * @property int $user_id
 * @property string $title
 * @property string $content
 * @property Carbon $published_at
 * @property string $status
 */
class Post extends Model
{
    use HasFactory;

    protected $casts = [
        'published_at' => 'datetime:d-m-Y',
    ];

    protected $appends = [
        'published_at_date',
        'published_at_time',
        'published_at_readable',
        'published_at_date_readable',
        'content_html',
        'content_simple_text',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getPublishedAtDateAttribute()
    {
        return $this->published_at->format('Y-m-d');
    }

    public function getPublishedAtTimeAttribute()
    {
        return $this->published_at->format('H:i:s');
    }

    public function getPublishedAtReadableAttribute()
    {
        return $this->published_at->format('Y-m-d H:i:s');
    }

    public function getPublishedAtDateReadableAttribute()
    {
        return $this->published_at->format('F d, Y');
    }

    public function getContentHtmlAttribute()
    {
        return (new Editor)->setContent($this->content)->getHTML();
    }

    public function getContentSimpleTextAttribute()
    {
        return (new Editor)->setContent($this->content)->getText();
    }

    public function scopePublished(Builder $query)
    {
        $query->where('published_at', '<', Carbon::now()->toDateTimeString())
            ->where('status', 'published');
    }


}
