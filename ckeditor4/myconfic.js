CKEDITOR.editorConfig = function( config ) {
	config.toolbar = [
		{ name: 'insert', items: [ 'HorizontalRule' ] },
		{ name: 'basicstyles', items: [ 'Bold', 'Italic'] },
		{ name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent' ] },
		{ name: 'styles', items: [ 'Styles', 'Format' ] }
	];
	config.width = 'auto';
	config.height = '15rem';

};