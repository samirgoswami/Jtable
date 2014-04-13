$(document).ready(function () {
 	var query = $('.jtable').attr('query');
 	var url='/widgetAjax/Widgets/Jtable/JtableAjax.php?query='+query;
        $('.Jtable_'+query).jtable(WidgetJtableParams(url));
        $('.Jtable_'+query).jtable('load');
    });
