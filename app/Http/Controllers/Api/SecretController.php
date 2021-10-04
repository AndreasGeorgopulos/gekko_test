<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SecretResource;
use App\Models\Secret;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SecretController extends Controller
{
    public function find(string $hash)
    {
        try {
            /* @var Secret $model */
            $model = Secret::findByHash($hash);

            /* Decrement remainingViews if secret never expires */
            if (!is_null($model->expiresAt)) {
                $model->remainingViews--;
                $model->save();
            }

            /* 200 OK, send secret resource */
            return response()->json(new SecretResource($model));

        } catch (\Exception $exception) {
            /*  Abort 404 if secret not found */
            return response()->json('Secret not found', 404);
        }
    }

    public function create(Request $request)
    {
        /* @var Validator $validator */
        $validator = Validator::make($request->input(), [
            'secret' => [
                'required',
                'min:10',
                'max:255',
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

        try {
            /*  Throw new exception if has validation fail */
            if ($validator->fails()) {
                throw new \Exception('Invalid input');
            }

            /* Create new secret */
            $model = Secret::factory()->create([
                'hash' => Secret::generateHash($request->input('secret')),
                'secretText' => $request->input('secret'),
                'remainingViews' => $request->input('expireAfterViews'),
                'expiresAt' => Secret::generateExpiredAt($request->input('expireAfter')),
            ]);

            /* 200 OK, send secret resource */
            return response()->json(new SecretResource($model));

        } catch (\Exception $exception) {
            /*  Abort 405 if has validation fail */
            return response()->json($exception->getMessage(), 405);
        }
    }
}
