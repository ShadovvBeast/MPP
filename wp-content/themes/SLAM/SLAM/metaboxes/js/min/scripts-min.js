jQuery(function($){function e(e){e.click(function(e){formID=$(this).attr("rel"),formfield=$(this).siblings(".meta_box_upload_file"),preview=$(this).siblings(".meta_box_filename"),icon=$(this).siblings(".meta_box_file"),tb_show("Choose File","media-upload.php?post_id="+formID+"&type=file&TB_iframe=1"),window.orig_send_to_editor=window.send_to_editor,window.send_to_editor=function(e){fileurl=$(e).attr("href"),formfield.val(fileurl),preview.text(fileurl),icon.addClass("checked"),tb_remove(),window.send_to_editor=window.orig_send_to_editor}})}function t(e){e.click(function(){var e,t;if(void 0!==e)return void e.open();e=wp.media.frames.file_frame=wp.media({frame:"post",state:"insert",multiple:!1});var i=$(this).attr("rel");formfield=$(this).siblings(".meta_box_upload_image"),preview=$(this).siblings(".meta_box_preview_image"),e.on("insert",function(){json=e.state().get("selection").first().toJSON(),console.log("imgurl:"+json.url),console.log("id:"+json.id),imgurl=json.url,id=json.id,preview.attr("src",imgurl),formfield.val(id)}),e.open()})}function i(e){e.click(function(){var e=$(this).parent().siblings(".meta_box_default_image").text();return $(this).parent().siblings(".meta_box_upload_image").val(""),$(this).parent().siblings(".meta_box_preview_image").attr("src",e),!1})}function o(){$(".qw-conditional-fields").each(function(){var e="";$(this).find("option:selected").each(function(){$(this).attr("data-tohide")&&($.toHideArray=$(this).attr("data-tohide").split("[+]"),$.toHideArray.length>0&&$.each($.toHideArray,function(e,t){$(t).not("qw-hidden")&&$(t).addClass("qw-hidden")})),$(this).attr("data-toreveal")&&($.toRevealArray=$(this).attr("data-toreveal").split("[+]"),$.toRevealArray.length>0&&$.each($.toRevealArray,function(e,t){$(t).removeClass("qw-hidden")}))})})}function a(){function e(e){for(var t=[],i=0;i<e.length;i++)t.push(e[i].val)}t($(".meta_box_upload_image_button")),i($(".meta_box_clear_image_button")),$(".meta_box_clear_file_button").click(function(){return $(this).parent().siblings(".meta_box_upload_file").val(""),$(this).parent().siblings(".meta_box_filename").text(""),$(this).parent().siblings(".meta_box_file").removeClass("checked"),!1}),$(".meta_box_repeatable_remove").live("click",function(){return $(this).closest("tr").remove(),!1}),$(".meta_box_repeatable tbody").sortable({opacity:.6,revert:!0,cursor:"move",handle:".hndle"}),$(".sort_list").sortable({connectWith:".sort_list",opacity:.6,revert:!0,cursor:"move",cancel:".post_drop_sort_area_name",items:"li:not(.post_drop_sort_area_name)",update:function(e,t){var i=$(this).sortable("toArray"),o=$(this).attr("id");$(".store-"+o).val(i)}}),$(".sort_list").disableSelection(),$.prototype.chosen&&$(".chosen").chosen({allow_single_deselect:!0})}o(),$(".qw-conditional-fields").change(function(){o()}),a(),e($(".meta_box_upload_file_button")),$(".meta_box_repeatable_add").live("click",function(o){o.preventDefault();var a=$(this).closest(".meta_box_repeatable").find("tbody tr:last-child"),n=a.clone();n.find("select.chosen").removeAttr("style","").removeAttr("id","").removeClass("chzn-done").data("chosen",null).next().remove(),n.find("input.regular-text, textarea, select, .meta_box_upload_file ").val(""),n.find("input[type=checkbox], input[type=radio]").attr("checked",!1),n.find("span.meta_box_filename").html("");var r=n.find(".meta_box_upload_file_button"),l=n.find(".meta_box_upload_image_button"),s=n.find(".meta_box_clear_image_button");n.find("img.meta_box_preview_image").attr("src",""),e(r),t(l),i(s),a.after(n),n.find("input, textarea, select").attr("name",function(e,t){return t.replace(/(\d+)/,function(e,t){return Number(t)+1})});var d=[];return $("input.repeatable_id:text").each(function(){d.push($(this).val())}),n.find("input.repeatable_id").val(Number(Math.max.apply(Math,d))+1),$.prototype.chosen&&n.find("select.chosen").chosen({allow_single_deselect:!0}),!1}),$("a.qw-iconreference-open").click(function(e){e.preventDefault(),$("body").addClass("qwModalFormOpen"),$("#qwModalForm").height($(window).height()),$.iconTarget=$(this).attr("data-target"),$("#adminmenuwrap").css({"z-index":"10"})}),$("#qw-closemodal").on("click",function(e){$("body").removeClass("qwModalFormOpen"),$("#adminmenuwrap").css({"z-index":"1000"})}),$("#qw-iconsMarket").on("click",".icon",function(){var e=$(this).attr("class").split("icon ").join("");void 0!=$.iconTarget&&($("#"+$.iconTarget).val(e),$("#theIcon"+$.iconTarget).removeClass().addClass(e+" bigicon"),$("body").removeClass("qwModalFormOpen"),$("#adminmenuwrap").css({"z-index":"1000"}))})});