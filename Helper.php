<?php
namespace Widgets\Jtable;    # Creating the namespace for Jtable. 
use Druto\Session\Session;   # Using namespace to load the session 
use Druto\DataBase\DataBase; # Using namespace to load the Databse
/**
 * Helper Class For jtable widget of Durto Framework.
 **/
class Helper
{

	# Function helps to set the query in session for later uses.
	public  static function SetQueryToSession($params){
		$sql = $params['sql'];	
		$session = Session::getInstance();    # Getting the Session instance 
        $queryKey = sha1($sql);               # Genrating sha1 value of the sql 
        $session->set($queryKey,$sql);        # Set the query to session.
        return $queryKey;
	}

	# Function helps to get the column name from query.
	public static function GetCoulmnNameFromQuery($params){
		$sql = $params['sql'];				  # Get the query			   	
		$db  = DataBase::getInstance();       # Getting the Database instance
        $row = (array)$db->fetchObject($sql); # Fetching the result from the query.
        return  array_keys($row); 
	}

	# Function thats helps
	public static function SetColumn($originalkeys,$params){
		    $outputColumsData = array();
		    if(isset($params['columns'])){ # If columns provided by users.
			    $columns = $params['columns'];
			    foreach ($originalkeys as $key => $value) {
			    	if(isset($columns[$value])){
			    	   $outputColumsData[$value] = $columns[$value];
			    	}else{
			    		$outputColumsData[$value]['title']= ucfirst($value); 
			    		$outputColumsData[$value]['width']='25%'; 
			    	}
			    }
				
		    }else{

		    	foreach ($originalkeys as $key => $value) {
						$outputColumsData[$value]['title'] = $value;    		
						$outputColumsData[$value]['width'] = '25%';    		
		    	}

		    }
		    return $outputColumsData;
	}

    # Function set the title of the table.
	public static function SetTitle($params){
		    $title = "";
		    if(isset($params['title']) && strlen($params['title'])>0){
		   		$title = $params['title'];
		    }else{
 				$title = "Demo List";
		    }
		    return $title;	
	}

	# Function helps to set the Paging of the table.
    public static function SetPaging($params){
    	    $paging = "";
		    if(isset($params['paging']) && strlen($params['paging'])>0){
		   		$paging = $params['paging'];
		    }else{
 				$paging = 'true';
		    }
		    return $paging;
    }

    # Function helps to set the Page Size in the table.
    public static function SetPageSize($params){
    	    $pageSize = "";
		    if(isset($params['pageSize']) && strlen($params['pageSize'])>0){
		   		$pageSize = (int)$params['pageSize'];
		    }else{
 				$pageSize = 20;
		    }
		    return $pageSize;
    }

    # Function helps to set the sorting Default value is 'true'.
    public static function SetSorting($params){
    	    $sorting = "";
		    if(isset($params['sorting']) && strlen($params['sorting'])>0){
		   		$sorting = $params['sorting'];
		    }else{
 				$sorting = 'true';
		    }
		    return $sorting;
    }
    
    # 
    public static function SetDefaultSorting($params){
    	    $defaultSorting = ""; 
		    if(isset($params['defaultSorting']) && strlen($params['defaultSorting'])>0){
		   		$defaultSorting = $params['defaultSorting'];
		    }else{
 				$defaultSorting = '';
		    }
		    return $defaultSorting;		
    }

    # 
    public static function SetMultiselect($params){
    		$multiselect = "";
		    if(isset($params['multiselect']) && strlen($params['multiselect'])>0){
		   		$multiselect = $params['multiselect'];
		    }else{
 				$multiselect = 'true';
		    }
		    return $multiselect;
    }

    # Function to get the data for the table.
    public static function GetJsonDataFromQuery($query,$jtStartIndex,$jtPageSize,$jtSorting){
    	$data = 0;
    	$jTableResult = array();
        $jTableResult['Result'] = "OK";
    	if(!empty($query)){	# Checks its empty or not.	
    		$session = Session::getInstance();
	    	$sql  = $session->get($query);    # Getting the sql Query from Session.
		    $db   = DataBase::getInstance();       # Getting the Database instance
		    $total = count($db->fetchObjects($sql));
		    if(!empty($jtSorting)){
			    $sql.=" ORDER BY ".$jtSorting;
		    }
		    $sql.=" LIMIT $jtStartIndex,$jtPageSize";
		    $jTableResult['TotalRecordCount']=$total;
		    $jTableResult['Records'] = $db->fetchObjects($sql); # Fetching the results from the query.
		    if(count($jTableResult) >0)
			    $data = json_encode($jTableResult);
		    else 
			    $data = json_encode(array());
		}else{
			    $data = json_encode(array());
		}
		return $data;
    }

}