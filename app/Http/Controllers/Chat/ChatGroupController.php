<?php

namespace App\Http\Controllers\Chat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Exception;

use App\models\ChatGroup;


class ChatGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(ChatGroup::get(), 200);
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
            $data = ChatGroup::create($request->all());
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
            return response()->json(ChatGroup::find($id), 200);
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
         $ChatGroup = ChatGroup::find($id);
        // //if(is_null($user)){
        //     $data = array('data' => "Not found data");
        //     return response()->json($data, 404);
        // //}
        // $ChatGroup->update($request->all());
        return response()->json($ChatGroup, 200);
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
        try{
            $data = ChatGroup::update($request->all());
            return response()->json($data, 201);
        }catch(\Exception $exception){
            return response()->json($exception, 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ChatGroupDB = ChatGroup::find($id);
        if(is_null($ChatGroupDB)){
            $data = array('data' => "Not found data");
            return response()->json($data, 404);
        }
        $ChatGroupDB->delete();
        $data = array('data' => "record is delete" );
        return response()->json($data, 204);
    }
}
