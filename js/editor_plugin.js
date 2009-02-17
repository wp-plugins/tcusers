(function() {
	// Load plugin specific language pack
//	tinymce.PluginManager.requireLangPack('tcusers');

	tinymce.create('tinymce.plugins.TCUsersPlugin', {
		/**
		 * Initializes the plugin, this will be executed after the plugin has been created.
		 * This call is done before the editor instance has finished it's initialization so use the onInit event
		 * of the editor instance to intercept that event.
		 *
		 * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
		 * @param {string} url Absolute URL to where the plugin is located.
		 */
		init : function(ed, url) {
			// Register the command so that it can be invoked by using tinyMCE.activeEditor.execCommand('mceTCUsers');
			ed.addCommand('mceTCUsers', function() {
				var content = tinyMCE.activeEditor.selection.getContent({format : 'raw'});
				var newcontent = '[tcuser]' + content + '[/tcuser]';
				
				tinyMCE.activeEditor.selection.setContent(newcontent);
			});
			
			// Register TopCoder users button
			ed.addButton('tcusers', {
				title : 'TopCoder user',
				cmd : 'mceTCUsers',
				image : url + '/img/topcoder.ico'
			});
			
		},

		/**
		 * Returns information about the plugin as a name/value array.
		 * The current keys are longname, author, authorurl, infourl and version.
		 *
		 * @return {Object} Name/value array containing information about the plugin.
		 */
		getInfo : function() {
			return {
				longname : 'TopCoder users plugin',
				author : 'd2nx',
				authorurl : 'http://d2nx.ru',
				infourl : 'http://wordpress.org/extend/plugins/tcusers/',
				version : "1.0"
			};
		}
	});

	// Register plugin
	tinymce.PluginManager.add('tcusers', tinymce.plugins.TCUsersPlugin);
})();
