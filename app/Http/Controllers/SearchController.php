<?php

namespace App\Http\Controllers;

use App\Models\BookModel;
use App\Models\ChapterModel;
use App\Models\RulesModel;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $book=BookModel::all();
        return View('SearchView',compact('book'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $this->validate($request,[
            'book_id'=>'required',
            'search'=>'required',
        ]);


        if (($request->book_id != null) )
        {

            $html = "";$word=
            $pattern="/".$request->search."/i";// this pattern is for search keyword
            $replace='<span style="background-color:yellow">'.$request->search.'</span>';
            $chap = 1;
            $data_chapter_search = RulesModel::where('book_id', '=', $request->book_id)->distinct()
                ->get('chapter_id');


            for ($j = 0; $j < count($data_chapter_search); $j++)
            {
                $head = 1;
                $subhead = 1;
                $subsubhead = 1;
                $data = RulesModel::where('book_id', '=', $request->book_id)
                    ->where('chapter_id', $data_chapter_search[$j]->chapter_id)
                    ->orderBy('book_id','ASC')
                    ->orderBy('chapter_id','ASC')
                    ->orderBy('heading_id','ASC')
                    ->orderBy('subheading_id','ASC')
                    ->orderBy('subsubheading_id','ASC')
                    ->get();

                $ch_str=$data[0]->chapter_name->title;
                $ch_rr= preg_replace($pattern, $replace, $ch_str);

                $html = $html . '<div class="w3-container w3-pale-blue w3-leftbar w3-border-blue" style="font-weight: bold;font-size: 32px">' . $chap++ . ". " . $ch_rr . '</div><br>';

                for ($i = 0; $i < count($data); $i++)
                {

                    if ($data[$i]->subheading_id == null)
                    {
                        if ($data[$i]->heading_id != null)
                        {
                            $he_str=$data[$i]->heading_name->title;
                            $he_head= preg_replace($pattern, $replace, $he_str);
                            $html = $html . '<div style="margin-left: 2%;font-weight: bold;font-size: 22px">' . $head++ . ". " . $he_head. '</div>';
                        }
                    }
                    if ($data[$i]->subsubheading_id == null)
                    {
                        if ($data[$i]->subheading_id != null)
                        {
                            $subhe_str=$data[$i]->subheading_name->title;
                            $subhe_head= preg_replace($pattern, $replace, $subhe_str);
                            $html = $html . '<div style="margin-left: 4%;font-weight: bold;font-size: 20px">' . $subhead++ . ". " . $subhe_head . '</div>';
                        }
                    }

                    if ($data[$i]->subsubheading_id != null)
                    {
                        $cdes_str=$data[$i]->cdescription;
                        $cdes_head= preg_replace($pattern, $replace, $cdes_str);


                        $subsubhe_str=$data[$i]->subsubheading_name->title;
                        $subsubhe_head= preg_replace($pattern, $replace, $subsubhe_str);


                        $html = $html . '<div style="margin-left: 5.5%;font-weight: bold;font-size: 18px"">' . $subsubhead++ . ". " .$subsubhe_head  . '</div>';
                        $html = $html . '<div style="margin-left: 6%;font-size: 20px">' . $cdes_head. '</div>';
                    }
                    else
                    {
                        $cdes_str=$data[$i]->cdescription;
                        $cdes_head= preg_replace($pattern, $replace, $cdes_str);
                        $html = $html . '<div style="margin-left: 6%;font-size: 20px;">' . $cdes_head . '</div>';
                    }
                }
            }

            return response()->json($html);

        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function search_expensive(Request $request)
    {
        $this->validate($request,[
            'book_id'=>'required',
            'search'=>'required',
        ]);

        if (($request->book_id != null) ) {


            $html = "";
            $chap = 1;
            $get_head_name=0;$get_subhead_name=0;$get_subsubhead_name=0;
            $get_head_cdes=0;$get_subhead_cdes=0;$get_subsubhead_cdes=0;

            $word=$request->search;
            $pattern="/".$request->search."/i";
            $replace='<span style="background-color:yellow">'.$word.'</span>';

            $chapter = ChapterModel::where('book_id', '=', $request->book_id)->get();

            foreach ($chapter as $chapter11) {
                $head = 1;
                if(stripos($chapter11->title, $word)!==false)
                {
                   $ch_n= preg_replace($pattern,$replace,$chapter11->title);
                   $html = $html . '<div class="w3-container w3-pale-blue w3-leftbar w3-border-blue" style="font-weight: bold;font-size: 32px">' . $chap++ . ". " . $ch_n . '</div><br>';
                }
                else
                {
                    $html = $html . '<div class="w3-container w3-pale-blue w3-leftbar w3-border-blue" style="font-weight: bold;font-size: 32px">' . $chap++ . ". " . $chapter11->title . '</div><br>';
                }

                $chapter_cdes_data = RulesModel::where('book_id', '=', $request->book_id)
                    ->where('chapter_id', '=', $chapter11->id)
                    ->where('heading_id', '=', null)
                    ->where('subheading_id', '=', null)
                    ->where('subsubheading_id', '=', null)
                    ->first();
                if ($chapter_cdes_data != null) {
                    if(stripos(html_entity_decode($chapter_cdes_data->cdescription), $word)!==false) {
                        $ch_d = preg_replace($pattern, $replace, html_entity_decode($chapter_cdes_data->cdescription));
                        $html = $html . '<div style="margin-left:6%;font-size: 20px">' . $ch_d . '</div>';
                    }
                }

                foreach ($chapter11->heading_data as $heading) {
                    $subhead = 1;
                    if(stripos($heading->title, $word)!==false)
                    {
                        $get_head_name=1;
                        $he_ns = preg_replace($pattern, $replace, $heading->title);

                        $html = $html . '<div style="margin-left: 4%;font-weight: bold;font-size: 22px">' . $head++ . ". " .$he_ns  . '</div>';
                    }

                    $heading_cdes_data = RulesModel::where('book_id', '=', $request->book_id)
                        ->where('chapter_id', '=', $chapter11->id)
                        ->where('heading_id', '=', $heading->id)
                        ->where('subheading_id', '=', null)
                        ->where('subsubheading_id', '=', null)
                        ->first();
                    if ($heading_cdes_data != null)
                    {
                        if(stripos(html_entity_decode($heading_cdes_data->cdescription), $word)!==false)
                        {
                            $get_head_cdes=1;
                            $he_ds = preg_replace($pattern, $replace, html_entity_decode($heading_cdes_data->cdescription));
                        }

                        //this condition is for checking conditions of heading and its data
                        if(($get_head_name==1)&&($get_head_cdes==0))
                        {
                            $html = $html . '<div style="margin-left: 6%;font-size: 20px">' . html_entity_decode($heading_cdes_data->cdescription) . '</div>';
                            $get_head_cdes=0;
                            $get_head_name=0;
                        }
                        if(($get_head_name==1)&&($get_head_cdes==1))
                        {
                            $html = $html . '<div style="margin-left: 6%;font-size: 20px">' . $he_ds . '</div>';
                            $get_head_cdes=0;
                            $get_head_name=0;
                        }
                        if(($get_head_name==0)&&($get_head_cdes==1))
                        {
                            $html = $html . '<div style="margin-left: 4%;font-weight: bold;font-size: 22px">' . $head++ . ". " .$heading->title  . '</div>';
                            $html = $html . '<div style="margin-left: 6%;font-size: 20px">' . $he_ds . '</div>';
                            $get_head_cdes=0;
                            $get_head_name=0;
                        }
                        //end of heading conditions


                    }





                    foreach ($heading->subheading_data as $subheading)
                    {
                        $subsubhead = 1;
                        if(stripos($subheading->title, $word)!==false)
                        {
                            $get_subhead_name=1;
                            $subhe_ns = preg_replace($pattern, $replace,  $subheading->title);
                            $html = $html . '<div style="margin-left: 8%;font-weight: bold;font-size: 20px">' . $subhead++ . ". " . $subhe_ns. '</div>';

                        }

                        $subheading_cdes_data = RulesModel::where('book_id', '=', $request->book_id)
                            ->where('chapter_id', '=', $chapter11->id)
                            ->where('heading_id', '=', $heading->id)
                            ->where('subheading_id', '=', $subheading->id)
                            ->where('subsubheading_id', '=', null)
                            ->first();
                        if ($subheading_cdes_data != null)
                        {
                            if (stripos(html_entity_decode($subheading_cdes_data->cdescription), $word)!==false)
                            {
                                $get_subhead_cdes=1;
                                $subhe_ds = preg_replace($pattern, $replace, html_entity_decode($subheading_cdes_data->cdescription));

                            }

                            //this condition is for checking conditions of subheading and its data
                            if(($get_subhead_name==1)&&($get_subhead_cdes==0))
                            {
                                $html = $html . '<div style="margin-left: 10%;font-size: 20px">' .html_entity_decode($subheading_cdes_data->cdescription)  . '</div>';
                                $get_subhead_cdes=0;
                                $get_subhead_name=0;
                            }
                            if(($get_subhead_name==1)&&($get_subhead_cdes==1))
                            {
                                $html = $html . '<div style="margin-left: 10%;font-size: 20px">' .$subhe_ds  . '</div>';
                                $get_subhead_cdes=0;
                                $get_subhead_name=0;
                            }
                            if(($get_subhead_name==0)&&($get_subhead_cdes==1))
                            {
                                $html = $html . '<div style="margin-left: 8%;font-weight: bold;font-size: 20px">' . $subhead++ . ". " . $subheading->title. '</div>';
                                $html = $html . '<div style="margin-left: 10%;font-size: 20px">' .$subhe_ds  . '</div>';
                                $get_subhead_cdes=0;
                                $get_subhead_name=0;
                            }
                            //end of subheading conditions
                        }

                        foreach ($subheading->SubSubheading_data as $subsubheading)
                        {
                            if (stripos($subsubheading->title, $word)!==false)
                            {
                                $get_subsubhead_name=1;
                                $subsubhe_ns = preg_replace($pattern, $replace, $subsubheading->title);

                                $html = $html . '<div style="margin-left: 12%;font-weight: bold;font-size: 19px">' . $subsubhead++ . ". " . $subsubhe_ns . '</div>';

                            }
                            $subheading_cdes_data = RulesModel::where('book_id', '=', $request->book_id)
                                ->where('chapter_id', '=', $chapter11->id)
                                ->where('heading_id', '=', $heading->id)
                                ->where('subheading_id', '=', $subheading->id)
                                ->where('subsubheading_id', '=', $subsubheading->id)
                                ->first();
                            if ($subheading_cdes_data != null)
                            {
                                if (stripos(html_entity_decode($subheading_cdes_data->cdescription), $word)!==false)
                                {
                                    $get_subsubhead_cdes=1;
                                    $subsubhe_ds = preg_replace($pattern, $replace,html_entity_decode($subheading_cdes_data->cdescription));

                                }

                                //this condition is for checking conditions of subsubheading and its data
                                if(($get_subsubhead_name==1)&&($get_subsubhead_cdes==0))
                                {
                                    $html = $html . '<div style="margin-left: 14%;font-size: 20px">' .html_entity_decode($subheading_cdes_data->cdescription)  . '</div>';
                                    $get_subhead_cdes=0;
                                    $get_subhead_name=0;
                                }
                                if(($get_subsubhead_name==1)&&($get_subsubhead_cdes==1))
                                {
                                    $html = $html . '<div style="margin-left: 14%;font-size: 20px">' . $subsubhe_ds . '</div>';
                                    $get_subsubhead_cdes=0;
                                    $get_subsubhead_name=0;
                                }
                                if(($get_subsubhead_name==0)&&($get_subsubhead_cdes==1))
                                {
                                    $html = $html . '<div style="margin-left: 12%;font-weight: bold;font-size: 19px">' . $subsubhead++ . ". " . $subsubheading->title . '</div>';
                                    $html = $html . '<div style="margin-left: 14%;font-size: 20px">' . $subsubhe_ds . '</div>';
                                    $get_subsubhead_cdes=0;
                                    $get_subsubhead_name=0;
                                }
                                //end of subsubheading conditions

                            }

                        }
                    }
                }
            }


            return response()->json($html);
        }
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

