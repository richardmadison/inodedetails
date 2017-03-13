<script type="text/javascript">
  if(top != self) top.location.replace("inodedetails.live.php");
</script>

<?php

include("/usr/local/cpanel/php/cpanel.php");

// echo "<pre>";
// print_r($_SERVER);
// echo "</pre>";
//
// $user = "onlinedi"; //$_SERVER["REMOTE_USER"];

// get the current limits
// $limits = exec("/usr/bin/cl-quota --user $user");
// if ( sizeof($limits) == 3 ) echo limits[2];
// raise the limits to 1 million

// $ll = exec("/usr/bin/cl-quota --user $user -H 1000000", $clresp1);
//
// echo "<pre>";
// print_r($clresp1);
// echo "</pre>";

$cpanel = new CPANEL();

$user = $cpanel->cpanelprint('$user');
// exec ("/usr/bin/cl-quota --user $user -H 1000000");

print $cpanel->header( "Inode Usage" );      // Add the header.

$homedir = $cpanel->cpanelprint('$abshomedir');
// $homedir = $_SERVER["home"];

// $last_line = exec("perl inodes.pl $homedir | sort -n -r", $retval);
$last_line = exec("perl /usr/local/cpanel/base/frontend/paper_lantern/inodedetails/inodes.pl $homedir | sort -n -r", $retval);

// $last_line = exec("find $homedir -maxdepth 1 -type d -print0 | xargs -0 -I {} sh -c 'echo -e $(find {} | wc -l) {}' | sort -n -r", $retval);

?>

<div class="body-content">

  <div class="container-fluid">
    <div class="row">
      <div class="col-md-10 col-md-offset-1 main">

        <div id="success" class="alert alert-success">
            <span id="successImg" class="glyphicon glyphicon-ok-sign"></span>
            <span id="successMsg" class="text">
                Success!
            </span>
        </div>

        <div class="return-link">
          <a id="lnkReturn" href="javascript:history.go(-1)">
              <span class="glyphicon glyphicon-circle-arrow-left"></span>
              Go Back
          </a>
        </div>

        <h4>&nbsp;&nbsp;Folders with more than 100 files</h4>

        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Inodes</th>
                <th>Folder</th>
              </tr>
            </thead>
            <tbody>

              <?php
              $counter = 0;
              foreach ($retval as $key=>$value){
                for ($j=1;$j<10;$j++) {
                  $value = str_replace("  "," ",$value);
                  $value = str_replace("\t"," ",$value);
                }
                $details = split(" ", trim($value));
                $folder = str_replace($homedir . "/"," ",$details[1]);
                if ( $details[0] >= 100 ) {
                  $counter++;
                  echo "<tr><td>$counter</td><td>{$details[0]}</td><td>$folder</td></tr>";
                }
              }

              if ($counter < 2) echo "<tr><td colspan=3>(no folders with more than 100 files)</td></tr>";
              ?>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

</div>

<?php
// echo "hello";

// echo "<pre>";
// print_r($last_line);
// echo "</pre>";

// echo "<pre>";
// print_r($retval);
// echo "</pre>";

// echo "user $user<br/>";
// $last = exec("/usr/bin/cl-quota --user $user -H 100000", $clresp);

// echo "<pre>";
// print_r($clresp);
// echo "</pre>";

print $cpanel->footer();                      // Add the footer.
$cpanel->end();                               // Disconnect from cPanel - only do this once.

?>
