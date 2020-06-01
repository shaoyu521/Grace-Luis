(function() {
	tinymce.create('tinymce.plugins.zmgcp', {
		init: function(ed, url) {
			ed.addCommand('zmgcp',
			function() {
				ed.windowManager.open({
					title: '插入代码',
					file: url + '/insert-code.php',
					width: 500,
					height: 410,
					inline: 1
				},
				{
					plugin_url: url // Plugin absolute URL
				});
			});

			ed.addButton('zmgcp', {
				title: '代码高亮',
				cmd: 'zmgcp',
				icon: 'code'

			});
		},
		createControl: function(n, cm) {
			return null;
		},
		getInfo: function() {
			return null;
		}
	});
	tinymce.PluginManager.add('zmgcp', tinymce.plugins.zmgcp);
})();