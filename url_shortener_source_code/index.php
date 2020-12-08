<?php

$status = "";
$RES = "";
$viz = "hidden";

if(isset($_POST['shorten'])){

  $URL = $_POST['url'];
  
  


      if(empty($URL)) {
	    $status = "URL is Compulsory";  
      }
      
      else if(!preg_match("%^(?:(?:https?|http)://)(?:\S+(?::\S*)?@|\d{1,3}(?:\.\d{1,3}){3}|(?:(?:[a-z\d\x{00a1}-\x{ffff}]+-?)*[a-z\d\x{00a1}-\x{ffff}]+)(?:\.(?:[a-z\d\x{00a1}-\x{ffff}]+-?)*[a-z\d\x{00a1}-\x{ffff}]+)*(?:\.[a-z\x{00a1}-\x{ffff}]{2,6}))(?::\d+)?(?:[^\s]*)?$%iu", $URL)) {
        $status = "Please enter a valid URL with protocol and no spaces. ex - https://www.google.com";
        } 
      else{
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,"https://cleanuri.com/api/v1/shorten");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
                    "url=$URL");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $output = curl_exec($ch);
        curl_close ($ch);
        $data = json_decode($output);
        $RES = $data->result_url;
        $viz = "visible";
        // echo $data->result_url;

        // echo "<script>
        // document.getElementById(".'"final_result"'.").innerHTML = <input type='text' id='inpfinal'>;
        // document.getElementById(".'"inpfinal"'.").innerHTML = $data->result_url;
        // </script>";

      }

    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="icon" href="./images/NAlogoB.png">
    <link rel="stylesheet" href="./css/custom.css">
    <title>URL Shortner</title>
    
</head>
<body>

    <nav class="navbar navbar-dark custon-nav-color">
        <span class="navbar-brand" href="#">
        <img src="./images/NAlogoB.png" class="d-inline-block align-top custom-logo" alt="">
        <span class = "navlogoword">URL SHORTNER</span>
        </span>
    </nav>
    <div class="main-block-index">
    <div class="bg-modal-url">
            <form class="form-url" id="formurl" method="POST" enctype="multipart/form-data"> 
            <h6 class="h5 mb-4 font-weight-large text-center text-white custom-font">Shorten your links</h6>
            <h6 class="h5 mb-4 font-weight-small text-center text-white custom-font2">A URL Shortner built using cleanuri.com API</h6>

                <!-- <div class="form-group row text-center"> -->
                  <!-- <p><small class="col-sm-12 col-form-label text-danger align-center"><?php echo $status ?></small></p> -->
                <!-- </div> -->
                <div class="col-sm-12 text-danger text-center"> <p><?php echo $status ?></p></div>

                <div class="form-group">
                <label  for="url" class= "text-white">URL or Link</label>
                  <input type="text" id="url" name="url" class="form-control" title="Enter Valid URL without spaces and with protocol mentioned example - https://www.google.com"  required>
                  
                </div>

                <button class="btn btn-lg btn-success btn-block" type="submit" name="shorten">Shorten URL</button>

              </form>
              <div id="final_result-div" class ="bg-modal-result " style= visibility:<?php echo $viz ?>;>
                <label  for="final_result" class= "text-white d-block">Shortened URL</label>
                <div class = "input-group" > 
                <input type="text"  id="final_result" class="form-control input-group-append"  value = <?php echo $RES;?>>
                <button><img src="./images/copybtn.png" id= "copy-btn" class= "copy-btn  d-inline" alt="copy" srcset=""></button>
                </div>
            </div>
        </div>

    </div>
    </div>
    
    </div>
    <footer class="page-footer font-small custom-footer">
        <div class="footer-copyright text-center py-3">Designed & Developed By Nagashekar Ananda
        </div>
        <div class="row">
			    <div class="col-md-12 text-center" style ="padding-bottom:12px;" >
            <a href="https://www.hitwebcounter.com" target="_blank">
            <img src="" class = "justify-content-center" title="Total Website Hits" Alt="Web Hits"   border="0" /></a>  
        </div>
        </div>
      </footer>
</body>
<script>
      const textInp = document.getElementById("final_result");
      const btncopy = document.getElementById("copy-btn");

      btncopy.onclick = function() {
        textInp.select();
        document.execCommand("Copy");
      };
    </script>
</html>
