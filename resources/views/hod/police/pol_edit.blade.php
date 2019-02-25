@extends('layouts.app')

@section('title')
Edit User
@endsection

@section('navigation')
@include('hod.police.left-sidebar')
@endsection


@section('content')
<div class="page-wrapper">
                                <!-- Page-header start -->
                                <div class="page-header card">
                                    <div class="row align-items-end">
                                        <div class="col-lg-8">
                                            <div class="page-header-title">
                                                <i class="icofont icofont-file-code bg-c-blue"></i>
                                                <div class="d-inline">
                                                    <h4>Edit Data Bukit Gambang Resort City</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Page-header end -->

                                <!-- Page body start -->
                                <div class="page-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <!-- Basic Form Inputs card start -->
                                            <div class="card">
                                                <div class="card-header">
                                                    <div class="card-header-right"><i
                                                            class="icofont icofont-spinner-alt-5"></i></div>
                                                    <div class="card-header-right">
                                                        <i class="icofont icofont-spinner-alt-5"></i>
                                                    </div>

                                                </div>
                                                <div class="card-block">
                                                    <h4 class="sub-title">Edit User Login</h4>
                                                    <form role="form" method="POST" action="{{ url('hod-police/edit') }}">
                                                    {{ csrf_field() }}
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Full Name</label>
                                                            <div class="col-sm-10">
                                                            <input id="id" type="hidden" class="form-control" 
                                                            placeholder="ID" name="id" value="{{Auth::user()->id}}">
                                                                <input id="name" type="text" class="form-control"
                                                                       placeholder="Full Name" value="{{Auth::user()->name}}" Readonly>
                                                                @if ($errors->has('name'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('name') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Password <span style="color:red;">*</span></label>
                                                            <div class="col-sm-10">
                                                                <input id="password" type="password" class="form-control"
                                                                       placeholder="Password Min 5 Character" name="password">
                                                                @if ($errors->has('password'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('password') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Confrim Password <span style="color:red;">*</span></label>
                                                            <div class="col-sm-10">
                                                                <input id="password-confirm" type="password" class="form-control"
                                                                       placeholder="Confrim Password" name="password_confirmation">
                                                                @if ($errors->has('password_confirmation'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Identity Card / Passport </label>
                                                            <div class="col-sm-10">
                                                                <input id="idca" type="text" name="idca" class="form-control"
                                                                       placeholder="Identity Card / Passpor" value="{{Auth::user()->ic}}">
                                                                @if ($errors->has('idca'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('idca') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Mobile Phone</label>
                                                            <div class="col-sm-10">
                                                                <input id="telpon" type="tel" name="telpon" class="form-control"
                                                                       placeholder="60xxxxxxxxxx" value="{{Auth::user()->telpon}}" maxlength="13">
                                                                @if ($errors->has('telpon'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('telpon') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Email </label>
                                                            <div class="col-sm-10">
                                                                <input id="idca" type="email" name="email" class="form-control"
                                                                       placeholder="Email" value="{{Auth::user()->email}}">
                                                                @if ($errors->has('email'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('email') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Address </label>
                                                            <div class="col-sm-10">
                                                            <textarea rows="5" cols="5" name="address" class="form-control"
                                                                          placeholder="Address Max 150 Character" maxlength="150">{{Auth::user()->alamat}}</textarea>
                                                                @if ($errors->has('address'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('address') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>                                                     
                                                      

                                                        <!--Submit-->
                                                        <div class="row">
                                                                <label class="col-sm-2"></label>
                                                                <div class="col-sm-10">
                                                                    <button type="submit" class="btn btn-primary m-b-0">Edit</button>
                                                                </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Page body end -->
</div>
@endsection

@section('header')
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{url('assets/bower_components/bootstrap/css/bootstrap.min.css')}}">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="{{url('assets/icon/themify-icons/themify-icons.css')}}">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{{url('assets/icon/icofont/css/icofont.css')}}">
    <!-- font awesome -->
    <link rel="stylesheet" type="text/css" href="{{url('assets/icon/font-awesome/css/font-awesome.min.css')}}">
    <!-- flag icon framework css -->
    <link rel="stylesheet" type="text/css" href="{{url('assets/pages/flag-icon/flag-icon.min.css')}}">
    <!-- Menu-Search css -->
    <link rel="stylesheet" type="text/css" href="{{url('assets/pages/menu-search/css/component.css')}}">
    <!-- Switch component css -->
    <link rel="stylesheet" type="text/css" href="{{url('assets/bower_components/switchery/css/switchery.min.css')}}">
    <!-- Tags css -->
    <link rel="stylesheet" type="text/css" href="{{url('assets/bower_components/bootstrap-tagsinput/css/bootstrap-tagsinput.css')}}" />
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{url('assets/css/style.css')}}">

    <link rel="stylesheet" type="text/css" href="{{url('assets/css/jquery.mCustomScrollbar.css')}}">
@endsection

@section('scriptnya')
    <script type="text/javascript" src="{{url('assets/bower_components/jquery/js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/bower_components/jquery-ui/js/jquery-ui.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/bower_components/popper.js/js/popper.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/bower_components/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="{{url('assets/bower_components/jquery-slimscroll/js/jquery.slimscroll.js')}}"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="{{url('assets/bower_components/modernizr/js/modernizr.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/bower_components/modernizr/js/css-scrollbars.js')}}"></script>

    <!-- Switch component js -->
    <script type="text/javascript" src="{{url('assets/bower_components/switchery/js/switchery.min.js')}}"></script>
    <!-- Tags js -->
    <script type="text/javascript" src="{{url('assets/bower_components/bootstrap-tagsinput/js/bootstrap-tagsinput.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.10.4/typeahead.bundle.min.js')}}"></script>
    <!-- Max-length js -->
    <script type="text/javascript" src="{{url('assets/bower_components/bootstrap-maxlength/js/bootstrap-maxlength.js')}}"></script>
    <!-- i18next.min.js -->
    <script type="text/javascript" src="{{url('assets/bower_components/i18next/js/i18next.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/bower_components/jquery-i18next/js/jquery-i18next.min.js')}}"></script>
    <!-- Validation js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
    <script type="text/javascript" src="{{url('assets/pages/form-validation/validate.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/pages/form-validation/form-validation.js')}}"></script>
    <!-- Custom js -->
    
    <script type="text/javascript" src="{{url('assets/pages/advance-elements/swithces.js')}}"></script>
    <script src="{{url('assets/js/pcoded.min.js')}}"></script>
    <script src="{{url('assets/js/demo-12.js')}}"></script>
    <script src="{{url('assets/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/js/script.js')}}"></script>
@endsection