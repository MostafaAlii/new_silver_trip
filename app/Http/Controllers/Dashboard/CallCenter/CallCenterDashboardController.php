<?php
namespace App\Http\Controllers\Dashboard\CallCenter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Callcenter;
class CallCenterDashboardController extends Controller {
    public function index() {
        
        // $CallCenter = Callcenter::findorfail(auth('call-center')->id());
        // dd($CallCenter);
        // if(){
            
        // }
        
        return view('dashboard.call-center.dashboard',['title' => 'Call-Center Dashboard']);
    }
}