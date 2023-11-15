<?php

namespace App\Http\Controllers;

use App\Models\BookModel;
use App\Models\ChapterModel;
use App\Models\HeadingModel;
use App\Models\RulesModel;
use App\Models\SubSubHeadingModel;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=ChapterModel::select("*")->paginate(8);
        $data2=BookModel::all();
        return View('Chapter.ChapterView',compact('data','data2'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $this->validate($request,[
            'book_id'=>'required',
            'chapter_name'=>'required|'
        ]);

        $search_chapter=ChapterModel::where('book_id','=',$request->book_id)
        ->where('title','=',$request->chapter_name)
        ->first();

       if ($search_chapter == null) {
           $data = new ChapterModel();
           $data->book_id = $request->book_id;
           $data->title = $request->chapter_name;
           $data->status = 1;
           $data->save();
           return redirect()->back()->with('success','done');

       }
       else
       {
           return redirect()->back()->with('error','data mismatch');
       }



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
    public function edit(Request $request)
    {

       $this->validate($request,[
           'book_id'=>'required',
           'chapter_id'=>'required'
       ]);

        $data=ChapterModel::where('id','=',$request->chapter_id)->get();
        return View('Chapter.Chapteredit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $this->validate($request,[
            'c_name'=>'required',

        ]);
        $data3=ChapterModel::where('id','=',$id)->first();
        $data3->title=$request->c_name;
        $data3->save();
        return redirect(route('chapterlist'));

    }



    /**
     * Remove the specified resource from storage.
     */
    public function index1(Request $request)
    {
        $users = ChapterModel::select("*")->paginate(10);

        return view('ChapterView', compact('users'));
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function delete(Request $request)
    {

        $this->validate($request,[
            'book_id2'=>'required',
            'chapter_id2'=>'required'
        ]);

        $chapter_id=ChapterModel::where('id',$request->chapter_id2)->firstOrFail();
        RulesModel::where('chapter_id','=',$request->chapter_id2)->delete();
        if ($chapter_id!=null){
            $chapter_id->delete();
        }

        return back();
    }
}
