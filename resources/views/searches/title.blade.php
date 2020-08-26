@extends('layouts.template')

@section('head')
    <link rel="stylesheet" href="{{asset('css/mystyle.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function showResult(str){
            //console.log(str);
            if (str.length==0) {
                document.getElementById("livesearch").innerHTML="";
                document.getElementById("livesearch").style.border="0px";
                return;
            }
            var xmlhttp=new XMLHttpRequest();
            xmlhttp.onreadystatechange=function() {
                if (this.readyState==4 && this.status==200) {
                    if(this.responseText === "no suggestion"){
                        document.getElementById("livesearch").innerHTML="No suggestion";
                        document.getElementById("livesearch").style.border="1px solid #A5ACB2";
                    }else{
                        document.getElementById("livesearch").innerHTML="Suggestion: "+this.responseText;
                        document.getElementById("livesearch").style.border="1px solid #A5ACB2";
                    }
                    
                }
            }
            xmlhttp.open("GET","livesearch.php?q="+str,true);
            xmlhttp.send();
        }
    </script>
@endsection

@section('body')
    <div class ="jumbotron text-center" style="position:relative; top:130px;">
        {!! Form::open(['action' => 'SearchesController@titleHandler', 'method' => 'GET']) !!}
            <div class='form-group'>
                    {{Form::label('title', 'Title', ['style' => 'font-size: 30px', 'id' => 'label'])}}
                    {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title to search for', 'style' => 'text-align: center','onkeyup' => 'showResult(this.value)'])}}
            </div>
            {{Form::submit('Search',['class' => 'btn btn-primary'])}} <br><br>
        {!! Form::close() !!}
        <div id="livesearch" class="float-right"></div>
    </div>
@endsection
