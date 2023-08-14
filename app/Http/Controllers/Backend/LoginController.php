<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    static $view = 'backend.auth';

    public function __construct(
        private readonly \App\Service\HttpService $httpService,
    ) {
    }

    public function index(Request $request)
    {
        return view(self::$view.'.login');
    }
}
