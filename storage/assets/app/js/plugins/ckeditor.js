$(function() {      

	$('.editor').each(function(e){

		CKEDITOR.replace( this.name, {
			//language: 'id',
			extraPlugins: 'autogrow,toc,codesnippet,htmlbuttons,a11ychecker,image2,wordcount,notification,tableresize,tableselection,uploadcare,quicktable,youtube',
			'imageResize.maxWidth': 800,
			'imageResize.maxHeight': 800,

			/* auto grow plugin */
			autoGrow_minHeight: 300,
			autoGrow_maxHeight: 600,
			autoGrow_onStartup: true,

			uploadcare: {publicKey: 'ef9642d97f5f30b0bee8'},

			allowedContent: true,
			skin: 'kama',
			filebrowserBrowseUrl: ck_filebrowserBrowseUr,
			filebrowserImageBrowseUrl: ck_filebrowserImageBrowseUr,
			filebrowserUploadUrl: false,
			filebrowserImageBrowseLinkUrl: ck_filebrowserImageBrowseLinkUr,
			image2_alignClasses: [ 'align-left', 'align-center', 'align-right' ],
			codeSnippet_theme: 'monokai',

			/* config text format */
			format_tags: 'p;h2;h3;h4;h5;h6;pre;address;div',

			/* remove */
			removePlugins: 'forms,bidi,cloudservices,easyimage,image,resize',
			removeDialogTabs: 'link:upload;image:upload;flash:upload',
			removeButtons: 'Save,NewPage,Preview,Print,Cut,Copy,Paste,PasteText,PasteFromWord,About,Underline,Subscript,Superscript,spellchecker,SelectAll,Scayt,CreateDiv,Outdent,Indent,Language,Anchor,Flash,HorizontalRule',
			toolbarGroups: [
			{ name: 'document',    groups: [ 'mode', 'document', 'doctools' ] },
			{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
			{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
			{ name: 'links' },
			{ name: 'insert' },
			{ name: 'forms' },
			{ name: 'tools' },
			{ name: 'others' },
			'/',
			{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
			{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
			{ name: 'styles' },
			{ name: 'colors' },
			{ name: 'about' }
			]
		});

		CKEDITOR.config.htmlbuttons =   [
		{
			name:'AdsButton',
			icon:'icon1.png',
			html:'<span class="content_ads">[content_ads]</span>',
			title:'Insert Ads ShortCode'
		}
		];    

		CKEDITOR.config.wordcount = {
			/*  Whether or not you want to show the Paragraphs Count*/
			showParagraphs: true,
			/*  Whether or not you want to show the Word Count*/
			showWordCount: true,
			/*  Whether or not you want to show the Char Count*/
			showCharCount: true,
			/*  Whether or not you want to count Spaces as Chars*/
			countSpacesAsChars: false,
			/*  Whether or not to include Html chars in the Char Count*/
			countHTML: false,
			/*  Maximum allowed Word Count, -1 is default for unlimited*/
			maxWordCount: -1,
			/*  Maximum allowed Char Count, -1 is default for unlimited*/
			maxCharCount: -1,
			/* Add filter to add or remove element before counting (see CKEDITOR.htmlParser.filter), Default value : null (no filter) */
			filter: new CKEDITOR.htmlParser.filter({
				elements: {
					div: function( element ) {
						if(element.attributes.class == 'mediaembed') {
							return false;
						}
					}
				}
			})
		};	 
	});        
});
// End       