$(document).ready(function()
{
	$("button#li").click(function(){
		var id = $(this).val();
		var button = $(this).attr("name");
		alert("click");
		switch(button)
		{
			case "add1_dpi":
				$("p#add1_dpi").html(id+'<span class="caret"></span>');
				break;
			case "add2_dpi":
				$("p#add2_dpi").html(id+'<span class="caret"></span>');
				break;
			case "add3_dpi":
				$("p#add3_dpi").html(id+'<span class="caret"></span>');
				break;
			case "ser1_dpi":
				$("p#ser1_dpi").html(id+'<span class="caret"></span>');
				break;
			case "ser2_dpi":
				$("p#ser2_dpi").html(id+'<span class="caret"></span>');
				break;
			case "ser3_dpi":
				$("p#ser3_dpi").html(id+'<span class="caret"></span>');
				break;
			case "del1_dpi":
				$("p#del1_dpi").html(id+'<span class="caret"></span>');
				break;
			case "del2_dpi":
				$("p#del2_dpi").html(id+'<span class="caret"></span>');
				break;
			case "del3_dpi":
				$("p#del3_dpi").html(id+'<span class="caret"></span>');
				break;
		}
	});
});
