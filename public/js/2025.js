// --- Scroll Snap & Lock untuk Peta ---

const siteLoader = document.getElementById('site-loader');

function hideSiteLoader() {
  if (!siteLoader || siteLoader.dataset.hidden === '1') return;
  siteLoader.dataset.hidden = '1';
  siteLoader.classList.add('is-hidden');
  document.body.classList.remove('is-preloading');

  setTimeout(() => {
    siteLoader.remove();
  }, 520);
}

window.addEventListener('load', () => {
  setTimeout(hideSiteLoader, 220);
}, { once: true });

window.addEventListener('pageshow', (event) => {
  if (event.persisted) hideSiteLoader();
});

setTimeout(hideSiteLoader, 5000);

// Progress bar
window.addEventListener('scroll', () => {
  const max = document.documentElement.scrollHeight - window.innerHeight;
  document.getElementById('progress').style.width = (max > 0 ? scrollY / max * 100 : 0) + '%';
});

// Nav show/hide + active links
const nav = document.getElementById('sitenav');
const sections = document.querySelectorAll('.s-anchor');
const navLinks = document.querySelectorAll('.nav-links a');
const langBtnId = document.getElementById('lang-id');
const langBtnEn = document.getElementById('lang-en');
const hero = document.getElementById('hero');

/* hero parallax */
if (hero && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
  let rafId = null;
  const basePercent = 80; // keep boat area near bottom by default
  const parallaxFactor = 0.035; // subtle movement

  const updateHeroParallax = () => {
    rafId = null;
    const rect = hero.getBoundingClientRect();
    if (rect.bottom <= 0 || rect.top >= window.innerHeight * 1.2) return;

    const shiftPercent = basePercent + Math.round(rect.top * -parallaxFactor);
    const clamped = Math.max(55, Math.min(96, shiftPercent));
    hero.style.backgroundPosition = `center ${clamped}%`;
  };

  const requestParallaxUpdate = () => {
    if (rafId !== null) return;
    rafId = window.requestAnimationFrame(updateHeroParallax);
  };

  updateHeroParallax();
  window.addEventListener('scroll', requestParallaxUpdate, { passive: true });
  window.addEventListener('resize', requestParallaxUpdate);
}

function setGlobalLanguage(lang) {
  const target = lang === 'en' ? 'en' : 'id';
  localStorage.setItem('akurasi_lang', target);
  document.documentElement.lang = target;
  langBtnId?.classList.toggle('active', target === 'id');
  langBtnEn?.classList.toggle('active', target === 'en');

  document.querySelectorAll('iframe').forEach(frame => {
    try {
      frame.contentWindow?.postMessage({ type: 'set-language', lang: target }, '*');
    } catch (_) {}
  });
}

async function hydrateInjectedScripts(container) {
  const scripts = Array.from(container.querySelectorAll('script'));
  for (const originalScript of scripts) {
    const runtimeScript = document.createElement('script');

    Array.from(originalScript.attributes).forEach((attr) => {
      runtimeScript.setAttribute(attr.name, attr.value);
    });

    if (originalScript.src) {
      await new Promise((resolve, reject) => {
        runtimeScript.addEventListener('load', resolve, { once: true });
        runtimeScript.addEventListener('error', reject, { once: true });
        originalScript.parentNode?.replaceChild(runtimeScript, originalScript);
      });
    } else {
      runtimeScript.textContent = originalScript.textContent;
      originalScript.parentNode?.replaceChild(runtimeScript, originalScript);
    }

  }
}

function transformIncludeToIframe() {
  const configs = {
    'partials/chart-deforestasi.html': {
      src: 'chart-deforestasi.html',
      height: '460px',
      darkBar: false,
      barTitle: null,
      caption: 'Grafik interaktif tren deforestasi Indonesia 2001–2025. Arahkan kursor ke batang untuk melihat informasi detail.'
    },
    'partials/alur-embed.html': {
      src: 'alur.html',
      height: '100vh',
      darkBar: true,
      barTitle: 'Tahapan &amp; Pemrosesan Data SIMONTINI',
      caption: 'Diagram interaktif alur kerja SIMONTINI dari pemodelan deep learning hingga verifikasi lapangan. Klik kotak oranye untuk melihat detail setiap tahapan.'
    },
    'partials/peta-embed.html': {
      src: 'peta.html',
      height: '100vh',
      darkBar: true,
      barTitle: 'Deforestasi melonjak pada 2025',
      caption: 'Peta interaktif deforestasi per pulau besar Indonesia 2019–2025. Gulir untuk melihat perubahan deforestasi tiap tahun.'
    },
    'partials/tematik-embed.html': {
      src: 'tematik.html',
      height: '100vh',
      darkBar: true,
      barTitle: 'Peta Tematik Deforestasi 2025',
      caption: ''
    },
    'partials/konsesi-embed.html': {
      src: 'konsesi.html',
      height: '100vh',
      darkBar: true,
      barTitle: 'Deforestasi dalam Konsesi \u2014 Sepuluh Teratas per Kategori',
      caption: ''
    }
  };

  const expandIcon = `<svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 3 21 3 21 9"></polyline><polyline points="9 21 3 21 3 15"></polyline><line x1="21" y1="3" x2="14" y2="10"></line><line x1="3" y1="21" x2="10" y2="14"></line></svg>`;

  document.querySelectorAll('[data-include-html]').forEach(host => {
    const key = host.getAttribute('data-include-html');
    const cfg = configs[key];
    if (!cfg) return;

    host.removeAttribute('data-include-html');

    const bar = cfg.barTitle ? `
      <div class="embed-bar"${cfg.darkBar ? ' style="background:#161616;border-bottom-color:rgba(255,255,255,.08);"' : ''}>
        <span class="embed-bar-title"${cfg.darkBar ? ' style="color:rgba(255,255,255,.45);"' : ''}>${cfg.barTitle}</span>
        <a href="${cfg.src}" target="_blank" class="viz-expand"${cfg.darkBar ? ' style="color:#C0522A;"' : ''}>
          ${expandIcon} Buka penuh
        </a>
      </div>` : '';

    const captionStyle = cfg.darkBar
      ? 'padding:10px 16px 14px;font-size:.72rem;line-height:1.6;color:rgba(255,255,255,.45);text-align:left;'
      : '';

    host.innerHTML = `
      <div${cfg.darkBar ? ' style="background:#0d0d0d;"' : ''}>
        ${bar}
        <div class="viz-frame">
          <iframe src="${cfg.src}" title="${cfg.src.replace('.html','')}" loading="lazy" style="display:block;width:100%;border:0;height:${cfg.height};"></iframe>
        </div>
      </div>
      <div class="viz-caption">${cfg.caption}</div>
    `;
  });
}

const preferIframeEmbed = true; // false: keep partial inject (bilik html biasa), true: iframe fallback
const partialVersion = '20260329';

async function loadHtmlPartials() {
  if (preferIframeEmbed) {
    transformIncludeToIframe();
  }
  const hosts = Array.from(document.querySelectorAll('[data-include-html]'));
  if (!hosts.length) return;

  const inlineFallbackPartials = {
    'partials/chart-deforestasi.html': `
<div style="background:#1a1f1e; border-radius:4px; overflow:hidden;">
  <iframe src="chart-deforestasi.html" title="Grafik Deforestasi Indonesia" loading="lazy" style="display:block; width:100%; border:0; height:460px;"></iframe>
</div>
<div class="viz-caption embed-caption">
  Grafik interaktif tren deforestasi Indonesia 2001–2024. Arahkan kursor ke batang untuk melihat informasi detail.
</div>
`,
    'partials/alur-embed.html': `
<div style="background:#0d0d0d; margin-bottom:0;">
  <div style="background:#0d0d0d; border-radius:0;">
    <div class="embed-bar" style="background:#161616; border-bottom-color:rgba(255,255,255,.08);">
      <span class="embed-bar-title" style="color:rgba(255,255,255,.45);">Tahapan &amp; Pemrosesan Data SIMONTINI</span>
      <a href="alur.html" target="_blank" class="viz-expand" style="color:#C0522A;">
        <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="15 3 21 3 21 9"></polyline><polyline points="9 21 3 21 3 15"></polyline>
          <line x1="21" y1="3" x2="14" y2="10"></line><line x1="3" y1="21" x2="10" y2="14"></line>
        </svg>
        Buka penuh
      </a>
    </div>
    <iframe src="alur.html" title="Alur Pemrosesan Data" loading="lazy" style="display:block; width:100%; border:0; height:100vh;"></iframe>
    <div style="padding:10px 16px 14px; font-size:.72rem; line-height:1.7; color:rgba(255,255,255,.45); text-align:center;">
      Diagram interaktif alur kerja SIMONTINI dari pemodelan deep learning hingga verifikasi lapangan. Klik kotak oranye untuk melihat detail setiap tahapan.
    </div>
  </div>
</div>
`,
    'partials/peta-embed.html': `
<div style="background:#0d0d0d;">
  <div class="embed-bar" style="background:#161616; border-bottom-color:rgba(255,255,255,.08);">
    <span class="embed-bar-title" style="color:rgba(255,255,255,.45);">Deforestasi melonjak pada 2025</span>
    <a href="peta.html" target="_blank" class="viz-expand" style="color:#C0522A;">
      <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="15 3 21 3 21 9"></polyline><polyline points="9 21 3 21 3 15"></polyline>
        <line x1="21" y1="3" x2="14" y2="10"></line><line x1="3" y1="21" x2="10" y2="14"></line>
      </svg>
      Buka penuh
    </a>
  </div>
  <iframe src="peta.html" title="Peta Deforestasi Indonesia" loading="lazy" style="display:block; width:100%; border:0; height:100vh;"></iframe>
  <div style="padding:10px 16px 14px; font-size:.72rem; line-height:1.7; color:rgba(255,255,255,.45); text-align:center;">
    Peta interaktif deforestasi per pulau besar Indonesia 2019–2025. Gulir untuk melihat perubahan deforestasi tiap tahun.
  </div>
</div>
`,
    'partials/tematik-embed.html': `
<div class="viz-frame">
  <div class="embed-bar">
    <span class="embed-bar-title">Peta Tematik Deforestasi 2025</span>
    <a href="tematik.html" target="_blank" class="viz-expand">
      <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="15 3 21 3 21 9"></polyline><polyline points="9 21 3 21 3 15"></polyline>
        <line x1="21" y1="3" x2="14" y2="10"></line><line x1="3" y1="21" x2="10" y2="14"></line>
      </svg>
      Buka penuh
    </a>
  </div>
  <iframe src="tematik.html" title="Peta Tematik Deforestasi Indonesia" loading="lazy"></iframe>
</div>
<div class="viz-caption embed-caption">
  Peta tematik interaktif deforestasi 2025 berbasis provinsi, kabupaten, area konservasi, dan habitat megafauna.
</div>
`,
    'partials/konsesi-embed.html': `
<div class="viz-frame">
  <div class="embed-bar">
    <span class="embed-bar-title">Deforestasi dalam Konsesi — Sepuluh Teratas per Kategori</span>
    <a href="konsesi.html" target="_blank" class="viz-expand">
      <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="15 3 21 3 21 9"></polyline><polyline points="9 21 3 21 3 15"></polyline>
        <line x1="21" y1="3" x2="14" y2="10"></line><line x1="3" y1="21" x2="10" y2="14"></line>
      </svg>
      Buka penuh
    </a>
  </div>
  <iframe src="konsesi.html" title="Deforestasi dalam Konsesi" loading="lazy"></iframe>
</div>
<div class="viz-caption embed-caption">
  Peta interaktif 10 konsesi teratas deforestasi per kategori. Pilih kategori di sidebar untuk beralih antar kebun kayu, logging, sawit, dan tambang.
</div>
`
  };

  await Promise.all(hosts.map(async (host) => {
    const src = host.getAttribute('data-include-html');
    if (!src) return;
    const versionedSrc = `${src}?v=${partialVersion}`;

    try {
      const res = await fetch(versionedSrc, { cache: 'no-cache' });
      if (!res.ok) throw new Error(`Failed to load ${src}`);
      host.innerHTML = await res.text();
      await hydrateInjectedScripts(host);
    } catch (err) {
      console.error(err);
      const fallbackHtml = inlineFallbackPartials[src];
      if (fallbackHtml) {
        host.innerHTML = fallbackHtml;
      }
    }
  }));
}

function bindIframeLanguageListeners() {
  document.querySelectorAll('iframe').forEach(frame => {
    if (frame.dataset.langBound === '1') return;
    frame.dataset.langBound = '1';

    frame.addEventListener('load', () => {
      const activeLang = localStorage.getItem('akurasi_lang') || 'id';
      setTimeout(() => {
        try {
          frame.contentWindow?.postMessage({ type: 'set-language', lang: activeLang }, '*');
        } catch (_) {}
      }, 60);
    });
  });
}


const initialLang = localStorage.getItem('akurasi_lang') || 'id';
langBtnId?.addEventListener('click', () => setGlobalLanguage('id'));
langBtnEn?.addEventListener('click', () => setGlobalLanguage('en'));

loadHtmlPartials().finally(() => {
  bindIframeLanguageListeners();
  setGlobalLanguage(initialLang);
});

const io = new IntersectionObserver((entries) => {
  entries.forEach(e => {
    if (e.isIntersecting) {
      const id = e.target.id;
      navLinks.forEach(a => {
        a.classList.toggle('active', a.getAttribute('href') === '#' + id);
      });
    }
  });
}, { rootMargin: '-20% 0px -60% 0px' });

sections.forEach(s => io.observe(s));

window.addEventListener('scroll', () => {
  nav.classList.toggle('show', scrollY > 80);
});

const provinceTables = document.getElementById('province-tables');
const provPrev = document.getElementById('prov-prev');
const provNext = document.getElementById('prov-next');

function slideProvinceTables(dir = 1) {
  if (!provinceTables) return;
  const amount = Math.round(provinceTables.clientWidth * 0.92) * dir;
  provinceTables.scrollBy({ left: amount, behavior: 'smooth' });
}

// document.querySelectorAll('iframe').forEach(el => {
//   console.log(el.src, el.parentElement.className, el.parentElement.parentElement.className);
// });


// (function () {
//   let locked = false;

//   const observer = new IntersectionObserver((entries) => {
//     entries.forEach(entry => {
//       if (entry.isIntersecting && !locked) {
//         const rect = entry.target.getBoundingClientRect();
//         if (rect.top > 50) {
//           locked = true;
//           const top = rect.top + window.scrollY - 60;
//           window.scrollTo({ top, behavior: 'smooth' });
//           setTimeout(() => { locked = false; }, 1000);
//         }
//       }
//     });
//   }, { threshold: 0.1 });

//   document.querySelectorAll('.alur, .peta').length

//   // ← selector yang benar
//   document.querySelectorAll('.alur, .peta')
//     .forEach(el => observer.observe(el));

//   // verifikasi
//   console.log('viz-frame blocks found:', document.querySelectorAll('.alur, .peta').length);
// })();

provPrev?.addEventListener('click', () => slideProvinceTables(-1));
provNext?.addEventListener('click', () => slideProvinceTables(1));
