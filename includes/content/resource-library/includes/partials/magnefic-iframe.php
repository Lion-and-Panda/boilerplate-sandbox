<?php ?>
<!--defer magnific.js-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.0.0/jquery.magnific-popup.min.js" integrity="sha512-+m6t3R87+6LdtYiCzRhC5+E0l4VQ9qIT1H9+t1wmHkMJvvUQNI5MKKb7b08WL4Kgp9K0IBgHDSLCRJk05cFUYg==" crossorigin="anonymous"></script>
<script>
function extendMagnificIframe(){

   var $start = 0;
   var $iframe = {
       markup: '<div class="mfp-iframe-scaler">' +
               '<div class="mfp-close"></div>' +
               '<iframe class="mfp-iframe" frameborder="0" aria-label="video popup" allowfullscreen></iframe>' +
               '</div>' +
               '<div class="mfp-bottom-bar">' +
               '<div class="mfp-title"></div>' +
               '</div>',
       patterns: {
           youtube: {
               index: 'youtu',
               id: function(url) {

                   var m = url.match( /^.*(?:youtu.be\/|v\/|e\/|u\/\w+\/|embed\/|v=)([^#\&\?]*).*/ );
                   if ( !m || !m[1] ) return null;

                       if(url.indexOf('t=') != - 1){

                           var $split = url.split('t=');
                           var hms = $split[1].replace('h',':').replace('m',':').replace('s','');
                           var a = hms.split(':');

                           if (a.length == 1){

                               $start = a[0];

                           } else if (a.length == 2){

                               $start = (+a[0]) * 60 + (+a[1]);

                           } else if (a.length == 3){

                               $start = (+a[0]) * 60 * 60 + (+a[1]) * 60 + (+a[2]);

                           }
                       }

                       var suffix = '?autoplay=1';

                       if( $start > 0 ){

                           suffix = '?start=' + $start + '&autoplay=1';
                       }

                   return m[1] + suffix;
               },
               src: '//www.youtube.com/embed/%id%'
           },
           vimeo: {
               index: 'vimeo.com/',
               id: function(url) {
                   var m = url.match(/(https?:\/\/)?(www.)?(player.)?vimeo.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/);
                   if ( !m || !m[5] ) return null;
                   return m[5];
               },
               src: '//player.vimeo.com/video/%id%?autoplay=1'
           }
       }
   };

   return $iframe;

}

$('.popup-video').magnificPopup({
   type: 'iframe',
   iframe: extendMagnificIframe()
});
</script>
