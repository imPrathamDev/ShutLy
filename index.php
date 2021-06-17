<?php
//connecting database
$con=mysqli_connect('localhost','root','','crud');
//checking if $_GET contain data or not
if(isset($_GET)){
    foreach($_GET as $key => $val){
        $l=$arr=mysqli_real_escape_string($con,$key);
        $l=str_replace('/','',$l);
    }

    //checking data from database using SELECT SQL Query and checking if short url is valid or not and its status is 1 or 0
    $res=mysqli_query($con,"select link from shortlink where short_link='$l' and status='1'");
    $count=mysqli_num_rows($res);
//if $count more than 0 will redirected to long url
    if($count>0){
       $data=mysqli_fetch_assoc($res);
       $link=$data['link'];
       mysqli_query($con,"update shortlink set count_hit=count_hit+1 where short_link='$l'");
       header('location:'.$link);
       die();
       //if $count is not more than 0 it will show this html code
    }else{
        echo '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Invalid URL</title>
            <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
        </head>
        <body>
        <section class="text-gray-600 body-font">
        <div class="container mx-auto flex px-5 py-24 items-center justify-center flex-col">
          <img class="lg:w-2/6 md:w-3/6 w-5/6 mb-10 object-cover object-center rounded" alt="hero" src="https://firebasestorage.googleapis.com/v0/b/replay-chat-dd920.appspot.com/o/undraw_page_not_found_su7k.png?alt=media&token=51321d54-2119-4c0c-ade3-9d800ee4cee7">
          <div class="text-center lg:w-2/3 w-full">
            <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">Oops! Something Went Wrong >_<</h1>
            <p class="mb-8 leading-relaxed">Something went wrong there are two posibility why this problem happen let see what they are first is your link is invalid and second one is that maybe this link is disable by the user who generated the link.</p>
            <a href="home.php"> <button class="flex mx-auto mt-20 text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">Go To Home</button> </a>
          </div>
        </div>
      </section>
        </body>
        </html>';
    }
}
if(isset($_GET['l'])){
	
}
?>