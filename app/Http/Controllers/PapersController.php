<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paper;
use App\User;

class PapersController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $papers = Paper::orderBy('created_at', 'desc')->paginate(5);
        return view('papers.index')->with('papers', $papers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('papers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'type' => 'required',
            'body' => 'required',
            'keywords' => 'required',
            'abstract' => 'required',
            'cover' => 'nullable|max:1999'
        ]);

        //Handle file upload
        if ($request->hasFile('cover')) {
            $fileNameWithExt = $request->file('cover')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('cover')->getClientOriginalExtension();
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            $path = $request->file('cover')->storeAs('public/cover', $fileNameToStore);
        } else {
            $fileNameToStore = 'no_file.txt';
        }

        $paper = new Paper;
        $paper->title = $request->input('title');
        $paper->user_id = auth()->user()->id;
        $paper->type = $request->input('type');
        $paper->body = $request->input('body');
        $paper->keywords = $request->input('keywords');
        $paper->abstract = $request->input('abstract');
        $paper->cover = $fileNameToStore;

        //ADDED

        $userName = auth()->user()->name;
        $paper->author = $userName;

        $paper->save();

        $myfile = fopen("C:\\xampp\\htdocs\\scientificpapers\\app\\Http\\Controllers\\teste.txt", "a");
        fwrite($myfile, $paper->title . ",");
        fclose($myfile);

        return redirect('/papers')->with('success', 'Paper submitted');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paper = Paper::find($id);
        return view('papers.show')->with('paper', $paper);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paper = Paper::find($id);

        //Check for correct user
        if (auth()->user()->id !== $paper->user_id) {
            return redirect('/papers')->with('error', 'You can only edit your papers');
        }
        return view('papers.edit')->with('paper', $paper);
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
        $this->validate($request, [
            'title' => 'required',
            'type' => 'required',
            'body' => 'required',
            'keywords' => 'required',
            'abstract' => 'required',
            'cover' => 'nullable|max:1999'
        ]);

        //Handle file upload
        if ($request->hasFile('cover')) {
            $fileNameWithExt = $request->file('cover')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('cover')->getClientOriginalExtension();
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            $path = $request->file('cover')->storeAs('public/cover', $fileNameToStore);
        } else {
            $fileNameToStore = 'no_file.txt';
        }

        $paper = Paper::find($id);
        $oldtitle = $paper->title;

        // // // DELETING ENTRY FROM TEXT FILE // // //
        $myfile = fopen("C:\\xampp\\htdocs\\scientificpapers\\app\\Http\\Controllers\\teste.txt", "a") or die("Cannot open file");
        rewind($myfile);
        $whole = file_get_contents("C:\\xampp\\htdocs\\scientificpapers\\app\\Http\\Controllers\\teste.txt");
        $lines = explode(",", $whole);

        for ($i = 0; $i < count($lines) - 1; $i++) {
            $line = $lines[$i];
            if (strcmp($line, $oldtitle) == 0) {
                unset($lines[$i]);
                \array_values($lines);
            }
        }
        ftruncate($myfile, 0);
        fclose($myfile);

        $myfile = fopen("C:\\xampp\\htdocs\\scientificpapers\\app\\Http\\Controllers\\teste.txt", "w");
        $whole = implode(",", $lines);
        fwrite($myfile, $whole);
        fclose($myfile);
        // // // DELETING ENTRY FROM TEXT FILE // // //


        $paper->title = $request->input('title');
        $paper->type = $request->input('type');
        $paper->body = $request->input('body');
        $paper->keywords = $request->input('keywords');
        $paper->abstract = $request->input('abstract');
        $userName = auth()->user()->name;
        $paper->author = $userName;
        $paper->cover = $fileNameToStore;


        $paper->save();



        $myfile = fopen("C:\\xampp\\htdocs\\scientificpapers\\app\\Http\\Controllers\\teste.txt", "a");
        fwrite($myfile, $paper->title . ",");
        fclose($myfile);

        return redirect('/papers')->with('success', 'Paper updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paper = Paper::find($id);

        //Check for user correspondence
        if (auth()->user()->id !== $paper->user_id) {
            return redirect('/papers')->with('error', 'You can only delete your papers');
        }

        // // // DELETING ENTRY FROM TEXT FILE // // //
        $myfile = fopen("C:\\xampp\\htdocs\\scientificpapers\\app\\Http\\Controllers\\teste.txt", "a") or die("Cannot open file");
        rewind($myfile);
        $whole = file_get_contents("C:\\xampp\\htdocs\\scientificpapers\\app\\Http\\Controllers\\teste.txt");
        $lines = explode(",", $whole);

        for ($i = 0; $i < count($lines) - 1; $i++) {
            $line = $lines[$i];
            if (strcmp($line, $paper->title) == 0) {
                unset($lines[$i]);
                \array_values($lines);
            }
        }
        ftruncate($myfile, 0);
        fclose($myfile);

        $myfile = fopen("C:\\xampp\\htdocs\\scientificpapers\\app\\Http\\Controllers\\teste.txt", "w");
        $whole = implode(",", $lines);
        fwrite($myfile, $whole);
        fclose($myfile);
        // // // DELETING ENTRY FROM TEXT FILE // // //

        $paper->delete();
        return redirect('/papers')->with('success', 'Paper deleted');
    }
}
