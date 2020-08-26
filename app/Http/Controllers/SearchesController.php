<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paper;

class SearchesController extends Controller
{

    public function title(){
        return view('searches.title');
    }
    public function author(){
        return view('searches.author');
    }
    public function keywords(){
        return view('searches.keywords');
    }
    public function advanced(){
        return view('searches.advanced');
    }

    public function titleHandler(Request $request){
        $this->validate($request, [
            'title' => 'required',
        ]);
        $title=$request->input('title');
        $papersByTitle = Paper::where('title','LIKE','%'.$title.'%')->get();
        return view('searches/titleResult')->with('papers',$papersByTitle)->with('title',$title);
    }

    public function authorHandler(Request $request){
        $this->validate($request, [
            'author' => 'required',
        ]);
        $author=$request->input('author');
        $papersByAuthor = Paper::where('author','LIKE','%'.$author.'%')->get();
        return view('searches/authorResult')->with('papers',$papersByAuthor)->with('author',$author);
    }

    public function keywordsHandler(Request $request){
        $this->validate($request, [
            'keywords' => 'required',
        ]);
        $keywords=$request->input('keywords');
        $papersByKeywords = Paper::where('keywords','LIKE','%'.$keywords.'%')->get();
        return view('searches/keywordsResult')->with('papers',$papersByKeywords)->with('keywords',$keywords);
    }

    public function advancedHandler(Request $request){
        $author = $request->input('author');
        $title = $request->input('title');
        $keywords = $request->input('keywords');
        
        $results =  Paper::where('author','LIKE','%'.$author.'%')
            ->where('title','LIKE','%'.$title.'%')
            ->where('keywords','LIKE','%'.$keywords.'%')
            ->get();
    
        return view('searches.advancedResult')->with('papers', $results);    
    }
}