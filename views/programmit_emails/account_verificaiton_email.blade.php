<html xmlns="http://www.w3.org/1999/xhtml" ><head><!-- If you delete this meta tag, Half Life 3 will never be released. --><meta name="viewport" content="width=device-width">
<link href="https://fonts.googleapis.com/css?family=Pontano+Sans" rel="stylesheet"> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style>

/* ------------------------------------- 
      GLOBAL 
------------------------------------- */
* {
  margin: 0;
  padding: 0;
}

body {
  -webkit-font-smoothing: antialiased;
  -webkit-text-size-adjust: none;
  width: 100%!important;
  height: 100%;
  font-size: 1em;
  line-height: 1.5;
  color: #3B4355;
  font-family: 'Pontano Sans', 'cursive', "Helvetica Neue", "Helvetica", Helvetica, "Roboto", Arial, sans-serif;  
}

/* ------------------------------------- 
    ELEMENTS 
------------------------------------- */

a { color: #1482FF; text-decoration: none; }
img { max-width: 100%;}

.collapse {
  margin: 0;
  padding: 0;
}

.btn {
  text-decoration: none;
  color: #FFF;
  background-color: #1482FF;
  padding: 11px 20px;
  font-size: 16px;
  font-weight: normal;
  margin-right: 10px;
  margin-bottom: 26px;
  text-align: center;
  cursor: pointer;
  display: inline-block;
  border-radius: 3px 3px 3px 3px;
}

.center {
  text-align: center;
}

.center .btn {
  margin-right: 0;
}

.b-ra {
  border-radius: .4em;
}

.logo-top {
  display: block;
  width: auto;
  height: 64px;
  margin: 30px auto 40px;
}

.logo-bottom {
  display: block;
  width: 432px;
  height: 180px;
  margin: 15px auto 30px;
}

.main-img {
  box-shadow: 0 0px 2px 0 rgba(85, 95, 119, 0.2),
              0 1px 4px 0 rgba(85, 95, 119, 0.15);
  border-radius: 3px;
  margin-bottom: 26px;
}

/* ------------------------------------- 
    HEADER 
------------------------------------- */

table.head-wrap { width: 100%;}

.header.container table td.logo { padding: 15px;}

.header.container table td.label {
  padding: 15px;
  padding-left: 0px;
}
/* ------------------------------------- 
    BODY 
------------------------------------- */

table.body-wrap { width: 100%; }

/* ------------------------------------- 
    FOOTER 
------------------------------------- */

table.footer-wrap {
  width: 100%;
  clear: both!important;
}

table.footer-wrap .content {
  border-top: 1px solid #E1E5EB;
  font-size: 12px;
  line-height: 1.5;
}

table.footer-wrap .content .socials a {
  margin: 0 10px;
}

table.footer-wrap .content p {
  color: #848EA1;
  font-size: 12px;
  margin-top: 20px;
  text-align: center;
}

/* ------------------------------------- 
    TYPOGRAPHY 
------------------------------------- */

h1,h2,h3,h4,h5,h6 {
  line-height: 1.3;
  margin-bottom: 1em;
  font-weight: bold;
  color: #3B4355;
}

h1 {
  font-size: 26px;
}

h2 {
  font-size: 22px;
}

h3 {
  font-size: 20px;
}

h4 {
  font-size: 14px;
  margin-bottom: 20px;
}

p,ul,ol {
  font-weight: normal;
  line-height: 1.5;
}

p {
  font-size: 16px;
  margin-bottom: 1.2em;
}

p.lead { font-size: 16px;}
p.last { margin-bottom: 0px;}

p.callout {
  padding: 15px;
  background-color: #DEDFE1;
  margin-bottom: 25px;
  color: #8C8D8F;
  text-align: center;
}

p.caption {
  color: #979797;
  font-size: 13px;
  margin-top: 10px;
}

.smaller {
  font-size: 0.9em;
}

ul,ol {
  margin-bottom: .8em;
  margin-top: .8em;
}

ul li {
  font-size: 16px;
  margin-left: 16px;
  list-style-position: inside;
  margin-bottom: .3em;
}

ol li {
  font-size: 16px;
  margin-left: 8px;
  list-style-position: outside;
  margin-bottom: 8px;
}

blockquote {
  margin: 30px 0;
  border: 4px solid #F6F6F6;
  padding: 10px;
}

blockquote p {
  color: #33373b;
  font-weight: 200;
  line-height: 26px;
  font-size: 18px;
  margin: 0;
}

cite { display: block; }

th { color: #9b9b9b;}

.small, th { font-size: 12px;}
.grey, .unsubscribe, .unsubscribe *, .quiet { color: #848ea1;}
.very-quiet { color: #acb4c2;}

address {
  font-style: normal;
  line-height: 1.5;
}

/* --------------------------------------------------- 
    RESPONSIVENESS
    Nuke it from orbit. It's the only way to be sure. 
------------------------------------------------------ */
/* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */

.container {
  display: block!important;
  max-width: 600px!important;
  margin: 0 auto!important;
  /* makes it centered */
  
  clear: both!important;
}
/* This should also be a block element, so that it will fill 100% of the .container */

.content {
  padding: 15px;
  max-width: 600px;
  margin: 0 auto;
  display: block;
}
/* Let's make sure tables in the content area are 100% wide */

.content table {
  width: 100%;
}
/* Odds and ends */

.column {
  width: 300px;
  float: left;
}

.column tr td {
  padding: 15px;
}

.column-wrap {
  padding: 0!important;
  margin: 0 auto;
  max-width: 600px!important;
}

.column table {
  width: 100%;
}
/* Be sure to place a .clear element after each set of columns, just to be safe */

.clear {
  display: block;
  clear: both;
}
/* ------------------------------------------- 
    PHONE
    For clients that support media queries.
    Nothing fancy. 
-------------------------------------------- */

@media only screen and (max-width: 600px) {
  a[class="btn"] {
    display: block!important;
    background-image: none!important;
    margin-right: 0!important;
  }
  div[class="column"] {
    width: auto!important;
    float: none!important;
  }
  table.social div[class="column"] { width: auto!important; }
}

.well {
  font-size: 14px;
  line-height: 1.6;
  padding: 20px;
  background-color: #fafbfc;
  margin-bottom: 20px;
}
/* App/Publisher notifications */
table.changes-table { 
  border: 1px solid #e1e5eb; 
  border-collapse: collapse;
  margin-bottom: 8px;
  font-size: 12px;
}
table.changes-table th {
  color: #848ea1;
  font-weight: bold;
}
table.changes-table th.important { color: #555f77; }
table.changes-table th, 
table.changes-table td {
  border: 1px solid #e1e5eb;
  padding: 4px 8px;
  text-align: left;
  vertical-align: top;
} 
table.changes-table th.cell-revenue, 
table.changes-table td.cell-revenue {
  color: #6ab917;
  font-weight: bold;
  text-align: center;
}
table.changes-table th.cell-downloads, 
table.changes-table td.cell-downloads {
  color: #1482FF;
  font-weight: bold;
  text-align: center;
}
table.app-details-table,
table.app-details-table td {
  border: 0px none;
}

table.app-details-table td {
  padding: 0 4px 0 0;
  font-weight: normal;
  font-size: 12px;
}

/* New Update */
table.top-align td{ 
  vertical-align: top;
}

table.no-border,
table.no-border td {
  border: 0px none;
}
table.no-border td {
  padding: 0 4px 0 0;
}
/* End New Update */

/* Industry Reports */
table.reports-table { 
  color: #555f77;
  border: 1px solid #e1e5eb; 
  border-collapse: collapse;
  margin-bottom: 8px;
  font-size: 12px;
}
table.reports-table th {
  color: #848ea1;
  font-weight: bold;
  border-bottom: 1px solid #e1e5eb;
  text-align:center;
  vertical-align: middle;
}

table.reports-table th, 
table.reports-table td {
  border-right: 1px solid #e1e5eb;
  padding: 4px 8px;
}

table.reports-table td { vertical-align: top; }

table.reports-table th.important,
table.reports-table td.important { background-color: #fafbfc; }

.green { color: #6ab917; }
.red { color: #dd3d2e; }
.yellow { color: #ffd300; }
.blue { color: #1482FF; }

table.reports-table th.text-right,
table.reports-table td.text-right { text-align: right; }
table.reports-table th.text-left,
table.reports-table td.text-left  { text-align: left; }
table.reports-table td.no-border-left { border-left: none; }
table.reports-table td.no-border-right { border-right: none; }

    </style></head><body>

<!-- BODY -->
<table class="body-wrap">
  <tr></td>
    <td class="container">
    <div class="content">
      <table>
        <tbody>
          <tr>
            <td>
             <p><a href="{{ $data['domain_url'] }}" ><img src="https://{{ $data['domain_url'] }}/logo.png" alt="{{ $data['app_title'] }}" class="logo-top"></a></p><hr>
              <br>
              Welcome {{ $user->clientProfile->company_name }}<br>
              {{ $data['section_1'] }}
              <br>
              {{ $data['section_2'] }}

              <blockquote>
                <div align="center" style="margin:5px">
                    <a class='btn' href="https://{{ $data['domain_url'] }}/p/secure/verification/account/{{ $token }}"> Confirm my account</a>
                </div>
              </blockquote>

              {!! $data['section_3'] !!}
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </td>
  </tr>
</table>

    <table class="footer-wrap" style="width: 100%; clear: both !important; margin: 0; padding: 0;"><tbody><tr ><td class="container">
      <div class="content" >
        <a href="https://{{ $data['domain_url'] }}" ><img src="https://{{ $data['domain_url'] }}/logo.png" width="100%" alt="{{ $data['app_title'] }}" class="logo-bottom"></a>

        <div class="socials center" align="center">
          <a href="{{ $data['company_profile']->social_link_facebook }}"> Facebook</a>
          <a href="{{ $data['company_profile']->social_link_twitter }}"> Twitter</a>
          <a href="{{ $data['company_profile']->social_link_linkedin }}"> Linked-In</a>
          <a href="{{ $data['company_profile']->social_link_google_plus }}" >Google+</a>
          <a href="{{ $data['company_profile']->social_link_youtube }}"> Youtube</a>
        </div>      

        <address ><p  align="center">
          {{ $data['company_profile']->location }}
        </p></address>
        <p  align="center">{{ $data['company_profile']->copyright_notice }}</p>
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

</body></html>