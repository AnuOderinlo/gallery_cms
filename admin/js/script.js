


$(document).ready(function () {
	var href;
	var href_split;
	var user_id;

	var img_src;
	var img_src_split;
	var img_name;
	var photo_id;
	
	$(".modal_thumbnails").click(function () {
		$("#set_user_image").prop('disabled', false);

		href=$("#btn").prop("href");
		href_split = href.split("=");
		user_id = href_split[href_split.length-1];

		img_src = $(this).prop("src");
		img_src_split = img_src.split("/");
		img_name = img_src_split[img_src_split.length-1];
		photo_id = $(this).attr("data");

		// alert(img_name);


		$.ajax({
			url: "includes/ajax_process.php",
			data: {photo_id: photo_id},
			type: "POST",
			success:function(data) {
				if (!data.error) {
					$("#modal_sidebar").html(data);

				
				}
			}
		})
	})

	

	$("#set_user_image").click(function () {
		$.ajax({
			url: "includes/ajax_process.php",
			data: {img_name: img_name, user_id: user_id},
			type: "POST",
			success:function(data) {
				if (!data.error) {
					$(".user_img").prop("src", data);
					// location.reload();
					// console.log(data);
				}
			}
		})
	})


	$(".info-box-header").click(function () {
		$(".inside").slideToggle('fast');
		$("#toggle").toggleClass("glyphicon glyphicon-menu-up , glyphicon glyphicon-menu-down")
	})


	$(".delete_link").click(function () {
		return confirm("Are you sure you want to delete this item?")
	})





})