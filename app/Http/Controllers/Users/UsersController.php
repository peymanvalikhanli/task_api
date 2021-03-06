<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use App\Http\controllers\export; 
use App\Http\controllers\message_type; 
use App\Http\controllers\redirect_address; 

use Exception;

use App\Models\Users;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Users::get(), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            //TODO Hash::make() 
            // $request["Password"]=md5($request->Password);
            $request["Password"] = Hash::make($request->Password);
            $request["token"] = Hash::make($request->email);
            $data = Users::create($request->all());
            return response()->json($data, 201);
        }catch(\Exception $exception){
            return response()->json($exception, 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        // $request=  \Request::get('user_id');
        // return response()->json($request,200);
        if (is_numeric($id))
        {
            return response()->json(Users::find($id), 200);
        }
        else
        {
            $column = 'UserName'; // This is the name of the column you wish to search
            return response()->json(Users::where($column , '=', $id)->first(), 200);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Users::find($id);
        if(is_null($user)){
            $data = array('data' => "Not found data");
            return response()->json($data, 404);
        }
        $user->update($request->all());
        return response()->json($user, 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Users::find($id);
        if(is_null($user)){
            $data = array('data' => "Not found data");
            return response()->json($data, 404);
        }
        $user->delete();
        $data = array('data' => "record is delete" );
        return response()->json($data, 204);

    }
}
