// update baru
(function ($) {
  'use strict';

  const config = window.noviantyConfig || {};
  const overlay = document.getElementById('novianty-welcome');
  const body = document.body;
  const music = document.getElementById('novianty-music');
  const musicControl = document.getElementById('novianty-music-control');
  const countdownExpired = document.getElementById('nov-countdown-expired');
  let playing = false;
  let triggerSlideReveal = null;

  function allowScroll() {
    body.classList.remove('no-scroll');
  }

  function startExperience() {
    if (!overlay) {
      allowScroll();
      playMusic();
      if (typeof triggerSlideReveal === 'function') {
        triggerSlideReveal();
      }
      return;
    }

    overlay.classList.add('hidden');
    allowScroll();
    playMusic();

    if (typeof triggerSlideReveal === 'function') {
      setTimeout(function () {
        triggerSlideReveal();
      }, 450);
    }
  }

  function playMusic() {
    if (!music) {
      return;
    }
    const playPromise = music.play();
    if (playPromise && typeof playPromise.then === 'function') {
      playPromise.then(function () {
        playing = true;
        toggleMusicState();
      }).catch(function () {
        playing = false;
        toggleMusicState();
      });
    } else {
      playing = true;
      toggleMusicState();
    }
  }

  function pauseMusic() {
    if (!music) {
      return;
    }
    music.pause();
    playing = false;
    toggleMusicState();
  }

  function toggleMusicState() {
    if (!musicControl) {
      return;
    }
    if (playing && !music.paused) {
      musicControl.classList.add('is-playing');
    } else {
      musicControl.classList.remove('is-playing');
    }
  }

  function initMusicControl() {
    if (!musicControl || !music) {
      return;
    }

    musicControl.addEventListener('click', function () {
      if (music.paused) {
        playMusic();
      } else {
        pauseMusic();
      }
    });

    music.addEventListener('play', function () {
      playing = true;
      toggleMusicState();
    });

    music.addEventListener('pause', function () {
      playing = false;
      toggleMusicState();
    });
  }

  function formatDates() {
    if (typeof moment === 'undefined') {
      return;
    }

    moment.locale('id');
    const formatLong = 'dddd, D MMMM YYYY';

    if (config.tanggalAkad) {
      const akadMoment = moment(config.tanggalAkad);
      if (akadMoment.isValid()) {
        const akadEl = document.getElementById('tanggal-akad');
        if (akadEl) {
          akadEl.textContent = akadMoment.format(formatLong);
        }
      }
    }

    let resepsiMoment = null;
    if (config.tanggalResepsi) {
      resepsiMoment = moment(config.tanggalResepsi);
      if (resepsiMoment.isValid()) {
        const resepsiEl = document.getElementById('tanggal-resepsi');
        if (resepsiEl) {
          resepsiEl.textContent = resepsiMoment.format(formatLong);
        }
      } else {
        resepsiMoment = null;
      }
    }

    if (config.tanggalPernikahan) {
      const weddingMoment = moment(config.tanggalPernikahan);
      if (weddingMoment.isValid()) {
        const pernikahanEl = document.getElementById('tanggal-weddingnya');
        if (pernikahanEl) {
          pernikahanEl.textContent = weddingMoment.format(formatLong);
        }

        document.querySelectorAll('.js-date-short').forEach(function (element) {
          element.textContent = weddingMoment.format('DD.MM.YY');
        });

        if (!resepsiMoment) {
          resepsiMoment = weddingMoment;
        }
      }
    }

  }

  function initCountdown() {
    if (!config.countdown) {
      return;
    }

    const targetDate = new Date(config.countdown).getTime();
    if (Number.isNaN(targetDate)) {
      return;
    }

    const daysEl = document.getElementById('countdown-days');
    const hoursEl = document.getElementById('countdown-hours');
    const minutesEl = document.getElementById('countdown-minutes');
    const secondsEl = document.getElementById('countdown-seconds');

    const tick = function () {
      const now = new Date().getTime();
      const distance = targetDate - now;

      if (distance <= 0) {
        clearInterval(timer);
        if (daysEl) { daysEl.textContent = '00'; }
        if (hoursEl) { hoursEl.textContent = '00'; }
        if (minutesEl) { minutesEl.textContent = '00'; }
        if (secondsEl) { secondsEl.textContent = '00'; }
        if (countdownExpired) {
          countdownExpired.textContent = 'Acara telah berlangsung.';
        }
        return;
      }

      const days = Math.floor(distance / (1000 * 60 * 60 * 24));
      const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      const seconds = Math.floor((distance % (1000 * 60)) / 1000);

      if (daysEl) { daysEl.textContent = String(days).padStart(2, '0'); }
      if (hoursEl) { hoursEl.textContent = String(hours).padStart(2, '0'); }
      if (minutesEl) { minutesEl.textContent = String(minutes).padStart(2, '0'); }
      if (secondsEl) { secondsEl.textContent = String(seconds).padStart(2, '0'); }
    };

    tick();
    const timer = setInterval(tick, 1000);
  }

  function initGallery() {
    if (typeof SimpleLightbox === 'undefined') {
      return;
    }
    new SimpleLightbox('.nov-gallery a', {
      disableScroll: true,
      docClose: false,
      captions: false
    });
  }

  function initQrCode() {
    if (!config.qrcode || typeof $.fn.ClassyQR !== 'function') {
      return;
    }

    $('#qrcode').ClassyQR({
      create: true,
      type: 'text',
      text: config.qrcode
    });
  }

  function initGuestbook() {
    const form = $('#guestbook');
    if (!form.length) {
      return;
    }

    form.on('submit', function (event) {
      event.preventDefault();
      const nama = $('#nama').val();
      const komentar = $('#komentar').val();
      const submitBtn = $('#submitKomen');
      submitBtn.prop('disabled', true);

      $.ajax({
        url: config.baseUrl + '/add_komentar',
        method: 'POST',
        data: { nama: nama, komentar: komentar },
        dataType: 'html'
      }).done(function (response) {
        try {
          const json = JSON.parse(response);
          if (json.status === 'sukses') {
            const layout = $('.layout-komen');
            const avatar = 'https://na.ui-avatars.com/api/?name=' + encodeURIComponent(json.nama) + '&size=50';
            const html = [
              "<div class='nov-comment-card'>",
              "<div class='nov-comment-avatar'>",
              "<img src='" + avatar + "' alt='Avatar'>",
              "</div>",
              "<div class='nov-comment-body'>",
              "<h3>" + json.nama + "</h3>",
              "<p>" + json.komentar + "</p>",
              "</div>",
              "</div>"
            ].join('');
            layout.append(html);
            $('#komentar').val('');
          }
        } catch (err) {
          console.error(err);
        }
      }).always(function () {
        submitBtn.prop('disabled', false);
      });
    });
  }

  function initCopyButtons() {
    $(document).on('click', '.nov-copy', function () {
      const account = $(this).data('account');
      if (!account) {
        return;
      }

      if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(account).then(function () {
          alert('Nomor rekening tersalin');
        }).catch(function () {
          fallbackCopy(account);
        });
      } else {
        fallbackCopy(account);
      }
    });
  }

  function fallbackCopy(text) {
    const tempInput = document.createElement('input');
    tempInput.style.position = 'fixed';
    tempInput.style.opacity = '0';
    tempInput.value = text;
    document.body.appendChild(tempInput);
    tempInput.select();
    try {
      document.execCommand('copy');
      alert('Nomor rekening tersalin');
    } catch (err) {
      alert('Tidak dapat menyalin nomor rekening');
    }
    document.body.removeChild(tempInput);
  }

  function initSlideUp() {
    const cards = document.querySelectorAll('.nov-card');
    if (!cards.length) {
      triggerSlideReveal = null;
      return;
    }

    const observerSupported = 'IntersectionObserver' in window;
    let observer = null;

    if (observerSupported) {
      observer = new IntersectionObserver(
        function (entries) {
          entries.forEach(function (entry) {
            if (entry.isIntersecting) {
              entry.target.classList.add('nov-slide-visible');
              observer.unobserve(entry.target);
            }
          });
        },
        { threshold: 0.25 }
      );
    }

    cards.forEach(function (card) {
      card.classList.add('nov-slide-ready');
    });

    let activated = false;

    const revealCards = function () {
      if (activated) {
        return;
      }
      activated = true;

      cards.forEach(function (card) {
        if (observer) {
          observer.observe(card);
        } else {
          requestAnimationFrame(function () {
            card.classList.add('nov-slide-visible');
          });
        }
      });
    };

    triggerSlideReveal = revealCards;

    if (!overlay) {
      revealCards();
    }
  }

  function initOverlay() {
    if (!overlay) {
      allowScroll();
      return;
    }

    const openButtons = overlay.querySelectorAll('[data-nov-open]');
    openButtons.forEach(function (btn) {
      btn.addEventListener('click', function (event) {
        event.stopPropagation();
        event.preventDefault();
        startExperience();
      });
    });

    overlay.addEventListener('click', function () {
      startExperience();
    });
  }

  $(function () {
    body.classList.add('no-scroll');
    initOverlay();
    initMusicControl();
    formatDates();
    initCountdown();
    initGallery();
    initQrCode();
    initGuestbook();
    initCopyButtons();
    initSlideUp(); 
  });
})(jQuery);