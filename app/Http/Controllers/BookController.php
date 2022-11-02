<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Books::all();
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $table = Books::create([
            "title" => $request->title,
            "description" => $request->description,
            "author" => $request->author,
            "date_of_issue" => $request->date_of_issue
        ]);

        return response()->json([
            "message" => "store data success",
            "data" => $table
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $table = Books::find($id);
        if($table){
            return response()->json([
                "message" => "Load data success",
                "data" => $table
            ], 200);
        }else{
            return ["message" => "data not found"];
        };
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
        $table = Books::find($id);
        if($table){
            $table->title = $request->title ? $request->title : $table->title;
            $table->description = $request->description ? $request->description : $table->description;
            $table->author = $request->author ? $request->author : $table->author;
            $table->date_of_issue = $request->date_of_issue ? $request->date_of_issue : $table->date_of_issue;
            $table->save();

            return response()->json([
                "message" => "update data success",
                "data" => $table
            ], 200);
        }else{
            return ["message" => "data not found"];
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
        $table=Books::find($id);
        if($table){
            $table->delete();
            return response()->json([
                "message" => "deleting data success",
                "data" => $table
            ], 200);
        }else{
            return ["message" => "data not found"];
        }
    }
}
