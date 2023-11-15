<?php

namespace App\Http\Controllers;

use App\Models\BookModel;
use App\Models\ChapterModel;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=BookModel::select("*")->paginate(8);
       return View('Book.BookView',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $this->validate($request,[
            'b_name'=>'required|max:20',
        ]);
        $data= new BookModel();
        $data->title=$request->b_name;
        $data->status=1;
        $data->save();
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data=BookModel::where('id','=',$id)->get();
        return View('Book.BookEdit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'b_name'=>'required',

        ]);
        $data3=BookModel::where('id','=',$id)->first();
        $data3->title=$request->b_name;

        $data3->save();
        return redirect(route('booklist'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        BookModel::where('id','=',$id)->delete();
        return redirect(route('booklist'));
    }


    //Delete the book data
    public function index1(Request $request)
    {
        $users = BookModel::select("*")->paginate(10);

        return view('BookView', compact('users'));
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function delete($id)
    {
        $book_id=BookModel::where('id',$id)->firstOrFail();
        if ($book_id!=null){
            $book_id->delete();
            return redirect()->back();
        }



    }



}
