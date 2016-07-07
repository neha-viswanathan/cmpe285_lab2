<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
</head>
<body>
[insert_php]
extract($_POST);
$userExists = 0;
$file1 = fopen("password.txt", "r");
if(!$file1) {
   print("\nError! Could not open password file!\n");
   die();
}
while(!feof($file1) && !$userExists) {
   $line = fgets($file1, 1024);
   $line = chop($line);
   $field = split(",", $line, 2);

   if($userid == $field[0]) {
     $userExists = 1;
     
     if(checkPwd($pwd, $field)) {
       accessGranted($userid);
     }
     else {
       wrongPwd();
     }  
   }
}

 if(!$userExists) {
  accessDenied();
}


function checkPwd($pwd, $field) {
  if($pwd == $field[1]) {
    return true;
  }
  else {
    return false;
  }
}
function accessGranted($userid) {
 print ("<font color=\"green\">Permission granted!</font><br/><br/><br/> Hi <strong>$userid</strong><br/> Welcome to The Sport Shop!<br/><br/><br/>");
$file2 = fopen("userInfo.txt", "r");
if(!$file2) {
   print("\nError! Could not open user info file!\n");
   die();
}
while(!feof($file2)) {
   $line2 = fgets($file2, 1024);
   $line2 = chop($line2);
   $row = split(";", $line2, 6);

   if($userid == $row[0]) {
   	print("<b>Buyer Name :: </b>" . $row[1]);
   	echo '<br/><br/>';
   	print("<b>Buyer Address :: </b>" . $row[2]);
   	echo '<br/><br/>';
    print("<b>Buyer Email :: </b>" . $row[3]);
   	echo '<br/><br/>';
   	print("<b>Buyer Phone Number :: </b>" . $row[4]);
   	echo '<br/><br/>';
   	print("<b>Buyer Purchase History :: </b>");
   	echo '<br/><br/><br/>';
   	echo '<table><tr><td><b>Product Name</b></td><td><b>Date of Purchase</b></td><td><b>Quantity</b></td></tr>';
   	$prod = split(",",$row[5]);
   	foreach ($prod as $var1) {
          $pieces = explode('*', $var1);
    echo sprintf(
        '<tr><td>%s</td><td>%s</td><td>%s</td></tr>',
        ltrim($pieces[0], 'Product Name='),
        ltrim($pieces[1], 'Date of Purchase='),
        ltrim($pieces[2], 'Quantity=')
    );
        }
   	echo '</table>';
   	break;
   }
}

fclose($file2);
echo "<a href=\"http://www.swmonk.com/home/\">Logout</a>";
}

function wrongPwd() {
 print ("<font color=\"red\">Check your password!</font><br/> You were denied access by the server due to incorrect password!<br/>");
}

function accessDenied() {
  print ("<font color=\"red\">Permission denied!</font><br/><br/> Username and/or password does not exist! You were denied access by the server.<br/>");
}

fclose($file1);


[/insert_php]
</body>
</html>
