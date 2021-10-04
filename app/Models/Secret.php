<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secret extends Model
{
    use HasFactory;

    /**
     * @param string $secretText
     * @return string
     */
    public static function generateHash(string $secretText): string
    {
        return sha1($secretText . time());
    }

    /**
     * @param int $minutes
     * @return string|null
     */
    public static function generateExpiredAt(int $minutes): ?string
    {
        return $minutes > 0 ? Carbon::now()->addMinutes($minutes)->format('Y-m-d H:i:s') : null;
    }

    /**
     * @param string $hash
     * @return static
     */
    public static function findByHash(string $hash): ?static
    {
        return static::where(function ($q) use($hash) {
            $q->where('hash', $hash);
            $q->where(function ($q) {
                $q->where(function ($q) {
                    $q->where('expiresAt', '>', Carbon::now()->format('Y-m-d H:i:s'));
                    $q->where('remainingViews', '>', 0);
                });
                $q->orWhereNull('expiresAt');
            });
        })->firstOrFail();
    }
}
