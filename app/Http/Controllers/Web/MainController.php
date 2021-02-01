<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Jobs\LogJob;
use Illuminate\Contracts\View\View;

/**
 * Class MainController
 *
 * @package App\Http\Controllers\Web
 */
class MainController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        LogJob::dispatch();
        LogJob::dispatch()->delay(now()->addSeconds(10));


        return view('welcome');
    }
}
