<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSecretRequest;
use App\Http\Resources\SecretResource;
use App\Models\Secret;
use App\Rules\HashRule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SecretController extends Controller
{
    public function find(string $hash)
    {
        /* @var Secret $model */
        $model = Secret::where(function ($q) use($hash) {
            $q->where('hash', $hash);
            $q->where(function ($q) {
                $q->where('expiresAt', '>', Carbon::now()->format('Y-m-d H:i:s'));
                $q->orWhereNull('expiresAt');
            });
            $q->where('remainingViews', '>', 0);
        })->first();

        if (!$model) {
            return response()->json('Secret not found', 404);
        }

        $model->remainingViews--;
        $model->save();

        return response()->json(new SecretResource($model));
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->input(), [
            'hash' => [
                'required',
                'min:10',
                'max:255',
                'unique:secrets',
                new HashRule($request->get('hash')),
            ],
            'expireAfterViews' => [
                'required',
                'integer',
                'gt:0',
            ],
            'expireAfter' => [
                'required',
                'integer',
                'min:0',
            ],
        ]);
        if ($validator->fails()) {
            return response()->json('Invalid input', 405);
        }

        $model = Secret::factory()->create([
            'hash' => sha1($request->input('hash')),
            'remainingViews' => $request->input('expireAfterViews'),
            'expiresAt' => $request->input('expireAfter') > 0 ? Carbon::now()->addMinutes($request->input('expireAfter'))->format('Y-m-d H:i:s') : null,
        ]);

        return response()->json(new SecretResource($model));
    }
}
