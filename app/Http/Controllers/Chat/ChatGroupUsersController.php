<?php

namespace App\Http\Controllers\Chat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Exception;

use App\Models\ChatGroupUsers;

class ChatGroupUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(ChatGroupUsers::get(), 200);
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
            $data = ChatGroupUsers::create($request->all());
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
        if (is_numeric($id))
        {
            return response()->json(ChatGroupUsers::find($id), 200);
        }
        else
        {
            // $column = 'UserName'; // This is the name of the column you wish to search
            // return response()->json(UserProfile::where($column , '=', $id)->first(), 200);
            return response()->json(  array('data' => "No Data" ), 200);
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
        $ChatGroupUsers = ChatGroupUsers::find($id);
        if(is_null($user)){
            $data = array('data' => "Not found data");
            return response()->json($data, 404);
        }
        $ChatGroupUsers->update($request->all());
        return response()->json($ChatGroupUsers, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ChatGroupUsers = ChatGroupUsers::find($id);
        if(is_null($ChatGroupUsers)){
            $data = array('data' => "Not found data");
            return response()->json($data, 404);
        }
        $ChatGroupUsers->delete();
        $data = array('data' => "record is delete" );
        return response()->json($data, 204);
    }
}
