$(document).ready(function(){

    $('.click').click(function(){
        var stuff = $('click').text();
        alert('stuff');
        }


        );
{
   oTable = $('#data_table').dataTable({
		"bJQueryUI": true,
		"sPaginationType": "two_button",
                "bRetrieve": true,
	});

}
    $('#submit_item').click(function(){

    var item = $('#item').val();

    $.post("/invoicemanager/index.php/site/product", { "item": item },
    function(data){
      alert(data.result); // John
   }, "json");

});


    {
        $("#myTable").tablesorter();
    }

        $('input').click(function(){
        $(this).select();
    });
});