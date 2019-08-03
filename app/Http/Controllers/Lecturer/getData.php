<?php

namespace App\Http\Controllers\Lecturer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Resource;
use App\Schedule;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\lectgetData;

class getData extends Controller
{
    public function index(lectgetData $request){

        $floornumber=$request->floornumber;
        $roomnumber=$request->roomnumber;
        $resource=Resource::where('floor_number',$floornumber,'and')
                            ->where('room_no',$roomnumber)->first();

        if($resource){
            $result=Schedule::where('lecturer_id',$request->lecturerid,'and')
                            ->where('resource_id',$resource->id)->first();
            return $result;

        }else{
                return response()->json(['Message'=>'No data found']);;
        }
     

    }
}
