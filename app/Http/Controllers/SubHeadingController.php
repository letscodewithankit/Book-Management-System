<?php

namespace App\Http\Controllers;

use App\Models\BookModel;
use App\Models\ChapterModel;
use App\Models\HeadingModel;
use App\Models\RulesModel;
use App\Models\SubHeadingModel;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SubHeadingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $book=BookModel::all();
        $chapter=ChapterModel::all();
        $heading=HeadingModel::all();
        $data=SubHeadingModel::select("*")->paginate(8);



       return View('Subheading.SubHeading',compact('book','chapter','heading','data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $this->validate($request,[
            'heading_id'=>'required',
            'SubHeading_name'=>'required|'
        ]);

        $search_subheading=SubHeadingModel::where('heading_id','=',$request->heading_id)
            ->where('title','=',$request->SubHeading_name)
            ->first();

        if ($search_subheading==null)
        {
            $data=new SubHeadingModel();
            $data->heading_id=$request->heading_id;
            $data->title=$request->SubHeading_name;
            $data->status=1;
            $data->save();

            return redirect()->back()->with('success','done');
        }
        else
        {
            return redirect()->back()->with('error','mismatch');
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
            'book_id3'=>'required',
            'chapter_id3'=>'required',
            'heading_id3'=>'required',
            'subheading_id3'=>'required'
        ]);

        $data=SubHeadingModel::where('id','=',$request->subheading_id3)->get();
        return View('Subheading.SubheadingEdit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'sub_name'=>'required',

        ]);
        $data3=SubHeadingModel::where('id','=',$id)->first();
        $data3->title=$request->sub_name;
        $data3->save();
        return redirect(route('subheadinglist'));

    }
    /**
     * Remove the specified resource from storage.
     */
    public function index1(Request $request)
    {
        $users = SubHeadingModel::select("*")->paginate(10);

        return view('SubHeading', compact('users'));
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
            'chapter_id2'=>'required',
            'heading_id2'=>'required',
            'subheading_id2'=>'required'
        ]);

        $subheading_id=SubHeadingModel::where('id',$request->subheading_id2)->firstOrFail();
        RulesModel::where('subheading_id','=',$request->subheading_id2)->delete();
        if ($subheading_id!=null){
            $subheading_id->delete();
        }

        return back();
    }

}
