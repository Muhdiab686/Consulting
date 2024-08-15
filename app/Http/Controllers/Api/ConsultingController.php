<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Api\BaseController;
use App\Models\Consulting;
use App\Models\Typcons;
use App\Models\User;
use App\Models\Typeconsulting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ConsultingController extends BaseController
{
    public function createConsulting(Request $request)
    {
        //vlidator
        $validate = Validator::make (   $request->all(),
        [
            'name'=>'required',
            'photo'=>'required|image',
            'skills'=>'required',
            'posishion'=>'required',
            'start_time'=>'required',
            'end_time'=>'required',
            'Daysspace'=>'required',
            'phone'=>'required',
            'category'=>'required',
            'price'=>'required'
        ]);
        if ($validate->fails())
        {
            return $this->sendError('Please validate error',$validate->errors()->toArray());
        }
        $photo = $request->photo;
        $newphoto=time().$photo->getClientOriginalName();
        $photo->move(public_path('upload'),$newphoto);
        $path = "public/upload/$newphoto";
        $user = $request->user()->id;
        $consulting = new Consulting();
        $consulting->name=$request->name;
        $consulting->photo=$path;
        $consulting->skills=$request->skills;
        $consulting->posishion=$request->posishion;
        $consulting->start_time=$request->start_time;
        $consulting->end_time=$request->end_time;
        $consulting->Daysspace=$request->Daysspace;
        $consulting->phone=$request->phone;
        $consulting->category=$request->category;
        $consulting->price = $request->price;
        $consulting->user_id=$user;
        $consulting->save();

        $type = DB::table('typeconsultings')->get();
        foreach($type as $t){
            if($t->name==$request->category)
            {
                $ii= $t->id;
            }
        }
        $typcon = new Typcons();
        $typcon->user_id = $user;
        $typcon->typeconsul_id =$ii ;
       $typcon->save();
       return $this->sendResponse2($consulting,'creating successfully');
    }

    public function browseconsulting( $id)
    {
        $cc = Consulting::where('category',$id)->get();
        return $this->sendResponse2($cc,'creating successfully');
    }
    public function search( $request)
    {
        $Typeconsulting = Typeconsulting::where('name',$request)->first();
     $user = Consulting::where('name',$request);
        if($Typeconsulting){
            return $this->sendResponse2($Typeconsulting,'this is Typeconsulting ');
        }
        if($user){
            return $this->sendResponse2($user->get(),'this is user');
        }
    }
    public function showTypeconsulting(){
        $aa = Typeconsulting::get();
        return $this->sendResponse2($aa,'creating successfully');
    }
}

