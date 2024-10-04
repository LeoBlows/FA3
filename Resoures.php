<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Share Resources</title>
    <link rel="stylesheet" href="Resoures.css">

</head>
<body>
<div class="main">
        <div class="navbar">
            <div class="icon">
                <a href="https://ctutraining.ac.za/gqeberha-campus/" target="_blank">CTU Buddy</a>
            </div>

            <div class="menu">
                <ul>
                    <li><a href="Home.html">Home</a></li>
                    <li><a href="TimeTable.html">Timetable</a></li>
                    <li><a href="Index.php">Discussion</a></li>
                    <li><a href="About.html">About</a></li>
                    <li><a href="Contact.html">Contact Us</a></li>
                    <li><a href="Resoures.php">Share resources</a></li>
                </ul>
            </div>
        </div> <!-- End of navbar -->

<form class="upload-form" action="upload.php" method="post" enctype="multipart/form-data" onsubmit="showSpinner()">
  <h1>Select a File to Upload</h1>
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload File" name="submit">
  
</form>

        <div>
            <div class="wave"></div>
            <div class="wave"></div>
            <div class="wave"></div>
        </div>
        

</body>
</html>
