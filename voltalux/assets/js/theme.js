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
		var stuck = false;
		var onScroll = function () {
			var s = window.scrollY > 30;
			if (s !== stuck) { stuck = s; header.classList.toggle('is-stuck', s); }
		};
		onScroll();
		window.addEventListener('scroll', onScroll, { passive: true });
	}

	/* ---- Mobile menu ---- */
	var burger = doc.querySelector('.vlx-burger');
	var mnav = doc.querySelector('.vlx-m-nav');
	var mclose = doc.querySelector('.vlx-m-close');
	var mbackdrop = doc.querySelector('.vlx-m-backdrop');

	function openMenu() { body.classList.add('menu-open'); if (burger) { burger.setAttribute('aria-expanded', 'true'); } }
	function closeMenu() { body.classList.remove('menu-open'); if (burger) { burger.setAttribute('aria-expanded', 'false'); } }
	function toggleMenu() { body.classList.contains('menu-open') ? closeMenu() : openMenu(); }

	if (burger) { burger.addEventListener('click', toggleMenu); }
	if (mclose) { mclose.addEventListener('click', closeMenu); }
	if (mbackdrop) { mbackdrop.addEventListener('click', closeMenu); }
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

	/* ---- Offerte drawer ---- */
	function openDrawer() {
		body.classList.remove('menu-open');
		if (burger) { burger.setAttribute('aria-expanded', 'false'); }
		body.classList.add('drawer-open');
		var first = doc.querySelector('.vlx-drawer__panel input, .vlx-drawer__panel select');
		if (first) { setTimeout(function () { first.focus(); }, 450); }
	}
	function closeDrawer() { body.classList.remove('drawer-open'); }

	doc.querySelectorAll('[data-vlx-open="offerte"]').forEach(function (el) {
		var moved = false;
		el.addEventListener('touchstart', function () { moved = false; }, { passive: true });
		el.addEventListener('touchmove', function () { moved = true; }, { passive: true });
		// touchend + preventDefault suppresses the ghost click so it opens on the FIRST tap (iOS Safari).
		el.addEventListener('touchend', function (e) { if (!moved) { e.preventDefault(); openDrawer(); } }, { passive: false });
		el.addEventListener('click', function (e) { e.preventDefault(); openDrawer(); });
	});
	doc.querySelectorAll('[data-vlx-close]').forEach(function (el) {
		el.addEventListener('click', closeDrawer);
	});
	doc.addEventListener('keyup', function (e) { if (e.key === 'Escape') { closeDrawer(); } });

	/* ---- Reveal on scroll ----
	 * Fire EARLY (a chunk of viewport before the element enters) so on a fast
	 * scroll the section is already faded in by the time it reaches the fold —
	 * no "bare section, then it pops" flash. No will-change churn: transform +
	 * opacity transitions are GPU-composited automatically, and skipping it
	 * avoids promoting dozens of permanent layers (a real scroll-jank source). */
	var reveals = doc.querySelectorAll('.vlx-reveal');
	if (reveals.length && 'IntersectionObserver' in window && !reduce) {
		var io = new IntersectionObserver(function (entries) {
			entries.forEach(function (entry) {
				if (!entry.isIntersecting) { return; }
				entry.target.classList.add('is-in');
				io.unobserve(entry.target);
			});
		}, { rootMargin: '0px 0px 22% 0px', threshold: 0 });
		reveals.forEach(function (el, i) {
			el.style.transitionDelay = (Math.min(i % 3, 2) * 40) + 'ms';
			io.observe(el);
		});
	} else {
		reveals.forEach(function (el) { el.classList.add('is-in'); });
	}

	/* ---- Hero video — bullet-proof muted autoplay (iOS Safari + Android) ---- */
	var video = doc.querySelector('.vlx-hero__media video');
	if (video) {
		// Muted + inline MUST be set (as BOTH attribute and property) before play()
		// or mobile browsers refuse muted autoplay.
		video.muted = true;
		video.defaultMuted = true;
		video.setAttribute('muted', '');
		video.playsInline = true;
		video.setAttribute('playsinline', '');
		video.setAttribute('webkit-playsinline', '');

		if (reduce) {
			// Respect "reduce motion": show the first frame, don't loop it.
			video.removeAttribute('autoplay');
			video.addEventListener('loadeddata', function () { try { video.pause(); } catch (e) {} });
		} else {
			var offscreen = false;
			var tryPlay = function () {
				if (offscreen || !video.paused) { return; }
				video.muted = true; // some Android browsers silently unmute on (re)load
				var p = video.play();
				if (p && p.catch) { p.catch(function () {}); }
			};
			// Retry on every readiness/buffering milestone. These listeners stay
			// attached, so even a slow-buffering large file keeps trying as data
			// arrives — no fixed give-up window like before.
			['loadstart', 'loadedmetadata', 'loadeddata', 'canplay', 'canplaythrough', 'progress', 'suspend', 'stalled', 'waiting'].forEach(function (ev) {
				video.addEventListener(ev, tryPlay);
			});
			tryPlay();
			// Safety-net poll (first ~40s) for browsers that defer the autoplay decision.
			var tries = 0;
			var poll = setInterval(function () {
				tries++;
				if (!video.paused || tries > 80) { clearInterval(poll); return; }
				tryPlay();
			}, 500);
			// Absolute last resort — the first interaction anywhere unlocks playback.
			// This only matters when the OS blocks autoplay (iOS Low Power Mode /
			// Android Data Saver); nothing a website does can override that.
			var kick = function () { tryPlay(); };
			['touchstart', 'pointerdown', 'click', 'scroll', 'keydown'].forEach(function (ev) {
				window.addEventListener(ev, kick, { passive: true });
			});
			// Pause fully off-screen to save battery/data; resume when the hero returns.
			if ('IntersectionObserver' in window) {
				new IntersectionObserver(function (entries) {
					entries.forEach(function (en) {
						offscreen = !en.isIntersecting;
						if (en.isIntersecting) { tryPlay(); } else { try { video.pause(); } catch (e) {} }
					});
				}, { threshold: 0.01 }).observe(video);
			}
			document.addEventListener('visibilitychange', function () {
				if (!document.hidden) { tryPlay(); }
			});
		}
	}

	/* ---- Gratis huisscan wizard ---- */
	(function () {
		var root = doc.querySelector('[data-vlx-hsc]');
		if (!root) { return; }

		var HSC = window.voltaluxHsc || {};
		var i18n = HSC.i18n || {};
		var panel = root.querySelector('.vlx-hsc__panel');
		var progress = root.querySelector('[data-vlx-hsc-progress]');
		var stepLabel = root.querySelector('[data-vlx-hsc-steplabel]');
		var barFill = root.querySelector('[data-vlx-hsc-barfill]');
		var foot = root.querySelector('[data-vlx-hsc-foot]');
		var prevBtn = root.querySelector('[data-vlx-hsc-prev]');
		var nextBtn = root.querySelector('[data-vlx-hsc-next]');
		var nextLbl = root.querySelector('[data-vlx-hsc-nextlbl]');
		var errEl = root.querySelector('[data-vlx-hsc-error]');
		var doneMsg = root.querySelector('[data-vlx-hsc-donemsg]');
		var scroller = root.querySelector('.vlx-hsc__steps');
		var modalForm = root.querySelector('[data-vlx-hsc-form]');

		var SEQ = ['address', 'products', 'situation', 'contact', 'success'];
		var PC_RE = /^\d{4}[A-Z]{2}$/;
		var state = { postcode: '', huisnummer: '', toevoeging: '', adres: '', products: [] };
		var current = 'address';
		var startAt = 'address';
		var lastFocus = null;
		var lookupTimer = null;

		function stepEl(name) { return root.querySelector('.vlx-hsc-step[data-step="' + name + '"]'); }
		function showErr(m) { if (errEl) { errEl.textContent = m || ''; } }
		function clearErr() { showErr(''); }
		function pcClean() { return (state.postcode || '').replace(/\s+/g, '').toUpperCase(); }

		/* ---- Live address lookup (PDOK Locatieserver) ---- */
		function setResolved(text, cls) {
			doc.querySelectorAll('[data-vlx-hsc-address]').forEach(function (el) {
				el.textContent = text || '';
				el.classList.remove('is-searching', 'is-error');
				if (cls) { el.classList.add(cls); }
			});
		}
		function doLookup() {
			var pc = pcClean();
			var nr = (state.huisnummer || '').trim();
			if (!PC_RE.test(pc) || !nr) { state.adres = ''; setResolved('', null); return; }
			if (!HSC.geocode || !window.fetch) { return; }
			setResolved(i18n.searching || 'Adres zoeken…', 'is-searching');
			var q = pc + ' ' + nr + (state.toevoeging ? '-' + state.toevoeging.trim() : '');
			var url = HSC.geocode + '?fl=weergavenaam,straatnaam,huis_nlt,woonplaatsnaam&rows=1&fq=type:adres&q=' + encodeURIComponent(q);
			fetch(url, { headers: { Accept: 'application/json' } })
				.then(function (r) { return r.ok ? r.json() : Promise.reject(); })
				.then(function (j) {
					var docs = j && j.response && j.response.docs;
					if (docs && docs.length) {
						var d = docs[0];
						state.adres = ((d.straatnaam || '') + ' ' + (d.huis_nlt || nr) + ', ' + (d.woonplaatsnaam || '')).trim();
						setResolved(state.adres, null);
					} else {
						state.adres = '';
						setResolved(i18n.notFound || '', 'is-error');
					}
				})
				.catch(function () { state.adres = ''; setResolved(i18n.notFound || '', 'is-error'); });
		}
		doc.querySelectorAll('[data-vlx-hsc-field]').forEach(function (inp) {
			inp.addEventListener('input', function () {
				var f = inp.getAttribute('data-vlx-hsc-field');
				state[f] = inp.value;
				doc.querySelectorAll('[data-vlx-hsc-field="' + f + '"]').forEach(function (o) { if (o !== inp) { o.value = inp.value; } });
				clearTimeout(lookupTimer);
				lookupTimer = setTimeout(doLookup, 400);
			});
		});

		/* ---- Product multi-select ---- */
		root.querySelectorAll('[data-vlx-hsc-product]').forEach(function (btn) {
			btn.addEventListener('click', function () {
				var v = btn.getAttribute('data-vlx-hsc-product');
				var on = btn.getAttribute('aria-pressed') === 'true';
				btn.setAttribute('aria-pressed', on ? 'false' : 'true');
				if (on) { state.products = state.products.filter(function (x) { return x !== v; }); }
				else if (state.products.indexOf(v) < 0) { state.products.push(v); }
				clearErr();
			});
		});

		/* ---- Conditional reveal (verbruik) ---- */
		root.querySelectorAll('[data-vlx-hsc-reveal]').forEach(function (rev) {
			var spec = rev.getAttribute('data-vlx-hsc-reveal').split(':');
			function upd() {
				var c = root.querySelector('input[name="' + spec[0] + '"]:checked');
				rev.classList.toggle('is-shown', !!c && c.value === spec[1]);
			}
			root.querySelectorAll('input[name="' + spec[0] + '"]').forEach(function (r) { r.addEventListener('change', upd); });
			upd();
		});

		/* ---- Step navigation ---- */
		function go(step) {
			current = step;
			root.querySelectorAll('.vlx-hsc-step').forEach(function (s) { s.classList.toggle('is-active', s.getAttribute('data-step') === step); });
			var prog = stepEl(step).getAttribute('data-progress');
			if (prog) { progress.hidden = false; if (stepLabel) { stepLabel.textContent = 'Stap ' + prog + ' van 3'; } barFill.style.width = (prog / 3 * 100) + '%'; }
			else { progress.hidden = true; }
			var isSuccess = step === 'success';
			foot.hidden = isSuccess;
			var idx = SEQ.indexOf(step), startIdx = SEQ.indexOf(startAt);
			prevBtn.style.display = (idx > startIdx && !isSuccess) ? '' : 'none';
			if (nextLbl) { nextLbl.textContent = (step === 'contact') ? 'Verstuur mijn aanvraag' : 'Volgende'; }
			clearErr();
			if (scroller) { scroller.scrollTop = 0; }
		}

		function next() {
			if (current === 'address') {
				if (!PC_RE.test(pcClean()) || !(state.huisnummer || '').trim()) { showErr('Vul een geldige postcode en huisnummer in.'); return; }
				go('products'); return;
			}
			if (current === 'products') {
				if (!state.products.length) { showErr('Kies minimaal één product.'); return; }
				go('situation'); return;
			}
			if (current === 'situation') { go('contact'); return; }
			if (current === 'contact') { submit(); return; }
		}
		function prev() {
			var idx = SEQ.indexOf(current), startIdx = SEQ.indexOf(startAt);
			if (idx > startIdx) { go(SEQ[idx - 1]); }
		}

		/* ---- Gather + submit ---- */
		function gather() {
			function val(name) { var e = root.querySelector('[name="' + name + '"]'); return e ? e.value : ''; }
			function radio(name) { var e = root.querySelector('input[name="' + name + '"]:checked'); return e ? e.value : ''; }
			var dak = [];
			root.querySelectorAll('input[name="daktype"]:checked').forEach(function (c) { dak.push(c.value); });
			return {
				products: state.products.slice(),
				postcode: state.postcode, huisnummer: state.huisnummer, toevoeging: state.toevoeging, adres: state.adres,
				verbruik_bekend: radio('verbruik_bekend'), verbruik: val('verbruik'),
				daktype: dak, bewoners: val('bewoners'),
				aanhef: val('aanhef'), voornaam: val('voornaam'), achternaam: val('achternaam'),
				email: val('email'), telefoon: val('telefoon')
			};
		}
		function submit() {
			var ok = true, firstBad = null;
			stepEl('contact').querySelectorAll('[data-vlx-hsc-required]').forEach(function (inp) {
				var isCb = inp.type === 'checkbox';
				var v = isCb ? inp.checked : (inp.value || '').trim();
				var bad = isCb ? !inp.checked : !v;
				if (!bad && inp.type === 'email') { bad = !/^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(v); }
				var field = inp.closest('.vlx-hsc-field') || inp.closest('.vlx-hsc-consent');
				if (field) { field.classList.toggle('has-error', bad); }
				if (bad && !firstBad) { firstBad = inp; }
				if (bad) { ok = false; }
			});
			if (!ok) { showErr('Controleer je gegevens en probeer het opnieuw.'); if (firstBad) { firstBad.focus(); } return; }

			var oldLbl = nextLbl ? nextLbl.textContent : '';
			nextBtn.disabled = true;
			if (nextLbl) { nextLbl.textContent = i18n.sending || 'Versturen…'; }
			var restore = function () { nextBtn.disabled = false; if (nextLbl) { nextLbl.textContent = oldLbl; } };
			var okDone = function (msg) { restore(); if (msg && doneMsg) { doneMsg.textContent = msg; } go('success'); };
			var errDone = function () { restore(); showErr(i18n.error || 'Er ging iets mis. Probeer het zo nog eens.'); };

			if (!HSC.ajax || !window.fetch) { okDone(); return; }
			var b = new URLSearchParams();
			b.set('action', 'voltalux_huisscan');
			b.set('nonce', HSC.nonce || '');
			b.set('data', JSON.stringify(gather()));
			fetch(HSC.ajax, { method: 'POST', headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, body: b.toString() })
				.then(function (r) { return r.json(); })
				.then(function (j) { if (j && j.success) { okDone(j.data && j.data.message); } else { errDone(); } })
				.catch(errDone);
		}

		/* ---- Open / close ---- */
		var modalVideo = root.querySelector('.vlx-hsc-step__media video');
		function playModalVideo() {
			if (!modalVideo) { return; }
			modalVideo.muted = true; modalVideo.setAttribute('muted', ''); modalVideo.playsInline = true;
			var p = modalVideo.play();
			if (p && p.catch) { p.catch(function () {}); }
		}
		function openAt(step) {
			startAt = step;
			lastFocus = doc.activeElement;
			root.hidden = false;
			void root.offsetWidth;
			root.classList.add('is-open');
			body.classList.add('hsc-open');
			go(step);
			playModalVideo();
			// Move focus into the dialog for a11y/Esc — target the panel (no visible focus ring).
			if (panel) { try { panel.focus({ preventScroll: true }); } catch (e) {} }
		}
		function close() {
			root.classList.remove('is-open');
			body.classList.remove('hsc-open');
			clearErr();
			if (modalVideo) { try { modalVideo.pause(); } catch (e) {} }
			var hide = function () { root.hidden = true; };
			var onEnd = function (e) { if (e.target === panel) { hide(); panel.removeEventListener('transitionend', onEnd); } };
			panel.addEventListener('transitionend', onEnd);
			setTimeout(hide, 420);
			if (lastFocus && lastFocus.focus) { try { lastFocus.focus(); } catch (e) {} }
		}

		/* ---- Triggers ---- */
		var heroForm = doc.querySelector('[data-vlx-hsc-heroform]');
		if (heroForm) {
			heroForm.addEventListener('submit', function (e) {
				e.preventDefault();
				if (PC_RE.test(pcClean()) && (state.huisnummer || '').trim()) { openAt('products'); }
				else { openAt('address'); }
			});
		}
		doc.querySelectorAll('[data-vlx-hsc-open]').forEach(function (b) {
			b.addEventListener('click', function (e) { e.preventDefault(); openAt('address'); });
		});
		if (modalForm) { modalForm.addEventListener('submit', function (e) { e.preventDefault(); next(); }); }
		nextBtn.addEventListener('click', next);
		prevBtn.addEventListener('click', prev);
		root.querySelectorAll('[data-vlx-hsc-close]').forEach(function (b) { b.addEventListener('click', close); });
		doc.addEventListener('keyup', function (e) { if (e.key === 'Escape' && !root.hidden) { close(); } });
	})();

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
		if (a.hasAttribute('data-vlx-open') || a.hasAttribute('data-vlx-hsc-open')) { return; }
		a.addEventListener('click', function (e) {
			var target = doc.querySelector(a.getAttribute('href'));
			if (target) {
				e.preventDefault();
				target.scrollIntoView({ behavior: reduce ? 'auto' : 'smooth', block: 'start' });
			}
		});
	});

	/* ---- Projecten filter ---- */
	var filterbar = doc.querySelector('[data-vlx-filterbar]');
	var filtergrid = doc.querySelector('[data-vlx-filtergrid]');
	if (filterbar && filtergrid) {
		var cards = filtergrid.querySelectorAll('[data-cat]');
		filterbar.addEventListener('click', function (e) {
			var btn = e.target.closest('[data-vlx-filter]');
			if (!btn) { return; }
			var f = btn.getAttribute('data-vlx-filter');
			filterbar.querySelectorAll('[data-vlx-filter]').forEach(function (b) {
				var on = b === btn;
				b.classList.toggle('vlx-chip--active', on);
				b.setAttribute('aria-pressed', on ? 'true' : 'false');
			});
			cards.forEach(function (c) {
				var show = (f === '*' || c.getAttribute('data-cat') === f);
				c.classList.toggle('is-hidden', !show);
			});
		});
	}
})();
