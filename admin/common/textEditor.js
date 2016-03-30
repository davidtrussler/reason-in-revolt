/* TEXTEDITOR.JS
 * A class to implement a WYSIWYG text editor
 * Version 1.0
 * http://www.davidtrussler.net
 */

function TextEditor() {
}

TextEditor.prototype.setField = function(field) {
	var fieldArray = field;
	var viewMode = 1; // WYSIWYG

	// loop through fields 
	for (var i = 0; i < fieldArray.length; i++) {
		// extract content
		var selectedField = fieldArray[i]; 
		var text = selectedField.value; 

		// get attributes and styles of current field
		var j = 0; // , k = 0; l = 0; 
		// var attributes = selectedField.attributes; 
		// var styles = {}; 
		var styles = window.getComputedStyle(selectedField, null); 
		var newIFrame = document.createElement('iframe');

		// replace field with an iFrame
		selectedField.parentNode.replaceChild(newIFrame, selectedField); 

		// insert content into iFrame and make editable
		newIFrame.contentDocument.open('text/html', 'replace');
		newIFrame.contentDocument.write(text);
		newIFrame.contentDocument.close();
		newIFrame.contentDocument.designMode = 'On';

		// add controls
		var styleControls = document.createElement('ul'); 
		var controlArray = new Array(
			// these values from http://www.quirksmode.org/dom/execCommand.html
			// see that link for browser compatibility
			/* 
			'backcolor', 
			'bold', 
			'contentReadOnly', 
			'copy',
			'createbookmark',
			'createlink',
			'cut',
			'decreasefontsize',
			'delete',
			'fontname',
			'fontsize',
			'forecolor',
			'formatblock',
			'heading',
			'hilitecolor',
			'increasefontsize',
			'indent',
			'inserthorizontalrule',
			'inserthtml',
			'insertimage',
			'insertorderedlist',
			'insertunorderedlist',
			'insertparagraph',
			'italic',
			'justifycenter',
			'justifyfull',
			'justifyleft',
			'justifyright',
			'multipleselection',
			'outdent',
			'overwrite',
			'paste',
			'print',
			'redo',
			'refresh',
			'removeformat',
			'saveas',
			'selectall',
			'strikethrough',
			'styleWithCSS',
			'subscript',
			'superscript',
			'unbookmark',
			'underline',
			'undo',
			'unlink'
			*/
		); 
		
		for (var k = 0; k < controlArray.length; k++) {
			var control = controlArray[k]; 
			
			$(styleControls)
				.append('<li><button>' + control + '</button></li>'); 
		}
		
		$(styleControls).find('button').each(function() {
			$(this).bind('click', function() {
				command = $(this).text(); 
				newIFrame.contentDocument.execCommand(command, false, null) ;
				return false; 
			})
		})

		$(styleControls).attr('class', 'styleControls'); 
		// $(styleControls).attr('id', 'styleControls'); 

		$(newIFrame).before(styleControls); 
		
		// view mode
		var viewModeControl = document.createElement('ul'); 
		$(viewModeControl).attr('class', 'viewModeControl'); 
		// $(viewModeControl).attr('id', 'viewModeControl'); 
		$(newIFrame).before(viewModeControl); 

		function writeViewMode() {
			$(viewModeControl).html(
				'<li><button>view HTML</button></li>' + 
				'<li><button>view WYSIWYG</button></li>'
			);
		}

		writeViewMode(); 

		// switch content from html to wysiwyg and back
		var frameBody = newIFrame.contentDocument.getElementsByTagName('body')[0]; 

		$(viewModeControl).find('button').each(function() {
			$(this).bind('click', function() {
				console.log('change view!'); 
				console.log(viewMode); 
				
				if (viewMode == 1) {
					var iHTML = frameBody.innerHTML; // .replace('&', '\&');
					// var iHTML = $(frameBody).html(); // .replace('&', '\&');
					frameBody.textContent = iHTML;
					// frameBody.execCommand('inserthtml', false, iHTML);
					$(styleControls).css('display', 'none'); 
					viewMode = 2; // HTML

					console.log(iHTML); 
				} else {
					var iText = frameBody.textContent; 
					frameBody.innerHTML = iText;
					$(styleControls).css('display', 'block'); 
					viewMode = 1; // WYSIWYG
					// writeViewMode(); 

					console.log(iText); 
				}

				return false;
			})
		})

		// apply attributes and styles to iFrame and controls
		while (styles[j] != '') {
			styleName = styles[j]; 
			
			if (styles[styleName]) {
				$(newIFrame).css(styleName, styles[styleName]); 
				// newIFrame.style.styleName = styles[styleName]; 
			}

			j++; 
		}

		// add a hidden iFrame to contain content prior to submitting
		var container = document.createElement('textarea');
		var submitBtn = $('button[type=submit]'); 
		$(submitBtn).before(container); 
		
		$(submitBtn).bind('click', function() {
			console.log(this); 
			
			var iHTML = frameBody.innerHTML; // .replace('&', '\&');
			// hiddenIFrame.textContent = iHTML;

			console.log(iHTML); 
			
			return false; 
		}); 

		/* 
		while (attributes[k]) {
			var attribute = attributes[k]; 
			// console.log(attribute.valueOf()); 
			
			$(ifr).attr(attribute); 
			k++; 
		}
		*/

		/*
		function changeViewMode() {
			console.log('change view!'); 
			console.log(viewMode); 
			
			if (viewMode == 1) {
				var iHTML = newIFrame.contentDocument.innerHTML;
				newIFrame.contentDocument.textContent = iHTML;
				$(styleControls).css('display', 'none'); 
				viewMode = 2; // HTML
				writeViewMode(); 
				
				console.log(iHTML); 
			} else {
				var iText = newIFrame.contentDocument.textContent;
				$(styleControls).css('display', 'block'); 
				newIFrame.contentDocument.innerHTML = iText;
				viewMode = 1; // WYSIWYG
				writeViewMode(); 
			}

			return false;
		}
		*/
	}
}