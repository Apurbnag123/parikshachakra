<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class ClassResource extends Model
{
    use HasFactory;

    public const TYPE_VIDEO = 'video';
    public const TYPE_NOTE = 'note';

    protected $fillable = [
        'type',
        'title',
        'body',
        'url',
        'file_path',
        'mime_type',
        'is_published',
        'published_at',
        'batch_id',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    public function batch(): BelongsTo
    {
        return $this->belongsTo(Batch::class);
    }

    public function isVideo(): bool
    {
        return ($this->type ?? '') === self::TYPE_VIDEO;
    }

    public function isNote(): bool
    {
        return ($this->type ?? '') === self::TYPE_NOTE;
    }

    public function fileUrl(): ?string
    {
        if (! $this->file_path) {
            return null;
        }

        return asset('storage/' . $this->file_path);
    }

    public function embedUrl(): ?string
    {
        if (! $this->url) {
            return null;
        }

        $url = (string) $this->url;

        // YouTube watch URL -> embed URL
        if (Str::contains($url, 'youtube.com/watch')) {
            parse_str((string) parse_url($url, PHP_URL_QUERY), $query);
            if (! empty($query['v'])) {
                return 'https://www.youtube.com/embed/' . $query['v'];
            }
        }

        // youtu.be/<id> -> embed URL
        if (Str::contains($url, 'youtu.be/')) {
            $id = trim((string) Str::after($url, 'youtu.be/'));
            $id = trim($id, "/ \t\n\r\0\x0B");
            if ($id !== '') {
                return 'https://www.youtube.com/embed/' . $id;
            }
        }

        return $url;
    }
}

