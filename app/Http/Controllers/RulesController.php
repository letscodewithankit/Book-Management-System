<?php

namespace App\Http\Controllers;

use App\Models\BookModel;
use App\Models\HeadingModel;
use App\Models\RulesModel;
use Illuminate\Http\Request;

class RulesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = RulesModel::select("*")
            ->paginate(8);
        $book=BookModel::all();
        return View("Rules.RulesView",compact('data','book'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $this->validate($request,[
            'chapter_id'=>'required',
            'description'=>'required',
        ]);



        $check=RulesModel::where('book_id','=',$request->book_id)
            ->where('chapter_id','=',$request->chapter_id)
            ->get();



        foreach ($check as $check44)
        {
            if(($check44->book_id==$request->book_id)&&($check44->chapter_id==$request->chapter_id)&&($check44->heading_id==$request->heading_id)&&($check44->subheading_id==$request->subheading_id)&&($check44->subsubheading_id==$request->subsubheading_id))
            {
                $check44->cdescription=$check44->cdescription.str_replace("<p>&nbsp;</p>","",$request->description);
                $check44->save();
                return redirect()->back()->with('error','mismatch');
            }

        }

       $data=new RulesModel();
       $data->book_id=$request->book_id;
       $data->chapter_id=$request->chapter_id;
       $data->heading_id=$request->heading_id;
       $data->subheading_id=$request->subheading_id;
       $data->subsubheading_id=$request->subsubheading_id;
       $data->cdescription=str_replace("<p>&nbsp;</p>","",$request->description);
       $data->save();

       return redirect()->back()->with('success','done');

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
        $data=RulesModel::where('id','=',$id)->get();
        return View('Rules.RulesEdit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request,[
           'rdescription'=>'required'
        ]);
        $data3=RulesModel::where('id','=',$id)->first();
        $data3->cdescription=str_replace("<p>&nbsp;</p>","",$request->rdescription);
        $data3->save();
        return redirect(route('ruleslist'));

    }
    /**
     * Remove the specified resource from storage.
     */
    public function index1(Request $request)
    {
        $users = RulesModel::select("*")->paginate(10);

        return view('RulesView', compact('users'));
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function delete($id)
    {
        $Rules_id=RulesModel::where('id',$id)->firstOrFail();
        if ($Rules_id!=null){
            $Rules_id->delete();
        }

        return back();
    }

}
