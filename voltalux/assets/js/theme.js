/**
 * Voltalux theme scripts — vanilla JS, no dependencies.
 */
(function () {
	'use strict';

	var doc = document;
	var body = doc.body;
	var reduceMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

	/* ---------------------------------------------------------------
	 * Sticky header: toggle .is-stuck once the hero is scrolled past.
	 * ------------------------------------------------------------- */
	var header = doc.querySelector('.vlx-header');
	if (header) {
		var stuckAt = 40;
		var onScroll = function () {
			if (window.scrollY > stuckAt) {
				header.classList.add('is-stuck');
			} else {
				header.classList.remove('is-stuck');
			}
		};
		onScroll();
		window.addEventListener('scroll', onScroll, { passive: true });
	}

	/* ---------------------------------------------------------------
	 * Mobile menu drawer.
	 * ------------------------------------------------------------- */
	var burger = doc.querySelector('.vlx-burger');
	var drawer = doc.querySelector('.vlx-drawer');
	var overlay = doc.querySelector('.vlx-drawer__overlay');
	var closeBtn = doc.querySelector('.vlx-drawer__close');

	function openMenu() {
		body.classList.add('menu-open');
		if (burger) { burger.setAttribute('aria-expanded', 'true'); }
		body.style.overflow = 'hidden';
	}
	function closeMenu() {
		body.classList.remove('menu-open');
		if (burger) { burger.setAttribute('aria-expanded', 'false'); }
		body.style.overflow = '';
	}
	function toggleMenu() {
		if (body.classList.contains('menu-open')) { closeMenu(); } else { openMenu(); }
	}

	if (burger) { burger.addEventListener('click', toggleMenu); }
	if (overlay) { overlay.addEventListener('click', closeMenu); }
	if (closeBtn) { closeBtn.addEventListener('click', closeMenu); }
	doc.addEventListener('keyup', function (e) {
		if (e.key === 'Escape') { closeMenu(); }
	});
	// Close after clicking a link inside the drawer.
	if (drawer) {
		drawer.addEventListener('click', function (e) {
			var link = e.target.closest('a');
			if (link && !link.parentElement.classList.contains('menu-item-has-children')) {
				closeMenu();
			}
		});
		// Accordion for sub-menus in the drawer.
		drawer.querySelectorAll('.menu-item-has-children > a').forEach(function (a) {
			a.addEventListener('click', function (e) {
				var sub = a.parentElement.querySelector('.sub-menu');
				if (sub && a.getAttribute('href') === '#') {
					e.preventDefault();
					a.parentElement.classList.toggle('is-open');
				}
			});
		});
	}

	/* ---------------------------------------------------------------
	 * Reveal-on-scroll.
	 * ------------------------------------------------------------- */
	var revealEls = doc.querySelectorAll('.vlx-reveal');
	if (revealEls.length && 'IntersectionObserver' in window && !reduceMotion) {
		var io = new IntersectionObserver(function (entries) {
			entries.forEach(function (entry) {
				if (entry.isIntersecting) {
					entry.target.classList.add('is-in');
					io.unobserve(entry.target);
				}
			});
		}, { rootMargin: '0px 0px -8% 0px', threshold: 0.08 });
		revealEls.forEach(function (el, i) {
			el.style.transitionDelay = (Math.min(i % 4, 3) * 80) + 'ms';
			io.observe(el);
		});
	} else {
		revealEls.forEach(function (el) { el.classList.add('is-in'); });
	}

	/* ---------------------------------------------------------------
	 * Hero video: respect reduced-motion + pause off-screen.
	 * ------------------------------------------------------------- */
	var heroVideo = doc.querySelector('.vlx-hero__media video');
	if (heroVideo) {
		if (reduceMotion) {
			heroVideo.removeAttribute('autoplay');
			heroVideo.pause();
		} else {
			var playPromise = heroVideo.play();
			if (playPromise && playPromise.catch) { playPromise.catch(function () {}); }
			if ('IntersectionObserver' in window) {
				var vio = new IntersectionObserver(function (entries) {
					entries.forEach(function (entry) {
						if (entry.isIntersecting) { heroVideo.play().catch(function () {}); }
						else { heroVideo.pause(); }
					});
				}, { threshold: 0.05 });
				vio.observe(heroVideo);
			}
		}
	}

	/* ---------------------------------------------------------------
	 * Floating CTA: hide when the footer is in view.
	 * ------------------------------------------------------------- */
	var floating = doc.querySelector('.vlx-floating');
	var footer = doc.querySelector('.vlx-footer');
	if (floating && footer && 'IntersectionObserver' in window) {
		var fio = new IntersectionObserver(function (entries) {
			entries.forEach(function (entry) {
				floating.classList.toggle('is-hidden', entry.isIntersecting);
			});
		}, { threshold: 0.05 });
		fio.observe(footer);
	}

	/* ---------------------------------------------------------------
	 * Smooth-scroll for on-page anchors.
	 * ------------------------------------------------------------- */
	doc.querySelectorAll('a[href^="#"]:not([href="#"])').forEach(function (a) {
		a.addEventListener('click', function (e) {
			var id = a.getAttribute('href');
			var target = doc.querySelector(id);
			if (target) {
				e.preventDefault();
				target.scrollIntoView({ behavior: reduceMotion ? 'auto' : 'smooth', block: 'start' });
			}
		});
	});
})();
