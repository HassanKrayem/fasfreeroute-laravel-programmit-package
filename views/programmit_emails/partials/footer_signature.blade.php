<table class="footer-wrap" style="width: 100%; clear: both !important; margin: 0; padding: 0;"><tbody><tr ><td class="container">
      <div class="content" >
        <a href="http://apa-inter.com" ><img src="http://apa-inter.com/resources/emails/full-apa-black-org.png" width="100%" alt="APA" class="logo-bottom"></a>

        <div class="socials center"  align="center">
          <a href="{{$profile->social_link_facebook}}"> Facebook</a>
          <a href="{{$profile->social_link_twitter}}"> Twitter</a>
          <a href="{{$profile->social_link_linkedin}}"> Linked-In</a>
          <a href="{{$profile->social_link_google_plus}}" >Google+</a>
          <a href="{{$profile->social_link_youtube}}"> Youtube</a>
        </div>

        <!-- <p  align="center">Don't want to receive emails from us?
          <a href="https://apa-inter.com/unsubscribe#" >
            <unsubscribe >Unsubscribe</unsubscribe></a></p> -->

        <address ><p  align="center">
          {{ $profile->location }}
        </p></address>
        <p  align="center">{{ $profile->copyright_notice }}</p>
      </div>

    </td>
  </tr></tbody></table>
    <script type="text/javascript">
      window.onload = function() {
        var body = document.body,
            html = document.documentElement;
        var height = getHeight();
        var width = getWidth();
        var event = new CustomEvent('emailIframeResize', { detail: { height: height, width: width } })
        window.parent.document.dispatchEvent(event);
      };
      function getWidth() {
        return Math.max(
          document.body.scrollWidth,
          document.documentElement.scrollWidth,
          document.body.offsetWidth,
          document.documentElement.offsetWidth,
          document.documentElement.clientWidth
        );
      }
      function getHeight() {
        return Math.max(
          document.body.scrollHeight,
          document.documentElement.scrollHeight,
          document.body.offsetHeight,
          document.documentElement.offsetHeight,
          document.documentElement.clientHeight
        );
      }
    </script>