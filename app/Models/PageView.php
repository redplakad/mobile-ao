<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PageView extends Model
{
    public $timestamps = false;
    protected $table = 'page_view';

    protected $fillable = [
        'user_id',
        'route_name',
        'url',
        'ip_address',
        'viewed_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(AppUser::class, 'user_id', 'id');
    }

    public static function getRouteStats(string $routeName)
    {
        $views = self::where('route_name', $routeName)
            ->with('user') // fix this line
            ->get();

        $uniqueUsers = $views->pluck('user')->unique('id')->filter(fn($user) => $user && $user->photo);
        $avatars = $uniqueUsers->pluck('photo')->map(function ($base64) {
            return "data:image/jpeg;base64,{$base64}";
        });

        return [
            'totalHit' => $views->count(),
            'avatars' => $avatars
        ];
    }
}
