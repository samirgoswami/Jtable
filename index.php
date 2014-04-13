<?php
use Widgets\Jtable\Helper;    # using namespace to load the helper File. 
 
addCSS($widgetBaseURL.'/css/default.css');       # Load the js file in template. 
addCSS('/css/jquery-ui.css');    
addCSS($widgetBaseURL.'/jtableLibs/themes/metro/brown/jtable.min.css'); # Load the js file in template.


addJS('http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js');
addJS($widgetBaseURL.'/jtableLibs/jquery.jtable.min.js'); # Load the js file in template.
addJS($widgetBaseURL.'/js/custom.js');  

/**
 * Function helps us to set the query in session.
 * paramerts is array i.e $params.
 * return a hash key.
 */
   $queryKey = Helper::SetQueryToSession($params);

/**
 * Function helps to genrate the 
 */
   $originalkeys = Helper::GetCoulmnNameFromQuery($params);

/**
 * Functions to set the default data to the table.
 * paramerts is params array.
 * return the default data.
 */
	$title          = Helper::SetTitle($params);
	$paging         = Helper::SetPaging($params);
	$pageSize       = Helper::SetPageSize($params);
	$sorting        = Helper::SetSorting($params);
	$defaultSorting = Helper::SetDefaultSorting($params);
	$multiselect    = Helper::SetMultiselect($params);

/**
 * Function to set the fields for the jtable.
 * paramerts are array i.e params.
 * retrun an associated array. 
 */
   $outputColumsData = Helper::SetColumn($originalkeys,$params);
?>

<!-- Script to load the jquery table -->
<script type="text/javascript">
var fields         = JSON.parse('<?php echo json_encode($outputColumsData); ?>');
var title          = '<?php echo $title; ?>';
var paging         = '<?php echo $paging; ?>';
var pageSize       = '<?php echo $pageSize; ?>';
var sorting        = '<?php echo $sorting; ?>';
var defaultSorting = '<?php echo $defaultSorting; ?>';
var multiselect    = '<?php echo $multiselect; ?>';

function WidgetJtableParams(url){

		var Jtableparams = {
		            title: title,
					paging : paging,
		            pageSize: pageSize,
		            sorting: sorting,
		            defaultSorting: defaultSorting, 
		            multiselect: multiselect, //Allow multiple selecting
		            actions: {
		                listAction: url
		            },
		            fields: fields
		    };

		return Jtableparams;
}
</script>
<!-- Script to load the jquery table End -->




<div class="jtable Jtable_<?php echo $queryKey; ?>" query="<?php echo $queryKey; ?>"></div>