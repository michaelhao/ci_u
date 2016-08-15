/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	
	//工具列設定
	config.toolbar = 'TadToolbar';
    config.toolbar_TadToolbar =
    [
        ['Source','-','Templates','-','Cut','Copy','Paste'],
        ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
        ['Link','Unlink','Anchor'],
        ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
        '/',
        ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
        ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
        ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
        ['Format','FontSize','-','TextColor','BGColor']
    ];
	
	//開啟圖片上傳功能
	config.filebrowserBrowseUrl = '../../public/backend/ckfinder/ckfinder.html';
	config.filebrowserImageBrowseUrl = '../../public/backend/ckfinder/ckfinder.html?Type=Images';
	config.filebrowserFlashBrowseUrl = '../../public/backend/ckfinder/ckfinder.html?Type=Flash';
	config.filebrowserUploadUrl = '../../public/backend/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
	config.filebrowserImageUploadUrl = '../../public/backend/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
	config.filebrowserFlashUploadUrl = '../../public/backend/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
};
