/**
* Programmit Loading Spinner 2019
* https://programmit.com
* Author: Hassan Youssef Krayem
* Email: developer.hassankrayem@gmail.com
**/
.pi_loading_spinner {
   position: absolute;left: 50%;top: 50%;
   height:60px;
   width:60px;
   margin:0px auto;
   -webkit-animation: pi_loading_spinner_rotation .6s infinite linear;
   -moz-animation: pi_loading_spinner_rotation .6s infinite linear;
   -o-animation: pi_loading_spinner_rotation .6s infinite linear;
   animation: pi_loading_spinner_rotation .6s infinite linear;
   border-left:6px solid rgba(38, 166, 154, .15);
   border-right:6px solid rgba(38, 166, 154, .15);
   border-bottom:6px solid rgba(38, 166, 154, .15);
   border-top:6px solid rgba(38, 166, 154, .8);
   border-radius:100%;
   box-shadow: 0 0 4px #fff;
   background-color: rgba(100,100,100, .4);
}

@-webkit-keyframes pi_loading_spinner_rotation {
   from {-webkit-transform: rotate(0deg);}
   to {-webkit-transform: rotate(359deg);}
}
@-moz-keyframes pi_loading_spinner_rotation {
   from {-moz-transform: rotate(0deg);}
   to {-moz-transform: rotate(359deg);}
}
@-o-keyframes pi_loading_spinner_rotation {
   from {-o-transform: rotate(0deg);}
   to {-o-transform: rotate(359deg);}
}
@keyframes pi_loading_spinner_rotation {
   from {transform: rotate(0deg);}
   to {transform: rotate(359deg);}
}