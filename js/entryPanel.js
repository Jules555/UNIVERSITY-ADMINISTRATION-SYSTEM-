$(document).ready(function(){

	$(".student-info").click(function(){
		$("#personal-information").css({display:"block"});
		$("#course-table").css({display:"none"});
		$("#result").css({display:"none"});
	});


	$(".student-course").click(function(){
		$("#course-table").css({display:"block"});
		$("#personal-information").css({display:"none"});
		$("#result").css({display:"none"});
	});

	$(".result-poll").click(function(){
		$("#result").css({display:"block"});
		$("#personal-information").css({display:"none"});
		$("#course-table").css({display:"none"});
	});

	function updateInfo(Myinfo){
		if(Myinfo.hasClass("hide")){
			Myinfo.removeClass("hide");
			Myinfo.addClass("show");
		}
		else{
			Myinfo.removeClass("show");
			Myinfo.addClass("hide");
		}
	}

	$(".update_info").click(function(){
		updateInfo($(".change-info"));
	})






})

