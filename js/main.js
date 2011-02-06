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
			success: function(data, status) {
				ui.item.parents('.column').trigger('update-estimation');
				ui.sender.parents('.column').trigger('update-estimation');
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				alert(XMLHttpRequest.responseText);
			}
		}, options || {});

		$.ajax(options);
	});
	
	// load BurnDown chart for a sprint
	$('.ajaxLoad').overlay({
		onBeforeLoad: function() {
			// grab wrapper element inside content
			var wrap = this.getOverlay().find(".contentWrap");
			// load the page specified in the trigger
			wrap.load(this.getTrigger().attr("href"), function(response, status, xhr) {
				if (status == "error") {
					var msg = "Sorry but there was an error: ";
    				wrap.html(msg + xhr.status + " " + xhr.responseText);
  				}
			});
		}
	});

	// setup estimation time editable select box
	$(".task .task-time").editable(App.base_url + '/issue/quickUpdate', { 
		indicator : '<img src="' + App.loader_img + '" alt="Saving..."/>',
		data   : "{'1':'1','2':'2','3':'3','5':'5','8':'8','13':'13','20':'20'}",
		type   : 'select',
		submit : 'OK',
		cancel : 'Close',
		style  : 'inherit',
		callback: function(value, settings) {
			$(this).parents('.column').trigger('update-estimation');
		}
  	});

	// setup estimation time editable select box
	$(".task .task-title").editable(App.base_url + '/issue/quickUpdate', { 
		indicator : '<img src="' + App.loader_img + '" alt="Saving..."/>',
		type   : 'textarea',
		loadurl: App.base_url + '/issue/load4Edit',
		height : 'none',
		submit : 'OK',
		cancel : 'Close',
		onblur : 'ignore'
  	});
	
	var priority_classes = ['priority-0', 'priority-1', 'priority-2'];
	// setup priority editable select box
	$(".task .task-priority").editable(App.base_url + '/issue/quickUpdate', { 
		indicator : '<img src="' + App.loader_img + '" alt="Saving..."/>',
		data   : "{'0':'Must have','1':'Should have','2':'Would have'}",
		type   : 'select',
		submit : 'OK',
		cancel : 'Close',
		style  : 'inherit',
		callback: function(value, settings) {
			var self = $(this);
			for(var i = 0; i < priority_classes.length; i++) {
				self.removeClass(priority_classes[i]);
			}
			eval('var k = ' + value);
			self.addClass('priority-' + k[0]).html(k[1]);
		}
  	});
  
  	$('.column').bind('update-estimation', function(event) {
		var self = $(this),
			sumPoint = 0;
		self.find('.column-header .backlog-point').html('<img src="' + App.loader_img + '" alt="Loading..."/>');
		self.find('.task .task-time').each(function(idx, item) {
			sumPoint += parseInt($(item).html());
		});
		self.find('.column-header .backlog-point').html(sumPoint);
  	});

});

function quickUpdateIssue(value, settings) {
	var url = this.title,
		id  = this.id,
		options = $.extend({
			type: 'POST',
			url: url,
			data: {id: id, value: value},
			success: function(data,status) {
				console.log(data);
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				alert(XMLHttpRequest.responseText);
			}
		}, options || {});

	$.ajax(options);	
}
