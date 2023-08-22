@extends('layouts.auth')

@section('title', 'Register')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
<div class="card card-primary">
  <div class="card-header">
    <h4>Please check your email for verification</h4>
  </div>
  @if (session('status')=='verification-link-sent')
    <div class="mb-4 font-medium text-sm text-green-600">
      A new verification link has been sent to the email address you provided during registration.
    </div>
  @endif

  <div class="card-body">
    <form method="POST" action="{{route('verification.send')}}" class="needs-validation" novalidate>
      @csrf
      <div class="form-group">
        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
          Resend Verification Email
        </button>
      </div>
    </form>
  </div>
</div>
<div class="text-muted mt-5 text-center">
  Don't have an account? <a href="{{route('register')}}">Create One</a>
</div>
@endsection

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('library/jquery.pwstrength/jquery.pwstrength.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/auth-register.js') }}"></script>
@endpush