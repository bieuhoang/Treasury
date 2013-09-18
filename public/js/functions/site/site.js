$(function() {
	cms.extend(cms.modules, {
		site: {
			init: function() {
				console.log('inited');
			}
		}
	});

	cms.modules.run('site');

	cms.extend(cms.modules, {
		user: {
			newObj: {
				init: function() {
					console.log('modules user inited');
				},
				alert: function(msg) {
					alert(msg);
				}
			}
		}
	});
});