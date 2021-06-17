<?php
include('connect.php');
//starting session and checking weather session contains username or not
session_start();
if(!isset($_SESSION['username'])){
	/*?>
You can use javascript code for redirection (code down below) or use php code header();
	<script>
		window.location.href='home.php';
	</script>
	<?<php*/
  header('location:home.php');
  die();
}else{
  $username = mysqli_real_escape_string($con,$_SESSION['username']);
}
//adding empty variable for error text
$ErrorMsg='';
$linkErr='';
$shortErr = '';
//checking and getting data from $_POST method 
  if(isset($_POST['link'])){
      $link = mysqli_real_escape_string($con, $_POST['link']);
      $name = mysqli_real_escape_string($con, $_POST['name']);
      $short_link = mysqli_real_escape_string($con, $_POST['short_link']);
//checking is given URL is valid or not by usibg RegEx
  if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$link)) {
        $linkErr = "Invalid URL";
      }else{
        //checking if short_link contains space between text
  if (strpos($short_link, ' ') !== false) {
          $shortErr = 'No space in short URL';
        }else{
          //when everthing is fine we check Is short_link is already created or not its very important because two same short_link can't be created
          $checkLink=mysqli_num_rows(mysqli_query($con,"select * from shortlink where short_link='$short_link'"));
          if($checkLink>0){
            $ErrorMsg='URL already taken >_<';
          }else{
            //when all done inserting data into database table
            mysqli_query($con,"insert into shortlink(link,short_link,name,status,username) values ('$link','$short_link','$name','1','$username')");
            header('location:dashboard.php');
            die();
        }
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShortURL | New Link</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <!--Project Created By Pratham Sharama-->
     <!--Header section code starts from here-->
<header class="text-gray-600 body-font">
  <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
    <a class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
    <!--svg source https://heroicons.com/ for using svg you should know sone basics of tailwind css-->
<svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-10 h-10 text-white p-2 bg-indigo-500 rounded-full" viewBox="0 0 24 24">
  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
</svg>
      <span class="ml-3 text-xl">ShutLy.cf</span>
    </a>
    <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
      <a href="home.php" class="mr-5 hover:text-gray-900">Home</a>
      <a href="dashboard.php" class="mr-5 hover:text-gray-900">Dashboard</a>
      <a href="" class="mr-5 hover:text-gray-900">GitHub</a>
    </nav>
    <a href="logout.php"><button class="inline-flex items-center bg-gray-100 border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0">Logout
    <!--svg source https://heroicons.com/ for using svg you should know sone basics of tailwind css-->
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-1" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
    </svg>
    </button>    </a>
  </div>
</header>
<!--Header section code end here-->
<!--Form section code starts from here-->
<section class="text-gray-600 body-font relative">
    <form method='post'>
  <div class="container px-5 py-24 mx-auto flex sm:flex-nowrap flex-wrap">
    <div class=" bg-white flex flex-col md:ml-auto w-full md:py-8 mt-8 md:mt-0">
      <h2 class="text-gray-900 text-lg mb-1 font-medium title-font">Create New Link</h2>
      <p class="leading-relaxed mb-5 text-gray-600">Create your new short link which should be unique and your long URL's lenght should be under 255 characters.</p>
      <div class="relative mb-4">
        <label for="name" class="leading-7 text-sm text-gray-600">Name</label>
        <input type="textbox" id="name" name="name" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" required>
      </div>
      <div class="relative mb-4">
        <label for="short_link" class="leading-7 text-sm text-gray-600">Short URL</label>
        <input type="textbox" id="short_link" name="short_link" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" required>
        <p class="text-xs text-red-500 mt-3"><?php echo $shortErr?></p>
      </div>
      <div class="relative mb-4">
        <label for="link" class="leading-7 text-sm text-gray-600">Long URL</label>
        <textarea type='textbox' id="link" name="link" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out" required></textarea>
        <p class="text-xs text-red-500 mt-3"><?php echo $linkErr?></p>
      </div>
      <button type='submit' class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">Create Now</button>
      <p class="text-xs text-red-500 mt-3"><?php echo $ErrorMsg?></p>
    </div>
  </div>
</form>
</section>
<!--Form section code starts from here-->
<!--Footer section code starts from here-->
<footer class="text-gray-600 body-font">
  <div class="container px-5 py-8 mx-auto flex items-center sm:flex-row flex-col">
    <a class="flex title-font font-medium items-center md:justify-start justify-center text-gray-900">
      <!--svg source https://heroicons.com/ for using svg you should know sone basics of tailwind css-->
<svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-10 h-10 text-white p-2 bg-indigo-500 rounded-full" viewBox="0 0 24 24">
  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
</svg>
      <span class="ml-3 text-xl">ShutLy.cf</span>
    </a>
    <p class="text-sm text-gray-500 sm:ml-4 sm:pl-4 sm:border-l-2 sm:border-gray-200 sm:py-2 sm:mt-0 mt-4">© <?php echo date("Y"); ?> ShutLy.cf —
      <a href="https://twitter.com/PrathamBlogger" class="text-gray-600 ml-1" rel="noopener noreferrer" target="_blank">@PrathamBlogger</a>
    </p>
    <span class="inline-flex sm:ml-auto sm:mt-0 mt-4 justify-center sm:justify-start">
      <a class="text-gray-500">
        <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
          <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
        </svg>
      </a>
      <a class="ml-3 text-gray-500">
        <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
          <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
        </svg>
      </a>
      <a class="ml-3 text-gray-500">
        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
          <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
          <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
        </svg>
      </a>
      <a class="ml-3 text-gray-500">
        <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="0" class="w-5 h-5" viewBox="0 0 24 24">
          <path stroke="none" d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"></path>
          <circle cx="4" cy="4" r="2" stroke="none"></circle>
        </svg>
      </a>
    </span>
  </div>
</footer>
<!--Footer section code end here-->
</body>
</html>