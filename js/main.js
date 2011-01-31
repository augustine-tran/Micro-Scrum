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
});
