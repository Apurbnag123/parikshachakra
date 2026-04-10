<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LiveClass extends Model
{
    use HasFactory;

    public const PROVIDER_EXTERNAL = 'external';
    public const PROVIDER_JITSI = 'jitsi';

    protected $fillable = [
        'title',
        'meeting_url',
        'meeting_provider',
        'meeting_room',
        'starts_at',
        'ends_at',
        'is_published',
        'batch_id',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'starts_at' => 'datetime',
            'ends_at' => 'datetime',
            'is_published' => 'boolean',
        ];
    }

    public function meetingJoinUrl(): string
    {
        if (($this->meeting_provider ?? self::PROVIDER_EXTERNAL) === self::PROVIDER_JITSI && $this->meeting_room) {
            $domain = config('live_classes.jitsi_domain', 'meet.jit.si');

            return 'https://' . $domain . '/' . $this->meeting_room;
        }

        return (string) $this->meeting_url;
    }

    public function batch(): BelongsTo
    {
        return $this->belongsTo(Batch::class);
    }
}
