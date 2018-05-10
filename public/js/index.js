$(function() {

	$(document).ready( function() {	
		
		//INPUT FILE UPLOADER CUSTOM SCRIPT BEGIN
		var names = [];
		$('body').on('change', '.upload__btn', function(event) {

			$('#count_img, #size_img, #file_types').hide();

			var files = event.target.files;
			console.log(files.length);

			for (var i = 0; i < files.length; i++) {
				var file = files[i];
				
				//count
				names.push(file.size);
				var max_count = 8;
				if (names.length == max_count) {
					$('#count_img').show();
					$('#count_img_var').html(max_count);
					$('#upload__btn').parent('.upload__btn').hide();
				}
				if (names.length > max_count) {
					names.pop();
					return false;
				}

				//type
				var fileType = file.type;
				console.log(fileType);
				if (fileType == 'image/png' || fileType == 'image/jpeg'){
					
				}
				else{
					$('#file_types').show();
					return false;
				}	

				//size
				var totalBytes = file.size;
				var max_size = 5;
				//MB into bites
				var max_bites = max_size * 1024 * 1024;
				// console.log(max_bites);
				if(totalBytes > max_bites){
					$('#size_img').show();
					$('#size_img_var').html(max_size + 'MB');
					return false;
				}

				var picReader = new FileReader();
				picReader.addEventListener("load", function(event) {
					var picFile = event.target;
					var picSize = event.total;
					$("<div class='upload__item'><img src='" + picFile.result + "'" + " class='upload__img'/><a data-id='" + picSize + "' class='upload__del'></a></div>").insertBefore('#upload__btn__wrap');
				});

				picReader.readAsDataURL(file);
			}
			// console.log(names);
			
		$('body').on('click', '.upload__del', function() {
			$('#count_img, #size_img, #file_types').hide();
			$(this).closest('.upload__item').remove();
			$('#upload__btn').parent('.upload__btn').show();
			$('#count_img').hide();
			var removeItem = $(this).attr('data-id');
			var yet = names.indexOf(removeItem);
			names.splice(yet, 1);
			console.log(names);
		});

		
			
		//INPUT FILE UPLOADER CUSTOM SCRIPT END
	    });
		
	});/*$(document).ready( function()*/
});
/*$(function() { */