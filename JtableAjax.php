<?php
# This is a ajax output page which helps the widget by providing data.
# Author : samir kumar Goswami.
# Date   : 06-04-2014

use Widgets\Jtable\Helper;    # using namespace to load the helper File. 


if(isset($_GET['query'])){
   $query         =   $_GET['query']; # Gets the query data from ajax request.
}else{
   $query     =   '';
}

if(isset($_GET['jtStartIndex'])){
  $jtStartIndex  =   $_GET['jtStartIndex'];         # Gets the query data from ajax request.
}else{
  $jtStartIndex     =   0;
}


if(isset($_GET['jtPageSize'])){
  $jtPageSize    =    $_GET['jtPageSize'];           # Gets the query data from ajax request.  
}else{
  $jtPageSize     =   20;
}



if(isset($_GET['jtSorting'])){          
        $jtSorting     =   $_GET['jtSorting'];
}else{
        $jtSorting     =   '';
}

            

$QueryOutput   = Helper::GetJsonDataFromQuery($query,$jtStartIndex,$jtPageSize,$jtSorting);
echo $QueryOutput;






?>