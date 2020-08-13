@extends('general_purpose_layout.empty')

@section('content')

<header>
      <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
          <div class="row">
            <div class="col-sm-8 col-md-7 py-4">
              <h4 class="text-white">About</h4>
              <p class="text-muted">MRT is a service that tests your VoIP routes quality by testing if the route passes the Caller ID (CLI) and if the route supports dual-tone multi-frequency (DTMF) signaling, in addition to the false answer supervision (FAS) test that detect the FAS in the route. So, everyone in the VoIP business can benefit and take advantage from this service whether they are wholesale VoIP providers, retail VoIP providers or call centers.</p>
            </div>
            <div class="col-sm-4 offset-md-1 py-4">
              <h4 class="text-white">Contact</h4>
              <ul class="list-unstyled">
                <li><a href="https://jikatel.com" target="_blank" class="text-white">Jikatel</a></li>
                <li><a href="https://myroutetester.com" target="_blank" class="text-white">myroutestester</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
          <a href="#" class="navbar-brand d-flex align-items-center">
            <img src="{{asset('cpanel/graphics/logo.png')}}" width="96px"/>
            <strong>MRT</strong>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </div>
    </header>

<div class="container text-center mt-5 border bg-light p-5">
    <div class="row mb-5">
        <div class="col-12 mb-5">
                <h4 class="text-success">Your Account has been Verified</h4>
                 <p>Thank You for verifying your email account.</p><hr class="mt-5">
                <a href="/account" class="btn btn-info">Go to Home Page</a>
                <a href="/account" class="btn btn-success">Go to your Dashboard</a>
        </div>
    </div>
</div>

<footer class="text-muted mt-5">
      <div class="container">
        <div class="row">
            <div class="col-12">
                <a href="/" class="float-left" target="_blank"><small>MyRouteTester</small></a>
                <a href="https://jikatel.com" class="float-right" target="_blank"><small>JIKATEL Product MRT &copy; <?php echo date("Y"); ?></small></a>
            </div>        
        </div>
      </div>
</footer>

<script type="text/javascript" src="{{ asset('shared_content/js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('shared_content/js/bootstrap.min.js') }}"></script>
@endsection
