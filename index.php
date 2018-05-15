<?php
//If you have an issue with the file being too large you can increase your memory limit like so
ini_set('memory_limit','200M');

//Here we are getting the json file and decoding it.
//By setting the second parameter to true we will get an array.
$jc = file_get_contents('city.list.json');
$jd = json_decode($jc, true);
$cityid='';
$getid='';
$error=0;
$errmsg='';
//Check to see if city has been entered
if( isset($_POST['submit']) ){
  //Clean the users value and proceed
  function getid($uservalue){
    $uservalue = trim($uservalue);
    $uservalue = stripslashes($uservalue);
    $uservalue = htmlspecialchars($uservalue);
    return $uservalue;
  }

  $selected_city = getid($_POST['cselection']);
  //Check user input for special characters.
  if(!preg_match("/^[-a-zA-Zëéīİūā’ ]*$/", $selected_city))
  {
      $error = 1;
      $errmsg = "Please enter a valid city name.";
  }
  //Check if the users city is in an array
  //If it is we will get the ID from that array
  if(!$error)
  {
    foreach ($jd['cities'] as $cities=> $city)
    {
      if( in_array($city['name']==$selected_city, $city) )
      {
        $cityid = $city['id'];
        break;
      }
    }
  }
//From here you can use the city ID in your API calls.
}
?>
