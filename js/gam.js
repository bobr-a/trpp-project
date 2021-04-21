$(function() {
	$(".lnr").click(function () {
		$(".menu").toggleClass("show_menu")
		$(".heading").toggleClass("change__heading")
		$(".logo__text").toggleClass("show_logo")
		$(".lnr").toggleClass("show_lnr")
		if ($(".menu").hasClass("show_menu")) {
			$(".lnr").text("")
		}
		else{
			$(".lnr").text("")
		}
	});
});