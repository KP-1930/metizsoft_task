<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function fetchState(Request $request)
    {        
        $data['states'] = State::where("country_id",$request->country_id)->get(["name", "id"]);        
        return response()->json($data);
    }

    public function fetchCity(Request $request)
    {
        $data['cities'] = City::where("state_id",$request->state_id)->get(["name", "id"]);
        return response()->json($data);
    }

    public function index()
    {        
        $user_data =  User::with(['country','state','city'])->get();        
        return view('user.index',compact('user_data'));
    }

    public function create()
    {
        $country_data =  DB::table('countries')->select('id','name')->get();

        return view('user.create',compact('country_data'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
  
        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }
        $input['password'] = bcrypt($input['password']);
        $input['hobbies'] = implode(',',$input['hobbies']);
    
        User::create($input);
     
        return redirect()->route('user-list')
                        ->with('success','User created successfully.');
    }

    public function show(User $user)
    {
        return view('user.show',compact('user'));
    }

    public function delete(User $user)
    {
        $user->delete();
        return redirect()->route('user-list')
                        ->with('success','User Deleted successfully.');

    }

    public function edit(User $user)
    {   
        $country_data =  DB::table('countries')->select('id','name')->get();        
        return view('user.edit', [
            'user' => $user,
            'country_data' => $country_data,
            'hobbies' => explode(',',$user->hobbies)
        ]);
        
    }

    public function update(Request $request,User $user)
    {
        $input = $request->all();
  
        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }else{
            unset($input['image']);
        }
          
        $input['hobbies'] = implode(',',$input['hobbies']);
        $user->update($input);
    
        return redirect()->route('user-list')
                        ->with('success','User Updated successfully');
    }
}
