function initMobileCloseOnLink() {
  const menu = document.getElementById("mobileMenu");
  if (!menu) return;

  menu.addEventListener("click", (e) => {
    const a = e.target.closest("a");
    if (!a) return;

    if (window.bootstrap && window.bootstrap.Offcanvas) {
      const inst = window.bootstrap.Offcanvas.getInstance(menu);
      if (inst) inst.hide();
    }
  });
}

function initHeroControlsFade() {
  const c = document.getElementById("heroCarousel");
  if (!c) return;

  let t = null;

  const show = () => {
    c.classList.add("controls-on");
    if (t) window.clearTimeout(t);
    t = window.setTimeout(() => {
      c.classList.remove("controls-on");
    }, 2000);
  };

  show();

  ["pointermove", "mouseenter", "touchstart", "focusin"].forEach((ev) => {
    c.addEventListener(ev, show, { passive: true });
  });

  c.addEventListener("slid.bs.carousel", show);
}

function initDropdownStates() {
  const drops = document.querySelectorAll(".site-header .dropdown");
  if (!drops.length) return;

  drops.forEach((d) => {
    d.addEventListener("show.bs.dropdown", () => {
      d.classList.add("is-open");
    });
    d.addEventListener("hide.bs.dropdown", () => {
      d.classList.remove("is-open");
    });
  });
}

document.addEventListener("DOMContentLoaded", () => {
  initMobileCloseOnLink();
  initHeroControlsFade();
  initDropdownStates();
});