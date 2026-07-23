/**
 * Live preview for postMessage Customizer settings.
 */
(function () {
	'use strict';
	if (typeof wp === 'undefined' || !wp.customize) { return; }

	wp.customize('blogname', function (value) {
		value.bind(function (to) {
			var el = document.querySelector('.vlx-brand--text');
			if (el) { el.textContent = to; }
			document.querySelectorAll('[data-vlx-blogname]').forEach(function (n) { n.textContent = to; });
		});
	});

	wp.customize('voltalux_accent', function (value) {
		value.bind(function (to) {
			document.documentElement.style.setProperty('--vlx-green', to);
		});
	});
})();
