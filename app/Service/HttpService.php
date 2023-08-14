<?php

namespace App\Service;

use Exception;
use Log;

class HttpService {

    public function error(Exception $e) {
        Log::error($e);
        return response()->json(['message' => $e->getMessage()], 422);
    }
}
