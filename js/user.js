function search_Init()
{
	$("input#user_search").val("");
}

$(document).ready(function()
{
	search_Init();
	$("button#user_search").click(function(){
		var info = $("input#user_search").val();
		if(info!="")
		$.post("php/search_user.php",
			{user:info},
			function(data){
				$("div#content").empty();
				$("div#content").append(data);
			});
	});

	$("button#list").click(function(){
		var id = $(this).val();
		$.post("php/user_info.php",
			{id:id},
			function(data){
				$("div#content").empty();
				$("div#content").append(data);
			});
	});


});
