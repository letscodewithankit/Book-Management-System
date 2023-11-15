<?php

namespace App\Http\Controllers;

use App\Models\BookModel;
use App\Models\ChapterModel;
use App\Models\HeadingModel;
use App\Models\RulesModel;
use App\Models\SubHeadingModel;
use App\Models\SubSubHeadingModel;
use Illuminate\Http\Request;

class HeadingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=HeadingModel::select("*")->paginate(8);
        $data2=ChapterModel::all();
        $data3=BookModel::all();
        return View('Heading.HeadingView',compact('data','data2','data3'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $this->validate($request,[
            'chapter_id'=>'required|',
            'Heading_name'=>'required|',
        ]);

        $search_heading=HeadingModel::where('chapter_id','=',$request->chapter_id)
            ->where('title','=',$request->Heading_name)
             ->first();

        if ($search_heading==null)
        {
            $data=new HeadingModel();
            $data->chapter_id=$request->chapter_id;
            $data->title=$request->Heading_name;
            $data->status=1;
            $data->save();

            return redirect()->back()->with('success','done');
        }
        else
        {
            return redirect()->back()->with('error','mismatch');
        }


    }


    public function fetchchapter(Request $request)
    {
        $data = ChapterModel::where("book_id", $request->book_id)->get(["title", "id"]);
        return response()->json($data);
    }

    public function fetchheading(Request $request)
    {

        $data = HeadingModel::where("chapter_id", $request->chapter_id)->get(["title", "id"]);
        return response()->json($data);

    }

    public function fetchsubheading(Request $request)
    {

        $data = SubHeadingModel::where("heading_id", $request->heading_id)->get(["title", "id"]);
        return response()->json($data);

    }
    public function fetchsubsubheading(Request $request)
    {

        $data = SubSubHeadingModel::where("subheading_id", $request->subheading_id)->get(["title", "id"]);
        return response()->json($data);

    }


    public function search(Request $request)
    {

        // if book wants data

        if (($request->chapter_id == "NaN") && ($request->book_id != null) && ($request->heading_id == "NaN") && ($request->subheading_id == "NaN") && ($request->subsubheading_id == "NaN")) {
            $html = "";
            $chap = 1;

            $chapter = ChapterModel::where('book_id', '=', $request->book_id)->get();

            foreach ($chapter as $chapter11) {
                $head = 1;
                $html = $html . '<div class="w3-container w3-pale-blue w3-leftbar w3-border-blue" style="font-weight: bold;font-size: 32px">' . $chap++ . ". " . $chapter11->title . '</div><br>';

                $chapter_cdes_data = RulesModel::where('book_id', '=', $request->book_id)
                    ->where('chapter_id', '=', $chapter11->id)
                    ->where('heading_id', '=', null)
                    ->where('subheading_id', '=', null)
                    ->where('subsubheading_id', '=', null)
                    ->first();
                if ($chapter_cdes_data != null) {
                    $html = $html . '<div style="margin-left:6%;font-size: 20px">' . $chapter_cdes_data->cdescription . '</div>';
                }

                foreach ($chapter11->heading_data as $heading)
                {
                    $subhead = 1;
                    $html = $html . '<div style="margin-left: 4%;font-weight: bold;font-size: 22px">' . $head++ . ". " . $heading->title . '</div>';

                    $heading_cdes_data = RulesModel::where('book_id', '=', $request->book_id)
                        ->where('chapter_id', '=', $chapter11->id)
                        ->where('heading_id', '=', $heading->id)
                        ->where('subheading_id', '=', null)
                        ->where('subsubheading_id', '=', null)
                        ->first();
                    if ($heading_cdes_data != null) {
                        $html = $html . '<div style="margin-left: 6%;font-size: 20px">' . $heading_cdes_data->cdescription . '</div>';
                    }

                    foreach ($heading->subheading_data as $subheading) {
                        $subsubhead = 1;
                        $html = $html . '<div style="margin-left: 8%;font-weight: bold;font-size: 20px">' . $subhead++ . ". " . $subheading->title . '</div>';

                        $subheading_cdes_data = RulesModel::where('book_id', '=', $request->book_id)
                            ->where('chapter_id', '=', $chapter11->id)
                            ->where('heading_id', '=', $heading->id)
                            ->where('subheading_id', '=', $subheading->id)
                            ->where('subsubheading_id', '=', null)
                            ->first();
                        if ($subheading_cdes_data != null) {
                            $html = $html . '<div style="margin-left: 10%;font-size: 20px">' . $subheading_cdes_data->cdescription . '</div>';
                        }

                        foreach ($subheading->SubSubheading_data as $subsubheading) {
                            $html = $html . '<div style="margin-left: 12%;font-weight: bold;font-size: 19px">' . $subsubhead++ . ". " . $subsubheading->title . '</div>';

                            $subheading_cdes_data = RulesModel::where('book_id', '=', $request->book_id)
                                ->where('chapter_id', '=', $chapter11->id)
                                ->where('heading_id', '=', $heading->id)
                                ->where('subheading_id', '=', $subheading->id)
                                ->where('subsubheading_id', '=', $subsubheading->id)
                                ->first();
                            if ($subheading_cdes_data != null) {
                                $html = $html . '<div style="margin-left: 14%;font-size: 20px">' . $subheading_cdes_data->cdescription . '</div>';
                            }

                        }
                    }
                }
            }


            return response()->json(html_entity_decode($html));

        }

        // if book id and chapter id wants data
        if (($request->chapter_id != null) && ($request->book_id != null) && ($request->heading_id == "NaN") && ($request->subheading_id == "NaN") && ($request->subsubheading_id == "NaN")) {
            $html = "";
            $chap = 1;

            $chapter = ChapterModel::where('book_id', '=', $request->book_id)
                ->where('id','=',$request->chapter_id)
                ->get();

            foreach ($chapter as $chapter11) {
                $head = 1;
                $html = $html . '<div class="w3-container w3-pale-blue w3-leftbar w3-border-blue" style="font-weight: bold;font-size: 32px">' . $chap++ . ". " . $chapter11->title . '</div><br>';

                $chapter_cdes_data = RulesModel::where('book_id', '=', $request->book_id)
                    ->where('chapter_id', '=', $request->chapter_id)
                    ->where('heading_id', '=', null)
                    ->where('subheading_id', '=', null)
                    ->where('subsubheading_id', '=', null)
                    ->first();
                if ($chapter_cdes_data != null) {
                    $html = $html . '<div style="margin-left:6%;font-size: 20px">' . $chapter_cdes_data->cdescription . '</div>';
                }

                foreach ($chapter11->heading_data as $heading) {
                    $subhead = 1;
                    $html = $html . '<div style="margin-left: 4%;font-weight: bold;font-size: 22px">' . $head++ . ". " . $heading->title . '</div>';

                    $heading_cdes_data = RulesModel::where('book_id', '=', $request->book_id)
                        ->where('chapter_id', '=', $chapter11->id)
                        ->where('heading_id', '=', $heading->id)
                        ->where('subheading_id', '=', null)
                        ->where('subsubheading_id', '=', null)
                        ->first();
                    if ($heading_cdes_data != null) {
                        $html = $html . '<div style="margin-left: 6%;font-size: 20px">' . $heading_cdes_data->cdescription . '</div>';
                    }

                    foreach ($heading->subheading_data as $subheading) {
                        $subsubhead = 1;
                        $html = $html . '<div style="margin-left: 8%;font-weight: bold;font-size: 20px">' . $subhead++ . ". " . $subheading->title . '</div>';

                        $subheading_cdes_data = RulesModel::where('book_id', '=', $request->book_id)
                            ->where('chapter_id', '=', $chapter11->id)
                            ->where('heading_id', '=', $heading->id)
                            ->where('subheading_id', '=', $subheading->id)
                            ->where('subsubheading_id', '=', null)
                            ->first();
                        if ($subheading_cdes_data != null) {
                            $html = $html . '<div style="margin-left: 10%;font-size: 20px">' . $subheading_cdes_data->cdescription . '</div>';
                        }

                        foreach ($subheading->SubSubheading_data as $subsubheading) {
                            $html = $html . '<div style="margin-left: 12%;font-weight: bold;font-size: 19px">' . $subsubhead++ . ". " . $subsubheading->title . '</div>';

                            $subheading_cdes_data = RulesModel::where('book_id', '=', $request->book_id)
                                ->where('chapter_id', '=', $chapter11->id)
                                ->where('heading_id', '=', $heading->id)
                                ->where('subheading_id', '=', $subheading->id)
                                ->where('subsubheading_id', '=', $subsubheading->id)
                                ->first();
                            if ($subheading_cdes_data != null) {
                                $html = $html . '<div style="margin-left: 14%;font-size: 20px">' . $subheading_cdes_data->cdescription . '</div>';
                            }

                        }
                    }
                }
            }
            return response()->json(html_entity_decode($html));
        }

        // if book chapter and heading  wants data
        if (($request->chapter_id != null) && ($request->book_id != null) && ($request->heading_id !=null) && ($request->subheading_id =="NaN") && ($request->subsubheading_id == "NaN")) {
            $html = "";
            $chap = 1;

            $chapter = ChapterModel::where('book_id', '=', $request->book_id)
                ->where('id','=',$request->chapter_id)
                ->get();

            foreach ($chapter as $chapter11) {
                $head = 1;
                $html = $html . '<div class="w3-container w3-pale-blue w3-leftbar w3-border-blue" style="font-weight: bold;font-size: 32px">' . $chap++ . ". " . $chapter11->title . '</div><br>';

                $chapter_cdes_data = RulesModel::where('book_id', '=', $request->book_id)
                    ->where('chapter_id', '=', $request->chapter_id)
                    ->where('heading_id', '=', null)
                    ->where('subheading_id', '=', null)
                    ->where('subsubheading_id', '=', null)
                    ->first();
                if ($chapter_cdes_data != null) {
                    $html = $html . '<div style="margin-left:6%;font-size: 20px">' . $chapter_cdes_data->cdescription . '</div>';
                }

                foreach ($chapter11->heading_data as $heading) {
                    //this if condition is for printing the heading data only
                    if ($heading->id==$request->heading_id)
                    {
                        $subhead = 1;
                        $html = $html . '<div style="margin-left: 4%;font-weight: bold;font-size: 22px">' . $head++ . ". " . $heading->title . '</div>';

                        $heading_cdes_data = RulesModel::where('book_id', '=', $request->book_id)
                            ->where('chapter_id', '=', $chapter11->id)
                            ->where('heading_id', '=', $heading->id)
                            ->where('subheading_id', '=', null)
                            ->where('subsubheading_id', '=', null)
                            ->first();
                        if ($heading_cdes_data != null) {
                            $html = $html . '<div style="margin-left: 6%;font-size: 20px">' . $heading_cdes_data->cdescription . '</div>';
                        }

                        foreach ($heading->subheading_data as $subheading) {

                                $subsubhead = 1;
                                $html = $html . '<div style="margin-left: 8%;font-weight: bold;font-size: 20px">' . $subhead++ . ". " . $subheading->title . '</div>';

                                $subheading_cdes_data = RulesModel::where('book_id', '=', $request->book_id)
                                    ->where('chapter_id', '=', $chapter11->id)
                                    ->where('heading_id', '=', $heading->id)
                                    ->where('subheading_id', '=', $subheading->id)
                                    ->where('subsubheading_id', '=', null)
                                    ->first();
                                if ($subheading_cdes_data != null) {
                                    $html = $html . '<div style="margin-left: 10%;font-size: 20px">' . $subheading_cdes_data->cdescription . '</div>';
                                }

                                foreach ($subheading->SubSubheading_data as $subsubheading) {
                                    $html = $html . '<div style="margin-left: 12%;font-weight: bold;font-size: 19px">' . $subsubhead++ . ". " . $subsubheading->title . '</div>';

                                    $subheading_cdes_data = RulesModel::where('book_id', '=', $request->book_id)
                                        ->where('chapter_id', '=', $chapter11->id)
                                        ->where('heading_id', '=', $heading->id)
                                        ->where('subheading_id', '=', $subheading->id)
                                        ->where('subsubheading_id', '=', $subsubheading->id)
                                        ->first();
                                    if ($subheading_cdes_data != null) {
                                        $html = $html . '<div style="margin-left: 14%;font-size: 20px">' . $subheading_cdes_data->cdescription . '</div>';
                                    }

                                }

                        }
                    }//end of heading condition

                }
            }
            return response()->json(html_entity_decode($html));
        }


        // if book chapter heading and subheading wants data
        if (($request->chapter_id != null) && ($request->book_id != null) && ($request->heading_id !=null) && ($request->subheading_id !=null) && ($request->subsubheading_id == "NaN")) {
            $html = "";
            $chap = 1;

            $chapter = ChapterModel::where('book_id', '=', $request->book_id)
                ->where('id','=',$request->chapter_id)
                ->get();

            foreach ($chapter as $chapter11) {
                $head = 1;
                $html = $html . '<div class="w3-container w3-pale-blue w3-leftbar w3-border-blue" style="font-weight: bold;font-size: 32px">' . $chap++ . ". " . $chapter11->title . '</div><br>';

                $chapter_cdes_data = RulesModel::where('book_id', '=', $request->book_id)
                    ->where('chapter_id', '=', $request->chapter_id)
                    ->where('heading_id', '=', null)
                    ->where('subheading_id', '=', null)
                    ->where('subsubheading_id', '=', null)
                    ->first();
                if ($chapter_cdes_data != null)
                {
                    $html = $html . '<div style="margin-left:6%;font-size: 20px">' . $chapter_cdes_data->cdescription . '</div>';
                }

                foreach ($chapter11->heading_data as $heading) {
                    //this if condition is for printing the heading data only
                    if ($heading->id==$request->heading_id)
                    {
                        $subhead = 1;
                        $html = $html . '<div style="margin-left: 4%;font-weight: bold;font-size: 22px">' . $head++ . ". " . $heading->title . '</div>';

                        $heading_cdes_data = RulesModel::where('book_id', '=', $request->book_id)
                            ->where('chapter_id', '=', $chapter11->id)
                            ->where('heading_id', '=', $heading->id)
                            ->where('subheading_id', '=', null)
                            ->where('subsubheading_id', '=', null)
                            ->first();
                        if ($heading_cdes_data != null) {
                            $html = $html . '<div style="margin-left: 6%;font-size: 20px">' . $heading_cdes_data->cdescription . '</div>';
                        }

                        foreach ($heading->subheading_data as $subheading) {

                            //this "if" condition is for printing the subheading data only
                            if ($subheading->id==$request->subheading_id)
                            {
                                $subsubhead = 1;
                                $html = $html . '<div style="margin-left: 8%;font-weight: bold;font-size: 20px">' . $subhead++ . ". " . $subheading->title . '</div>';

                                $subheading_cdes_data = RulesModel::where('book_id', '=', $request->book_id)
                                    ->where('chapter_id', '=', $chapter11->id)
                                    ->where('heading_id', '=', $heading->id)
                                    ->where('subheading_id', '=', $subheading->id)
                                    ->where('subsubheading_id', '=', null)
                                    ->first();
                                if ($subheading_cdes_data != null) {
                                    $html = $html . '<div style="margin-left: 10%;font-size: 20px">' . $subheading_cdes_data->cdescription . '</div>';
                                }

                                foreach ($subheading->SubSubheading_data as $subsubheading) {
                                    $html = $html . '<div style="margin-left: 12%;font-weight: bold;font-size: 19px">' . $subsubhead++ . ". " . $subsubheading->title . '</div>';

                                    $subheading_cdes_data = RulesModel::where('book_id', '=', $request->book_id)
                                        ->where('chapter_id', '=', $chapter11->id)
                                        ->where('heading_id', '=', $heading->id)
                                        ->where('subheading_id', '=', $subheading->id)
                                        ->where('subsubheading_id', '=', $subsubheading->id)
                                        ->first();
                                    if ($subheading_cdes_data != null) {
                                        $html = $html . '<div style="margin-left: 14%;font-size: 20px">' . $subheading_cdes_data->cdescription . '</div>';
                                    }

                                }
                            }//end of subheading condition

                        }
                    }//end of heading condition

                }
            }
            return response()->json(html_entity_decode($html));
        }


        // if everyone wants data
        if (($request->chapter_id != null) && ($request->book_id != null) && ($request->heading_id !=null) && ($request->subheading_id !=null) && ($request->subsubheading_id !=null)) {
            $html = "";
            $chap = 1;

            $chapter = ChapterModel::where('book_id', '=', $request->book_id)
                ->where('id','=',$request->chapter_id)
                ->get();

            foreach ($chapter as $chapter11) {
                $head = 1;
                $html = $html . '<div class="w3-container w3-pale-blue w3-leftbar w3-border-blue" style="font-weight: bold;font-size: 32px">' . $chap++ . ". " . $chapter11->title . '</div><br>';

                $chapter_cdes_data = RulesModel::where('book_id', '=', $request->book_id)
                    ->where('chapter_id', '=', $request->chapter_id)
                    ->where('heading_id', '=', null)
                    ->where('subheading_id', '=', null)
                    ->where('subsubheading_id', '=', null)
                    ->first();
                if ($chapter_cdes_data != null) {
                    $html = $html . '<div style="margin-left:6%;font-size: 20px">' . $chapter_cdes_data->cdescription . '</div>';
                }

                foreach ($chapter11->heading_data as $heading) {
                    //this if condition is for printing the heading data only
                    if ($heading->id==$request->heading_id)
                    {
                        $subhead = 1;
                        $html = $html . '<div style="margin-left: 4%;font-weight: bold;font-size: 22px">' . $head++ . ". " . $heading->title . '</div>';

                        $heading_cdes_data = RulesModel::where('book_id', '=', $request->book_id)
                            ->where('chapter_id', '=', $chapter11->id)
                            ->where('heading_id', '=', $heading->id)
                            ->where('subheading_id', '=', null)
                            ->where('subsubheading_id', '=', null)
                            ->first();
                        if ($heading_cdes_data != null) {
                            $html = $html . '<div style="margin-left: 6%;font-size: 20px">' . $heading_cdes_data->cdescription . '</div>';
                        }

                        foreach ($heading->subheading_data as $subheading) {

                            //this "if" condition is for printing the subheading data only
                            if ($subheading->id==$request->subheading_id)
                            {
                                $subsubhead = 1;
                                $html = $html . '<div style="margin-left: 8%;font-weight: bold;font-size: 20px">' . $subhead++ . ". " . $subheading->title . '</div>';

                                $subheading_cdes_data = RulesModel::where('book_id', '=', $request->book_id)
                                    ->where('chapter_id', '=', $chapter11->id)
                                    ->where('heading_id', '=', $heading->id)
                                    ->where('subheading_id', '=', $subheading->id)
                                    ->where('subsubheading_id', '=', null)
                                    ->first();
                                if ($subheading_cdes_data != null) {
                                    $html = $html . '<div style="margin-left: 10%;font-size: 20px">' . $subheading_cdes_data->cdescription . '</div>';
                                }

                                foreach ($subheading->SubSubheading_data as $subsubheading)
                                {
                                    //this if condition is for printing the subsubheading data
                                    if($subsubheading->id==$request->subsubheading_id)
                                    {
                                        $html = $html . '<div style="margin-left: 12%;font-weight: bold;font-size: 19px">' . $subsubhead++ . ". " . $subsubheading->title . '</div>';

                                        $subheading_cdes_data = RulesModel::where('book_id', '=', $request->book_id)
                                            ->where('chapter_id', '=', $chapter11->id)
                                            ->where('heading_id', '=', $heading->id)
                                            ->where('subheading_id', '=', $subheading->id)
                                            ->where('subsubheading_id', '=', $subsubheading->id)
                                            ->first();
                                        if ($subheading_cdes_data != null)
                                        {
                                            $html = $html . '<div style="margin-left: 14%;font-size: 20px">' . $subheading_cdes_data->cdescription . '</div>';
                                        }
                                    }//end of subsubheading conditon


                                }
                            }//end of subheading condition

                        }
                    }//end of heading condition

                }
            }
            return response()->json(html_entity_decode($html));
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {

        $this->validate($request,[
            'book_id3'=>'required',
            'chapter_id3'=>'required',
            'heading_id3'=>'required'
        ]);
        $data=HeadingModel::where('id','=',$request->heading_id3)->get();
        return View('Heading.HeadingEdit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'h_name'=>'required',

        ]);
        $data3=HeadingModel::where('id','=',$id)->first();
        $data3->title=$request->h_name;
        $data3->save();
        return redirect(route('headinglist'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function index1(Request $request)
    {
        $users = HeadingModel::select("*")->paginate(10);

        return view('HeadingView', compact('users'));
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
            'heading_id2'=>'required'
        ]);
        $heading_id=HeadingModel::where('id',$request->heading_id2)->firstOrFail();
        RulesModel::where('heading_id','=',$request->heading_id2)->delete();
        if ($heading_id!=null){
            $heading_id->delete();
        }

        return back();
    }
}
