/*!
 * jQuery ClassyQR library (patched HTTPS + encoding)
 * Original: Marius Stanciu - Sergiu <marius@class.pm> | MIT
 * Version 1.2.0 (patched)
 */
(function ($) {
  $.fn.extend({
    ClassyQR: function (x) {
      var defaults = {
        // PATCH: use HTTPS endpoint to avoid mixed-content on HTTPS sites
        baseUrl: 'https://chart.googleapis.com/chart?cht=qr&chs=',
        size: 230,
        create: false,
        // contact
        number: null,
        email: null,
        subject: null,
        address: null,
        name: null,
        url: null,
        note: null,
        // location
        latitude: null,
        longitude: null,
        // wifi (add missing defaults)
        ssid: null,
        auth: null,      // WEP | WPA | WPA2 | nopass
        password: null,
        // generic
        alt: 'QR code',
        encoding: 'UTF-8',
        type: 'text',
        text: 'Welcome to ClassPM'
      };

      var o = $.extend({}, defaults, x);

      return this.each(function () {
        var $el = $(this);

        // base URL incl. size & encoding (encoding encoded for safety)
        var url = o.baseUrl
          + encodeURIComponent(String(o.size)) + 'x' + encodeURIComponent(String(o.size))
          + '&choe=' + encodeURIComponent(o.encoding)
          + '&chl=';

        // helper to safely append encoded payload
        var appendPayload = function (payload) {
          url += encodeURIComponent(payload || '');
        };

        switch (o.type) {
          case 'contact':
            appendPayload(
              'MECARD:'
              + 'N:'   + (o.name || '') + ';'
              + 'TEL:' + (o.number || '') + ';'
              + 'URL:' + (o.url || '') + ';'
              + 'EMAIL:' + (o.email || '') + ';'
              + 'ADR:' + (o.address || '') + ';'
              + 'NOTE:' + (o.note || '') + ';'
            );
            break;

          case 'wifi':
            // WIFI:S:<ssid>;T:<auth>;P:<password>;
            appendPayload(
              'WIFI:'
              + 'S:' + (o.ssid || '') + ';'
              + 'T:' + (o.auth || '') + ';'
              + 'P:' + (o.password || '') + ';'
            );
            break;

          case 'location':
            // geo:lat,long
            appendPayload('geo:' + (o.latitude || '') + ',' + (o.longitude || ''));
            break;

          case 'call':
            // tel:number
            appendPayload('tel:' + (o.number || ''));
            break;

          case 'email':
            // mailto:email:subject:text
            appendPayload('mailto:' + (o.email || '') + ':' + (o.subject || '') + ':' + (o.text || ''));
            break;

          case 'sms':
            // smsto:number:text
            appendPayload('smsto:' + (o.number || '') + ':' + (o.text || ''));
            break;

          case 'url':
            appendPayload(o.url || '');
            break;

          case 'text':
          default:
            appendPayload(o.text || '');
            break;
        }

        if (o.create) {
          $el.append('<img src="' + url + '" alt="' + (o.alt || 'QR code') + '" />');
        } else {
          // original behavior: set src (works if element is <img>)
          $el.attr('src', url);
        }
      });
    }
  });
})(jQuery);
