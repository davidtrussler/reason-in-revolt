$(document).ready(function() {
	// warn on deleted actions
	warnDelete(); 
	// textEditor(); 
}); 

function warnDelete() {
	var deleteArray = $('form[name=deleteComment]'); 
	$(deleteArray).each(function() {
		$(this).bind('submit', function() {
			var del = window.confirm('Are you sure you want to delete that comment?'); 
			if (!del) {
				return false; 
			} else {
				return true; 
			}
		}); 
	}); 
}

// create a text editor for body
function textEditor() {
	var field = $('form').find('.wysiwyg'); 

	// console.log(field); 

	var editor = new TextEditor(); 

	// console.log(editor); 

	var field_set = editor.setField(field); 

	console.log(field_set); 
}

// editor.setField(field); 

// console.log(editor.field); 