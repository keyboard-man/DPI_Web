function search_Init()
{

}

function update_chart()
{
	$.get("php/update_db.php");
	var id = $("#content").attr("flag");
	$.post("php/float_chart.php",
		{flag:id},
		function(data){
			$("div#chart").empty();
			$("div#chart").append(data);
		});
//	$.post("php/float_table.php",
//		{id:id},
//		function(data){
//			$("div#table").empty();
//			$("div#table").append(data);
//		});
}

$(document).ready(function()
{		
	search_Init();
	var interval;
	interval = setInterval(function(){
		update_chart();
	},3000);
	update_chart();


	$("button#float").click(function(){
		var id = $(this).val();
		$("#content").attr("flag",id);
		$.post("php/float_chart.php",
			{flag:id},
			function(data){
				$("div#chart").empty();
				$("div#chart").append(data);
			});
		$.post("php/float_table.php",
			{id:id},
			function(data){
				$("div#table").empty();
				$("div#table").append(data);
			});
	});
});

function pass(){
			var mark = $("div#pass_or_stop").attr("mark");
			alert(id);
			$.post("../wu/post_test.php",
			{id:"pass"},
			function(data){
				$("div#pass_or_stop").empty();
				$("div#pass_or_stop").append(data);
		});

}

function stop(){
			var mark = $("div#pass_or_stop").attr("mark");
			alert(id);
			$.post("../wu/post_test.php",
			{id:"stop"},
			function(data){
				$("div#pass_or_stop").empty();
				$("div#pass_or_stop").append(data);
		});
}
