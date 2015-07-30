jQuery(function($) {
	


	function addUploaderFunctionToButton(upButt){
		upButt.click(function(e) {
			formID = $(this).attr('rel');
			formfield = $(this).siblings('.meta_box_upload_file');
			preview = $(this).siblings('.meta_box_filename');
			icon = $(this).siblings('.meta_box_file');
			tb_show('Choose File', 'media-upload.php?post_id=' + formID + '&type=file&TB_iframe=1');
			window.orig_send_to_editor = window.send_to_editor;
			window.send_to_editor = function(html) {
				fileurl = $(html).attr('href');
				//filename = $(html).text();
				formfield.val(fileurl);
				preview.text(fileurl);
				icon.addClass('checked');
				tb_remove();
				window.send_to_editor = window.orig_send_to_editor;
			}
			//return false;
		});
	}


	function addImageuploaderFunctionToButton(clndbtnimg){
		clndbtnimg.click(function() {
				formID = $(this).attr('rel');
				formfield = $(this).siblings('.meta_box_upload_image');
				preview = $(this).siblings('.meta_box_preview_image');
				tb_show('Choose Image', 'media-upload.php?post_id=' + formID + '&type=image&TB_iframe=1');
				window.orig_send_to_editor = window.send_to_editor;
				window.send_to_editor = function(html) {
					imgurl = html.match(/<img.*?src="(.*?)"/);
					id = html.match(/wp-image-(.*?)"/, '');
					formfield.val(id[1]);
					preview.attr('src', imgurl[1]);
					tb_remove();
					window.send_to_editor = window.orig_send_to_editor;
				}
				//return false;
			});
	}


	function clearImgField(btn){
		btn.click(function() {
				var defaultImage = $(this).parent().siblings('.meta_box_default_image').text();
				$(this).parent().siblings('.meta_box_upload_image').val('');
				$(this).parent().siblings('.meta_box_preview_image').attr('src', defaultImage);
				return false;
			});
	}


	/* = initialization
	=============================================================*/
	
	function addNewFunctionsBtn(){
			// the upload image button, saves the id and outputs a preview of the image

			addImageuploaderFunctionToButton($('.meta_box_upload_image_button'));

			
			// the remove image link, removes the image id from the hidden field and replaces the image preview
			
			
			clearImgField($('.meta_box_clear_image_button'));
			
			
			// the remove image link, removes the image id from the hidden field and replaces the image preview
			$('.meta_box_clear_file_button').click(function() {
				$(this).parent().siblings('.meta_box_upload_file').val('');
				$(this).parent().siblings('.meta_box_filename').text('');
				$(this).parent().siblings('.meta_box_file').removeClass('checked');
				return false;
			});
			
			// function to create an array of input values
			function ids(inputs) {
				var a = [];
				for (var i = 0; i < inputs.length; i++) {
					a.push(inputs[i].val);
				}
				//$("span").text(a.join(" "));
			}
			
			
			$('.meta_box_repeatable_remove').live('click', function(){
				$(this).closest('tr').remove();
				return false;
			});
				
			$('.meta_box_repeatable tbody').sortable({
				opacity: 0.6,
				revert: true,
				cursor: 'move',
				handle: '.hndle'
			});
			
			// post_drop_sort	
			$('.sort_list').sortable({
				connectWith: '.sort_list',
				opacity: 0.6,
				revert: true,
				cursor: 'move',
				cancel: '.post_drop_sort_area_name',
				items: 'li:not(.post_drop_sort_area_name)',
				update: function(event, ui) {
					var result = $(this).sortable('toArray');
					var thisID = $(this).attr('id');
					$('.store-' + thisID).val(result) 
				}
			});
		
			$('.sort_list').disableSelection();
		
			// turn select boxes into something magical
			if (!!$.prototype.chosen)
				$('.chosen').chosen({ allow_single_deselect: true });
				
	}
	 addNewFunctionsBtn();
	 
	 
	 // the file image button, saves the id and outputs the file name
			
			
			
			
	
	
	
	//var upButt = $('.meta_box_upload_file_button');
	addUploaderFunctionToButton($('.meta_box_upload_file_button'));
	
			
			
	// repeatable fields
	$('.meta_box_repeatable_add').live('click', function(e) {
		// clone
		e.preventDefault();
		var row = $(this).closest('.meta_box_repeatable').find('tbody tr:last-child');
		var clone = row.clone();
		clone.find('select.chosen').removeAttr('style', '').removeAttr('id', '').removeClass('chzn-done').data('chosen', null).next().remove();
		clone.find('input.regular-text, textarea, select, .meta_box_upload_file ').val('');
		clone.find('input[type=checkbox], input[type=radio]').attr('checked', false);
		clone.find('span.meta_box_filename').html('');
		
		/** = i have to restore functionality of buttons
		*/
		var clndbtn = clone.find('.meta_box_upload_file_button');
		var clndbtnimg = clone.find('.meta_box_upload_image_button');
		var cleanImgFieldBtn = clone.find('.meta_box_clear_image_button');

		clone.find('img.meta_box_preview_image').attr('src','');

		addUploaderFunctionToButton(clndbtn);
		addImageuploaderFunctionToButton(clndbtnimg);
		clearImgField(cleanImgFieldBtn);
		
		 
		row.after(clone);
		// increment name and id
		clone.find('input, textarea, select')
			.attr('name', function(index, name) {
				return name.replace(/(\d+)/, function(fullMatch, n) {
					return Number(n) + 1;
				});
		});

		var arr = [];

		$('input.repeatable_id:text').each(function(){ arr.push($(this).val()); }); 
		clone.find('input.repeatable_id')
			.val(Number(Math.max.apply( Math, arr )) + 1);
		if (!!$.prototype.chosen) {
			clone.find('select.chosen')
				.chosen({allow_single_deselect: true});
		}

		 
		
		//
		return false;
	});
});