@extends('layout.index-login-auth')

@section('index-content')
    @include('_partials.alert')
    <span class="app-brand-logo demo">
        <img src="{{ asset('sneat/assets/img/favicon/LogoFIP.png') }}" alt="">
    </span>
    <h1 class="fst-bold lh-1 mb-4">SIJAMU FIP</h1>
    <p class="mb-5">SIstem Informasi Sistem Penjaminan Mutu Internal Fakultas Ilmu Pendidikan Universitas Trunojoyo Madura
    </p>
    <!-- * * * * * * * * * * * * * * *-->
    <!-- * * SB Forms Contact Form * *-->
    <!-- * * * * * * * * * * * * * * *-->
    <!-- This form is pre-integrated with SB Forms.-->
    <!-- To make this form functional, sign up at-->
    <!-- https://startbootstrap.com/solution/contact-forms-->
    <!-- to get an API token!-->
    <form id="contactForm" data-sb-form-api-token="API_TOKEN">
        <!-- Email address input-->
        <div class="row input-group-newsletter">
            <div class="col"><input class="form-control" id="email" type="email" placeholder="Enter email address..."
                    aria-label="Enter email address..." data-sb-validations="required,email" /></div>
            <div class="col-auto"><button class="btn btn-primary disabled" id="submitButton" type="submit">Masuk</button></div>
        </div>
        <div class="invalid-feedback mt-2" data-sb-feedback="email:required">An email is required.</div>
        <div class="invalid-feedback mt-2" data-sb-feedback="email:email">Email is not valid.</div>
        <!-- Submit success message-->
        <!---->
        <!-- This is what your users will see when the form-->
        <!-- has successfully submitted-->
        <div class="d-none" id="submitSuccessMessage">
            <div class="text-center mb-3 mt-2">
                <div class="fw-bolder">Form submission successful!</div>
                To activate this form, sign up at
                <br />
                <a
                    href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
            </div>
        </div>
        <!-- Submit error message-->
        <!---->
        <!-- This is what your users will see when there is-->
        <!-- an error submitting the form-->
        <div class="d-none" id="submitErrorMessage">
            <div class="text-center text-danger mb-3 mt-2">Error sending message!</div>
        </div>
    </form>
@endsection
