<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{

    public function getUrl($id){
        $url='/printPvs/'.$id;
        QrCode::size(500)
            ->format('png')
            ->generate('pv.com', public_path($url));

        return view('qr-code');
    }
}
