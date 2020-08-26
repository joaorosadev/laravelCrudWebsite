<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Paper;

class MainController extends Controller
{
    public function index(){
        return view('pages.index');
    }

    public function about(){
        return view('pages.about');
    }

    public function services(){
        $data = array(
            'title' => 'Services',
            'services' => ['Web programming','Web design', 'Programming languages']
        );
        return view('pages.services')->with($data);
    }

    public function profile($id){
        $nameWithSpace = str_replace("_", " ", $id);
        $user = User::find($id);
        //$user = User::where('name','LIKE','%'.$nameWithSpace.'%')->first();
        return view('profile')->with('user',$user);
    }

    public function editProfile($id){
        $user = User::find($id);
        return view('editprofile')->with('user',$user);
    }

    public function feed($userid){
        $user = User::find($userid);
        return view('feed')->with('user', $user);
    }

    /*
    public function follow($myId, $hisId){
        
            $me = User::find($myId);
            $him = User::find($hisId);

            $me->users()->save($him);
            $me->save();
          
    }*/

    public function livesearch(){
        $myfile = fopen("C:\\xampp\\htdocs\\scientificpapers\\app\\Http\\Controllers\\teste.txt","r") or die("Cannot open file");
        rewind($myfile);
        $whole= file_get_contents("C:\\xampp\\htdocs\\scientificpapers\\app\\Http\\Controllers\\teste.txt");
        $lines = explode(",",$whole);
        $q = $_REQUEST["q"];
        $line = "";
        $hint = "";
        $i=0;
        //print_r($lines);
        

        if ($q !== "") {
            $q = strtolower($q);
            $len=strlen($q);
            
            for($i=0;$i<count($lines) - 1;$i++){
                $line = $lines[$i];
                if (stristr($q, substr($line, 0, $len))){
                    if($hint === ""){
                        $hint = $line;
                    }else{
                        $hint .= ", $line";
                    }
                }
            }/*
            foreach($lines as $line){
                print($line);
                if (stristr($q, substr($line, 0, $len))){
                    if($hint === ""){
                        $hint = $line;
                    }else{
                        $hint .= ", $line";
                    }
                }
            }
            
            while(!feof($myfile)){
                $line = fgets($myfile);
                if (stristr($q, substr($line, 0, $len))){
                    if($hint === ""){
                        $hint = $line;
                    }else{
                        $hint .= ", $line";
                    }
                }
            }*/
              
        }
        
        fclose($myfile);

        if ($hint=="") {
            $response="no suggestion";
        } else {
            $response=$hint;
        }
          
        //output the response
        echo $response;
    }

}
