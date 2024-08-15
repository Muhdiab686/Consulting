<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Consulting;
use App\Models\User;
use App\Models\Expert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class AppointmentController extends BaseController
{
    public function bookAnAppointment(Request $request){
       $validate = Validator::make ($request->all() ,[
            'data' => 'required',
            'time' => 'bail|required|date_format:H:i',
            'expert_id'=>'required|integer',
            'totalprice' => 'bail|required|integer',
        ]);
        if ($validate->fails())
        {
            return $this->sendError('Please validate error',$validate->errors()->toArray());
        }

        $user = Auth()->user()->id;

        //dd($exp);
        $expert = Consulting::where('user_id', $request->expert_id)->first();

        if(($expert['start_time'] > $request->time || $expert['end_time'] < $request->time)){
             return $this->senderrors('this expert is not available in these times');
        }
        $host = User::find($request->expert_id);
        $visiter =  User::find($user);
        if($visiter['blance'] - $request->totalprice < 0){
             return $this->senderrors('you do not have enough money, please visit one of our centers!');
        }
        $host['blance'] += $request->totalprice;
        $host->save();
        $visiter['blance'] -= $request->totalprice;
        $visiter->save();

       $aa = Appointment::create([
            'data' => $request->data,
            'time' => $request->time,
            'expert_id' => $request->expert_id,
            'user_id' => $user,
            'totalprice' => $request->totalprice,
        ]);
        return $this->sendResponse2($aa,'the appointment has been successfully booked!');
    }

    public function getAppointments(Request $request){
        $id = $request->query('id');
        $host = Appointment::where('expert_id', $id)->with('user');
            return response()->json([
            'data' => $host->get(),
        ]);
    }
}
