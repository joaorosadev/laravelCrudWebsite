@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="{{asset('css/mystyle.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <style>
        button:hover {
            opacity: 0.7;
        }
    </style>
@endsection

@section('body')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @if(Auth::user()->name == $user->name)
        <a href="/users/{{$user->id}}/edit">
            <button class="btn btn-secondary" style="color:white; position:absolute; top:100px; right: 220px">Edit profile</button>
        </a>
    @endif
    <br>
    
    <div class ="jumbotron" style=" border: 5px solid #003d1e; display:flex; justify-content: center; flex-direction: column; align-items: center; background-color:#161616; width:300px; height:300px" >
        @if($user->cover_img != NULL)
        <img src="/storage/cover_img/{{$user->cover_img}}" style="width:220px; height:200px; ">
        @else
        <img src="/storage/cover_img/no_image.png" style="width:180px;height:150px; border-radius: 50%;">
        @endif
        <br>
        <div ><h5 class="align-self-center" style="color:white; font-size:33px ">{{$user->name}}</h5></div>
        <button onclick='showEmail()'style="background-color:black; position:absolute; top: 400px; left:213px; width:300px" id="contact" class="btn btn-secondary">Contact</button>
    </div>
    
    
    @if($user->work != NULL)
    <h3 style="color:white; position: absolute; top: 210px; left: 520px">Work or Study institution: {{$user->work}}</h3>
    @endif
    @if($user->description != NULL)
    <h4 style="color:white; position: absolute; top: 250px; left: 520px">About me: {{$user->description}}</h4>
    @endif
    
    <br>
    <h1 class="teste" style="color:white;">Papers</h1>
    <br>
    @if(count($user->papers)>0)
        @foreach($user->papers as $paper)
            <div class="jumbotron" style="padding:0.5em 0.6cm;">
                <h3><a href="/papers/{{$paper->id}}"> {{$paper->title}} </a></h3>
                <small>Uploaded on {{$paper->created_at}}.</small><br>
            </div>
        @endforeach
    @else
        <p style="color: white">No Papers found.</p>
    @endif
@endsection

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
                    
                    document.getElementById("contact").innerHTML=this.responseText;
                }
            }
            xmlhttp.open("GET","getemail?q="+str,true);
            xmlhttp.send();
        }
</script>

<script type='text/javascript'>
       function showEmail(){
        var data = <?php echo json_encode($user->email, JSON_HEX_TAG); ?>;
        if($("#contact").text() == "Contact"){
            $("#contact").text(data);
        }else{
            $("#contact").text("Contact"); 
        }
        
       }
</script>

