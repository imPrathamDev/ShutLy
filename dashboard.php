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
  //if session containsa username its value pass to string called $username using mysqli_real_escape_string(): we use this method to prevention from SQL injection
  $username = mysqli_real_escape_string($con, $_SESSION['username']);
}
//checking if $_GET['type'] is equal to delete to perform delete task using mysqli_query(); delete SQL Query
if(isset($_GET['type']) && $_GET['type']=='delete'){
    $id=mysqli_real_escape_string($con,$_GET['id']);
    mysqli_query($con,"delete from shortlink where id='$id'");
}
//checking if $_GET['type'] equals to status and cheking $_GET['status'] is equls to active or deactive and perform update task using SQL Query
if(isset($_GET['type']) && $_GET['type']=='status'){
  $id=mysqli_real_escape_string($con,$_GET['id']);
  $status=mysqli_real_escape_string($con,$_GET['status']);
  if($status=='active'){
    mysqli_query($con,"update shortlink set status='1' where id='$id'");
  }else{
    mysqli_query($con,"update shortlink set status='0' where id='$id'");
  }
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShutLy.cf | Dashboard</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
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
<!--Table section code starts from here-->
<section class="text-gray-600 body-font">
  <div class="container px-5 py-24 mx-auto">
    <div class="flex flex-col text-center w-full mb-20">
      <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-gray-900"><?php echo "Hi, ".$_SESSION['username']; ?></h1>
      <p class="lg:w-2/3 mx-auto leading-relaxed text-base">All links are created by <?php echo $_SESSION['username']; ?> are available here. You can manage your links from here like you can Active or Deactive your link even you can also delete your link from here.</p>
    </div>
    <div class="lg:w-2/3 w-full mx-auto overflow-auto">
      <table class="table-auto w-full text-left whitespace-no-wrap">
        <thead>
          <tr>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">ID</th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">NAME</th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">SHORT URL</th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">LONG URL</th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">VIEW</th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">DATE & TIME</th>
            <th class="w-10 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
            <th class="w-10 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
            <th class="w-10 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
          </tr>
        </thead>
        <tbody>
        <!--Using while loop for getting data in table-->
            <?php $sqlData=mysqli_query($con,"select * from shortlink where username='$username'");
            $check = mysqli_num_rows($sqlData);
            if($check>0){
            while($row=mysqli_fetch_assoc($sqlData)){ ?>
          <tr>
          <!--showing link id from table-->
            <td class="border-t-2 border-gray-200 px-4 py-3"><?php echo $row['id'] ?></td>
          <!--showing link name-->
            <td class="border-t-2 border-gray-200 px-4 py-3"><?php echo $row['name'] ?></td>
          <!--showing short link from the table-->
            <td class="border-t-2 border-gray-200 px-4 py-3"><a href='https://shutly.cf/<?php echo $row['short_link'] ?>' target='_blank'>ShutLy.cf/<?php echo $row['short_link'] ?></a></td>
          <!--showing long link from the table-->
            <td class="border-t-2 border-gray-200 px-4 py-3"><a href='<?php echo $row['link'] ?>' target='_blank'><?php echo $row['link'] ?></a></td>
          <!--showing link view count (Like how many people used your link) from the table-->
            <td class="border-t-2 border-gray-200 px-4 py-3 text-lg text-gray-900"><?php echo $row['count_hit'] ?></td>
          <!--showing date and time when link created-->
            <td class="border-t-2 border-gray-200 px-4 py-3 text-lg text-gray-900"><?php echo $row['date'] ?></td>
          <!--Delete option getting link id from table and use $_GET method-->
            <td class="border-t-2 border-red-200 px-4 py-3 text-lg text-red-500"><a href='?id=<?php echo $row['id'] ?>&type=delete'>Delete</a></td>
          <!--Active and Deactive option work same as delete option-->  
            <td class="border-t-2 border-indigo-200 px-4 py-3 text-lg text-indigo-500"><?php
            //checking weather link is active or not
										  if($row['status']==1){
											?><a href="?id=<?php echo $row['id']?>&type=status&status=deactive">Deactive</a><?php
										  }else{
											?><a href="?id=<?php echo $row['id']?>&type=status&status=active">Active</a><?php
										  }
										  ?></td>
            <td class="border-t-2 border-gray-200 w-10 text-center">
            </td>
          </tr>
         <?php }
        
      }else{ ?>
            <!--No data found text will show here (Do Something)-->
            <?php } ?>
            <!--Closing while loop-->
        </tbody>
      </table>
    </div>
    <div class="flex pl-4 mt-4 lg:w-2/3 w-full mx-auto">
     <button class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded"><a href="add-link.php">New Link</a></button>
    </div>
  </div>
</section>
<!--Table section code end here-->
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