<?php

namespace App\Http\Controllers;

use App\Phone;
use App\System\Codes;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

class PhoneController extends Controller
{

    public function index()
    {
        return view('index')->with(
            [
                'codes' => Codes::$codes,
                'phones' => Phone::query()->paginate(40),
            ]
        );
    }

    public function phone()
    {
        $phone = Route::input('subdomain');
        return view('phone')->with(
            [
                'phone' => $phone
            ]
        );
    }

    public function search(Request $request)
    {
        $phone = preg_replace('/\D/', '', $request->get('phone'));
        $newUrl = "http://$phone." . env('APP_DOMAIN');
        return Redirect::away($newUrl);
    }

}
