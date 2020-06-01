function init() {
	tinyMCEPopup.resizeToInnerSize();
}

function escapeHtml(text) {
	return text.replace(/&/g, "&amp;").replace(/"/g, "&quot;").replace(/'/g, "'").replace(/</g, "&lt;").replace(/>/g, "&gt;");
}
function insertzmgcpcode() {

	var tagtext;
	var langname_ddb = document.getElementById('zmgcp_lang');
	var langname = langname_ddb.value;
	var linenumber = document.getElementById('zmgcp_linenumber').value;

	var html = escapeHtml(document.getElementById('zmgcp_code').value);

	if (langname_ddb == '123') {
		tagtext = '<pre class="prettyprint lang-' + langname + ' linenums:' + linenumber + '" >' + html + '</pre>';
	} else {
		tagtext = '<pre>' + html + '</pre>';
	}

	window.tinymce.activeEditor.insertContent(tagtext);
	tinyMCEPopup.editor.execCommand('mceRepaint');
	tinyMCEPopup.close();
	return;
}