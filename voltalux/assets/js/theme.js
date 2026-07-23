/**
 * Voltalux theme scripts — vanilla JS, no dependencies.
 */
(function () {
	'use strict';

	var doc = document;
	var body = doc.body;
	var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

	/* ---- Sticky header ---- */
	var header = doc.querySelector('.vlx-site-header');
	if (header) {
		var onScroll = function () {
			header.classList.toggle('is-stuck', window.scrollY > 30);
		};
		onScroll();
		window.addEventListener('scroll', onScroll, { passive: true });
	}

	/* ---- Mobile menu ---- */
	var burger = doc.querySelector('.vlx-burger');
	var mnav = doc.querySelector('.vlx-m-nav');
	var mclose = doc.querySelector('.vlx-m-close');

	function openMenu() { body.classList.add('menu-open'); if (burger) { burger.setAttribute('aria-expanded', 'true'); } }
	function closeMenu() { body.classList.remove('menu-open'); if (burger) { burger.setAttribute('aria-expanded', 'false'); } }
	function toggleMenu() { body.classList.contains('menu-open') ? closeMenu() : openMenu(); }

	if (burger) { burger.addEventListener('click', toggleMenu); }
	if (mclose) { mclose.addEventListener('click', closeMenu); }
	doc.addEventListener('keyup', function (e) { if (e.key === 'Escape') { closeMenu(); } });

	/* ---- Mobile accordions ---- */
	doc.querySelectorAll('.vlx-m-acc__btn').forEach(function (btn) {
		btn.addEventListener('click', function () {
			var acc = btn.closest('.vlx-m-acc');
			if (!acc) { return; }
			var open = acc.classList.toggle('is-open');
			btn.setAttribute('aria-expanded', open ? 'true' : 'false');
		});
	});

	/* ---- Close menu when a real link is tapped ---- */
	if (mnav) {
		mnav.addEventListener('click', function (e) {
			var a = e.target.closest('a');
			if (a) { closeMenu(); }
		});
	}

	/* ---- Reveal on scroll ---- */
	var reveals = doc.querySelectorAll('.vlx-reveal');
	if (reveals.length && 'IntersectionObserver' in window && !reduce) {
		var io = new IntersectionObserver(function (entries) {
			entries.forEach(function (entry) {
				if (entry.isIntersecting) { entry.target.classList.add('is-in'); io.unobserve(entry.target); }
			});
		}, { rootMargin: '0px 0px -8% 0px', threshold: 0.08 });
		reveals.forEach(function (el, i) {
			el.style.transitionDelay = (Math.min(i % 4, 3) * 70) + 'ms';
			io.observe(el);
		});
	} else {
		reveals.forEach(function (el) { el.classList.add('is-in'); });
	}

	/* ---- Hero video ---- */
	var video = doc.querySelector('.vlx-hero__media video');
	if (video) {
		if (reduce) { video.removeAttribute('autoplay'); video.pause(); }
		else {
			var pp = video.play(); if (pp && pp.catch) { pp.catch(function () {}); }
			if ('IntersectionObserver' in window) {
				new IntersectionObserver(function (entries) {
					entries.forEach(function (en) { en.isIntersecting ? video.play().catch(function () {}) : video.pause(); });
				}, { threshold: 0.05 }).observe(video);
			}
		}
	}

	/* ---- Floating CTA hides over the footer ---- */
	var floating = doc.querySelector('.vlx-floating');
	var footer = doc.querySelector('.vlx-site-footer');
	if (floating && footer && 'IntersectionObserver' in window) {
		new IntersectionObserver(function (entries) {
			entries.forEach(function (en) { floating.classList.toggle('is-hide', en.isIntersecting); });
		}, { threshold: 0.05 }).observe(footer);
	}

	/* ---- Smooth-scroll same-page anchors ---- */
	doc.querySelectorAll('a[href^="#"]:not([href="#"])').forEach(function (a) {
		a.addEventListener('click', function (e) {
			var target = doc.querySelector(a.getAttribute('href'));
			if (target) {
				e.preventDefault();
				target.scrollIntoView({ behavior: reduce ? 'auto' : 'smooth', block: 'start' });
			}
		});
	});
})();
