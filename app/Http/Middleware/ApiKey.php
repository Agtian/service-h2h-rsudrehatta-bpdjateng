<?php

namespace App\Http\Middleware;

use App\Models\ApiKey as ModelsApiKey;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $event_dd = [
            'api_key_id'    => 0,
            'api_address'   => $request->header('host'),
            'url'           => $request->url(),
            'user_agent'    => json_encode($request->header('user_agent')),
        ];
        $event_id   = DB::table('api_event_histories')->insertGetId($event_dd);
        $keys       = DB::table('api_keys')->select('id', 'key')->get();

        $result = false;
        foreach ($keys as $item) {
            if ($item->key == $request->header('api_key')) {
                DB::table('api_event_histories')->where('id', $event_id)->update(['api_key_id' => $item->id]);
                $result = true;
                break;
            }
        }

        if ($result) {
            return $next($request);
        } else {
            $data = [
                'status'    => 400,
                'message'   => 'Protect Unauhorized!',
            ];
            return response()->json($data);
        }
    }
}
