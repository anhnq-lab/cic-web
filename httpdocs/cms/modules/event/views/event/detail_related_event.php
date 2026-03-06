<div class="event_related">
	<div class="row">
		<div class="col-xs-12">
			<div class='event_related_search row'>
				<!-- <div class="row-item col-xs-6" style="margin-bottom: 20px;">
    					<select class="form-control chosen-select"  name="event_related_category_id"  id="event_related_category_id">
    						<option value="-1">Tất cả</option>
    						<?php
							foreach ($categories as $item) {
							?>
    							<option value="<?php echo $item->id; ?>" ><?php echo $item->treename;  ?> </option>	
    						<?php } ?>
    					</select>
                    </div> -->
				<div class="row-item col-xs-6">
					<div class="input-group custom-search-form">
						<input type="text" placeholder="Tìm kiếm" name='event_related_keyword' class="form-control" value='' id='event_related_keyword' />
						<span class="input-group-btn">
							<a id='event_related_search' class="btn btn-default">
								<i class="fa fa-search"></i>
							</a>
						</span>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-md-6">
			<div class='title-related'><?php echo FSText::_('Danh sách sự kiện liên quan'); ?></div>
			<div id='event_related_l'>
				<div id='event_related_search_list'>
					<input type="hidden" value="<?php echo @$data->event_related ?>" id="str_related" name="str_related" />
				</div>
			</div>
		</div>

		<div class="col-xs-12 col-md-6">
			<div id='event_related_r'>
				<!--	LIST RELATE			-->
				<div class='title-related'><?php echo FSText::_('Sự kiện liên quan'); ?></div>
				<ul id='event_sortable_related'>
					<?php
					$i = 0;
					if (isset($event_related))
						foreach ($event_related as $item) {
					?>
						<li id='event_record_related_<?php echo $item->id ?>'><strong><?php echo $item->title; ?></strong>
							<a class='event_remove_relate_bt' onclick="javascript: remove_event_related(<?php echo $item->id ?>)" href="javascript: void(0)" title='Bỏ chọn'>
								<img border="0" alt="Remove" src="libraries/uploadify/delete.png">
							</a>
							<br />
							<img width="80" src="<?php echo URL_ROOT . str_replace('/original/', '/resized/', $item->image); ?>">
							<input type="hidden" name='event_record_related[]' value="<?php echo $item->id; ?>" />
						</li>
					<?php } ?>
				</ul>
				<!--	END LIST RELATE			-->
				<div id='event_record_related_continue'></div>
			</div>
		</div>

		<div class='event_close_related col-xs-12' style="display:none">
			<a href="javascript:event_close_related()"><strong class='red'>Đóng</strong></a>
		</div>

	</div>
</div>
<script type="text/javascript">
	search_event_related();
	$("#event_sortable_related").sortable();

	function event_add_related() {
		$('#event_related_l').show();
		$('#event_related_l').attr('width', '50%');
		$('#event_related_r').attr('width', '50%');
		$('.event_close_related').show();
		$('.event_add_related').hide();
	}

	function event_close_related() {
		$('#event_related_l').hide();
		$('#event_related_l').attr('width', '0%');
		$('#event_related_r').attr('width', '100%');
		$('.event_add_related').show();
		$('.event_close_related').hide();
	}
	$(document).ready(function() {
		var str_related = $('#str_related').val();
		var keyword_tag = $('#tags').val();
		if (keyword_tag) {
			$("#event_related_search_list").load("index2.php?module=event&view=event&task=ajax_get_event_related&raw=1", {
				"str_related": str_related,
				"keyword_tag": keyword_tag
			}, function() {}); //load initial records  
		}

		$('textarea#tags').on('change', function() {
			//alert(123);
			var keyword_tag = $(this).val();
			$.ajax({
				type: 'POST',
				url: 'index2.php?module=event&view=event&task=ajax_get_event_related&raw=1',
				data: {
					keyword_tag: keyword_tag,
					str_related: str_related
				},
				dataType: 'html',
				success: function(data) {
					$('#event_related_search_list').html(data);
				},
				error: function() {
					// code here
				}
			});

		});
	});

	function search_event_related() {
		$('#event_related_search').click(function() {
			var keyword = $('#event_related_keyword').val();
			var category_id = $('#event_related_category_id').val();
			var new_id = <?php echo @$data->id ? $data->id : 0 ?>;
			var str_exist = '';
			$("#event_sortable_related li input").each(function(index) {
				if (str_exist != '')
					str_exist += ',';
				str_exist += $(this).val();
			});
			$.get("index2.php?module=event&view=event&task=ajax_get_event_related&raw=1", {
				new_id: new_id,
				category_id: category_id,
				keyword: keyword,
				str_exist: str_exist
			}, function(html) {
				$('#event_related_search_list').html(html);
			});
		});
	}

	function set_event_related(id) {
		var max_related = 10;
		var length_children = $("#event_sortable_related li").length;
		if (length_children >= max_related) {
			alert('Tối đa chỉ có ' + max_related + ' tin liên quan');
			return;
		}
		var title = $('.event_related_item_' + id).html();
		var html = '<li id="event_record_related_' + id + '"><strong>' + title + '</strong><input type="hidden" name="event_record_related[]" value="' + id + '" />';
		html += '<a class="event_remove_relate_bt"  onclick="javascript: remove_event_related(' + id + ')" href="javascript: void(0)" title="Xóa"><img border="0" alt="Remove" src="libraries/uploadify/delete.png"></a>';
		html += '<hr></li>';
		$('#event_sortable_related').append(html);
		$('.event_related_item_' + id).hide();
	}

	function remove_event_related(id) {
		var str_related = $('#str_related').val();
		var keyword_tag = $('#tags').val();
		$('#event_record_related_' + id).remove();
		$('.event_related_item_' + id).show().addClass('red');
		$.ajax({
			type: 'POST',
			url: 'index2.php?module=event&view=event&task=ajax_get_event_related&raw=1',
			data: {
				id: id,
				str_related: str_related,
				keyword_tag: keyword_tag
			},
			dataType: 'html',
			success: function(data) {
				$('#event_related_search_list').html(data);
			},
			error: function() {
				// code here
			}
		});
	}
</script>
<style>
	.row-item {
		margin-bottom: 20px;
	}

	.title-related {
		background: none repeat scroll 0 0 #F0F1F5;
		font-weight: bold;
		margin-bottom: 4px;
		padding: 2px 0 4px;
		text-align: center;
		width: 100%;
	}

	#event_related_search_list,
	#event_sortable_related {
		height: 400px;
		overflow: scroll;
	}

	.event_related_item {
		border-bottom: 1px solid #EEEEEE;
		cursor: pointer;
		margin: 2px 10px;
		padding: 5px;
	}

	#event_sortable_related li {
		cursor: move;
		list-style: decimal outside none;
		margin-bottom: 8px;
	}

	.event_remove_relate_bt {
		padding-left: 10px;
	}

	.event_related table {
		margin-bottom: 5px;
	}
</style>