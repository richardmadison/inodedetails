<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="cPanel Inode Detail Plugin">
    <meta name="author" content="Richard Madison, Light Speed Technologies">
    <title>cPanel Inode Detail</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>

  <body>

<?php
  // echo "<pre>";
  // print_r($_SERVER);
  // echo "</pre>";
  // $user = "onlinedi"; //$_SERVER["REMOTE_USER"];

  $homedir = $_SERVER["HOME"];

  // echo "homedir $homedir<br/>";
  // $last_line = exec("perl inodes.pl $homedir | sort -n -r", $retval);
  // $last_line = exec("find $homedir -maxdepth 1 -type d -print0 | xargs -0 -I {} sh -c 'echo -e $(find {} | wc -l) {}' | sort -n -r", $retval);
  // $ll = exec("cd homedir; for dir in ./*/; do printf $dir; find $dir -type f | wc -l;done", $retval);
  // $ll = exec("cd $homedir; for dir in ./*/; do printf $dir; find $dir -type f | wc -l;done", $retval);
  // print_r($last_line);
  // $ll =exec("for dir in /home2/smartsof/.; do printf $dir; find $dir -type f | wc -l; done", $retval);

  $last_line = exec("perl /usr/local/cpanel/base/frontend/paper_lantern/inodedetails/inodes.pl $homedir | sort -n -r", $retval);

  // $last_line = exec("cd $homedir; ls -la", $retval);
  // echo $last_line . "<br/>";
  // echo $homedir;
  // echo "<pre>";
  // print_r($retval);
  // echo "</pre>";
?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-10 col-md-offset-1 main">
          <h2 class="sub-header">Inode Details</h2>

          <p>(You are seeing this page because your account inode count exceeds the allowable maximum inodes of 100,000. Please review the folders below and cleanup your account to ensure cPanel, your hosting and your mail work properly.)</p>

          <div id="success" class="alert alert-success">
              <span id="successImg" class="glyphicon glyphicon-ok-sign"></span>
              <span id="successMsg" class="text">
                  Success!
              </span>
          </div>

          <div class="return-link text-center">
            <a id="lnkReturn" href="../index.html">
                <span class="glyphicon glyphicon-circle-arrow-left"></span>
                cPanel Home<br/>
            </a>
          </div>

          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Inodes</th>
                  <th>Folders With > 100 Inodes</th>
                </tr>
              </thead>
              <tbody>

                <?
                $counter = 0;
                foreach ($retval as $key=>$value){
                  for ($j=1;$j<10;$j++) {
                    $value = str_replace("  "," ",$value);
                    $value = str_replace("\t"," ",$value);
                  }
                  $details = split(" ", trim($value));
                  $folder = str_replace($homedir . "/"," ",$details[1]);
                  $counter++;
                  if ( $details[0] >= 100 ) echo "<tr><td>$counter</td><td>{$details[0]}</td><td>$folder</td></tr>";
                }
                ?>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  </body>
</html>
