<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('asset/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('asset/img/favicon.png') }}">
    <title>
        Rehatta Service | RSUD dr. Rehatta Provinsi Jawa Tengah
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('asset/css/nucleo-icons.css" rel="stylesheet') }}" />
    <link href="{{ asset('asset/css/nucleo-svg.css" rel="stylesheet') }}" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('asset/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('asset/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />
</head>

<body class="bg-gray-200 ">
    <main class="main-content mt-0">
        <div class="page-header bg-gradient-dark align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg"
            {{-- style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signup-cover.jpg'); background-position: top;"--}}>
            <span class="mask bg-gradient-primary opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 text-center mx-auto">
                        <h1 class="text-white mb-2 mt-5">Welcome!</h1>
                        <p class="text-lead text-white">Use this form to create a new account.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
                <div class="col-xl-6 col-lg-6 col-md-8 mx-auto">
                    <div class="card z-index-0">
                        <div class="card-header text-center pt-4">
                            <h5>Register Account</h5>
                        </div>
                        <div class="card-body">
                            <form role="form" action="{{ url('register') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <input type="text" name="company" class="form-control @error('company') is-invalid @enderror" value="{{ old('company') }}" placeholder="Company" aria-label="Company">
                                    @error('company')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <select name="project_id" class="form-control @error('project_id') is-invalid @enderror">
                                        <option value="">-- Pilih Project --</option>
                                        @foreach ($resultProjects as $item)
                                            <option value="{{ $item->id }}">{{ $item->project_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('project_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Name" aria-label="Name">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email" aria-label="Email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="number" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp') }}" placeholder="Number Handphone SMS (0812200335)" aria-label="No Handphone">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" aria-label="Password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Retype password" aria-label="Password">
                                </div>
                                <div class="form-check form-check-info text-start">
                                    <input class="form-check-input @error('terms_and_conditions') is-invalid @enderror" type="checkbox" value="" name="terms_and_conditions" id="terms_and_conditions" checked>
                                    <label class="form-check-label" for="terms_and_conditions">
                                        I agree the <a href="javascript:;" class="text-dark font-weight-bolder">Terms and Conditions</a>
                                    </label>
                                    @error('terms_and_conditions')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Sign up</button>
                                </div>
                                <p class="text-sm mt-3 mb-0">Already have an account? <a href="{{ route('login') }}" class="text-dark font-weight-bolder">Sign in</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
    <footer class="footer py-5">
        <div class="container">
            <div class="row">
                <div class="col-8 mx-auto text-center mt-1">
                    <p class="mb-0 text-secondary">
                        Rehatta Service Version 1.0.0 |
                        Copyright © <script>
                        document.write(new Date().getFullYear())
                        </script> Template by Creative Tim.
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
    <!--   Core JS Files   -->
    <script src="{{ asset('asset/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('asset/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('asset/js/argon-dashboard.min.js?v=2.0.4') }}"></script>
</body>
</html>
