<?php

namespace App\Http\Controllers\Notifyy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Notifyy extends Controller
{
    public function GetNotif(Request $request){
        $res = DB::table('notify')->select('*')->where([['status_notif','=','0'],['created_by','!=',auth()->check() ? auth()->user()->id : 1]])->orderBy('id_notif','DESC')->limit(10)->get();
        $notif = '';
        $notif .= '<a class="nav-link nav-link-label" data-toggle="dropdown"><i class="ficon bx bx-bell bx-tada bx-flip-horizontal"></i>
                    <span class="badge badge-pill badge-danger badge-up" id="TotalCountPush" data_CountPush="'.$res->count().'">'.$res->count().'</span>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                    <li class="dropdown-menu-header">
                      <div class="dropdown-header px-1 py-75 d-flex justify-content-between"><span class="notification-title">'.$res->count().' new Notification</span><span class="text-bold-400 cursor-pointer">Mark all as read</span></div>
                    </li>
                    <li class="scrollable-container media-list" id="mylistNotify">';
                    foreach ($res as $key => $value) {

        $notif .=   '<div class="media d-flex align-items-center">
                        <div class="media-left pr-0">
                          <div class="avatar bg-primary bg-lighten-5 mr-1 m-0 p-25"><span class="avatar-content text-primary font-medium-2">NEW</span></div>
                        </div>
                        <div class="media-body">
                          <h6 class="media-heading"><span class="text-bold-500">'.$value->type_notif.'</span> '.$value->name_notif.'</h6><small class="notification-text">at '.$value->created_at_notif.'</small>
                        </div>
                      </div>';

                    }

        $notif .=   '</li>
                    <li class="dropdown-menu-footer"><a class="dropdown-item p-50 text-primary justify-content-center" href="javascript:void(0)">Read all notifications</a></li>
                  </ul>';

        return response()->json(['code' => '1' , 'notifyy' => $notif]);
    }
}
