<?php

namespace App\Http\Controllers;

use App\LogActivity;
use Illuminate\Http\Request;

class LogActivityController extends Controller
{


    public function index()
    {
        $logs = LogActivity::all();
        return response()->json([
            'logs' => $logs
        ]);
    }

    public function store(Request $request, $data)
    {
        LogActivity::create([
            'title' => $data['title'],
            'details' => $data['details'],
            'action' => $data['action'],
            'method' => $data['method'],
            'table' => $data['table'],
            'user' => $data['user'],
            'url' => $request->url,
            'ip' => $request->ip,
            'agent' => $request->userAgent
        ]);
    }

    public function destroy($id)
    {
        $logActivity = LogActivity::findOrFail($id);
        $logActivity->delete();
    }
}
