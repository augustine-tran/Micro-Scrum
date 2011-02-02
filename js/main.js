$(document).ready(function(){
    $('.column-body').sortable({
        connectWith: '.column-body',
        handle: '.task-header',
        cursor: 'move',
        placeholder: 'placeholder',
        forcePlaceholderSize: true,
        opacity: 0.4,
    }).disableSelection();
	
	$('.task .button-toggler').live('click', function() {
		var body = $(this).parents('.task').find('.task-body');
		body.toggle();
		return false;
	});
	
	$('#sprint_planning .column-body').bind('sortupdate', function(event, ui) {
		if (ui.sender == null) {
			return;
		}
		var itemId = ui.item.attr('id'),
			url = this.title,
			options = null;
		options = $.extend({
			type: 'POST',
			url: url,
			data: {'SprintIssueForm[itemId]': itemId},
			success: function(data,status) {
				console.log(data);
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				alert(XMLHttpRequest.responseText);
			}
		}, options || {});

		$.ajax(options);
	});
});
