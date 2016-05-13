<?php

namespace App\Http\Controllers;

use App\Phone;
use App\PhoneInfo;
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
                'phoneInfosCount' => 1000000 + rand(123456, 999999),
            ]
        );
    }

    public function phone($phoneNumber)
    {
        $phoneNumber = $phoneNumber ? $phoneNumber : Route::input('subdomain');
        /** @var Phone $phone */
        $phone = Phone::query()->where('number', $phoneNumber)->first();
        if (!$phone) {
            abort(404);
        }
        $phone->load('phoneInfos');
        return view('phone')->with(
            [
                'phoneNumber' => $phoneNumber,
                'phone' => $phone,
                'next' => $phone ? Phone::find($phone->id + 1) : null,
                'prev' => $phone ? Phone::find($phone->id - 1) : null,
            ]
        );
    }

    public function search(Request $request)
    {
        $phone = preg_replace('/\D/', '', $request->get('phone'));
        return Redirect::away(env('APP_URL') . '/' . $phone);
    }

}
