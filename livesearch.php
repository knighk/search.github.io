<?php
$xmlDoc=new DOMDocument();
$xmlDoc->load("summary.xml");

$x=$xmlDoc->getElementsByTagName('row');

//get the q parameter from URL
$q=$_GET["q"];

//lookup all links from the xml file if length of q>0
if (strlen($q)>0) {
  $hint="";
  for($i=0; $i<($x->length); $i++) {
    $y=$x->item($i)->getElementsByTagName('nameEn');
    $nameCn=$x->item($i)->getElementsByTagName('nameCn');
    $file=$x->item($i)->getElementsByTagName('file');
    $Accepted=$x->item($i)->getElementsByTagName('Accepted');
    if ($y->item(0)->nodeType==1) {
	  if (stristr($y->item(0)->childNodes->item(0)->nodeValue,$q)) {		
		if ($hint=="") {
          //$hint=$y->item(0)->childNodes->item(0)->nodeValue;
          $hint=$y->item(0)->childNodes->item(0)->nodeValue
				.$nameCn->item(0)->childNodes->item(0)->nodeValue
				."<font color='red'> University: </font>".$file->item(0)->childNodes->item(0)->nodeValue 
				."<font color='red'> Accepted: </font>".$Accepted->item(0)->childNodes->item(0)->nodeValue ;
        } else {
          $hint=$hint . "<br />" .
          $hint=$y->item(0)->childNodes->item(0)->nodeValue
				.$nameCn->item(0)->childNodes->item(0)->nodeValue
				."<font color='red'> University: </font>".$file->item(0)->childNodes->item(0)->nodeValue 
				."<font color='red'> Accepted: </font>".$Accepted->item(0)->childNodes->item(0)->nodeValue ;
        }
      }	 
    }
  }
}

// Set output to "no suggestion" if no hint was found
// or to the correct values
if ($hint=="") {
  $response="no suggestion";
} else {
  $response=$hint;
}

//output the response
echo $response;
?>