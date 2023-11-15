<?php

namespace App\Http\Controllers;

use App\Models\BookModel;
use App\Models\HeadingModel;
use App\Models\RulesModel;
use App\Models\SubSubHeadingModel;
use Illuminate\Http\Request;

class SubSubHeadingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $data=SubSubHeadingModel::select("*")->paginate(8);
       $book=BookModel::all();
       return View('SubSubHeading.SubSubHeadingView',compact('data','book'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
       $this->validate($request,[
           'subheading_id'=>'required',
           'SubSubHeading_name'=>'required'
       ]);

       $search_subsubheading=SubSubHeadingModel::where('subheading_id','=',$request->subheading_id)
           ->where('title','=',$request->SubSubHeading_name)
            ->first();

       if ($search_subsubheading==null)
       {
           $data=new SubSubHeadingModel();
           $data->subheading_id=$request->subheading_id;
           $data->title=$request->SubSubHeading_name;
           $data->status=1;
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
            'book_id3'=>'required',
            'chapter_id3'=>'required',
            'heading_id3'=>'required',
            'subheading_id3'=>'required',
            'subsubheading_id3'=>'required'
        ]);
        $data=SubSubHeadingModel::where('id','=',$request->subsubheading_id3)->get();
        return View('SubSubHeading.SubsubheadingEdit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'subhsubh_name'=>'required',

        ]);
        $data3=SubSubHeadingModel::where('id','=',$id)->first();
        $data3->title=$request->subhsubh_name;
        $data3->save();
        return redirect(route('subsubheadinglist'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function index1(Request $request)
    {
        $users = SubSubHeadingModel::select("*")->paginate(10);

        return view('SubSubHeadingView', compact('users'));
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
            'subheading_id2'=>'required',
            'subsubheading_id2'=>'required'
        ]);
        $subsubheading_id=SubSubHeadingModel::where('id',$request->subsubheading_id2)->firstOrFail();
        RulesModel::where('subsubheading_id','=',$request->subsubheading_id2)->delete();
        if ($subsubheading_id!=null){
            $subsubheading_id->delete();
        }

        return back();
    }

}
