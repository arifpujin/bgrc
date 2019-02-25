@extends('layouts.app')

@section('title')
{{Auth::user()->level}} Exitpass Form
@endsection

@section('navigation')
@include('employ.left-sidebar')
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
                                                    <h4>Bukit Gambang Resort City Exit Pass Form</h4>
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
                                                    <h5>Exit Pass Form</h5>
                                                    <span>Fill in the Form</span>
                                                    <div class="card-header-right"><i
                                                            class="icofont icofont-spinner-alt-5"></i></div>

                                                    <div class="card-header-right">
                                                        <i class="icofont icofont-spinner-alt-5"></i>
                                                    </div>

                                                </div>
                                                <div class="card-block">
                                                    <h4 class="sub-title">Exit Pass</h4>
                                                    <form method="post" action="{{url('employ/formexit')}}">
                                                    {{csrf_field()}}
                                                        <!--Name-->
                                                    
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Name </label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="name" class="form-control form-control-primary"
                                                                       placeholder="You can't change me" value="{{Auth::user()->name}}" readonly>
                                                            </div>
                                                        </div>

                                                        <!--Department-->
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Department</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="depart" class="form-control form-control-primary"
                                                                       placeholder="You can't change me" value="{{Auth::user()->depart}}" readonly>
                                                            </div>
                                                        </div>
                                                    
                                                        <!--Tipe Exitpass-->
                                                        <div class="form-group row">
                                                        <label class="col-sm-2">Type of Exit Pass</label>
                                                            <div class="col-sm-10">
                                                                <div class="form-radio">
                                                                    <div class="radio radiofill radio-primary radio-inline">
                                                                        <label>
                                                                            <input type="radio" name="tipe" value="Official" data-bv-field="member">
                                                                            <i class="helper"></i>Official
                                                                        </label>
                                                                    </div>
                                                                    <div class="radio radiofill radio-primary radio-inline">
                                                                        <label>
                                                                            <input type="radio" name="tipe" value="Personal" data-bv-field="member">
                                                                            <i class="helper"></i>Personal
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <span class="messages"></span>
                                                            </div>
                                                        </div>

                                                        <!--Purpose-->
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Purpose</label>
                                                            <div class="col-sm-10">
                                                                <textarea rows="5" cols="5" name="purpose" class="form-control form-control-primary"
                                                                          placeholder="Max 30 character" maxlength="30"></textarea>
                                                            </div>
                                                        </div>

                                                        <!--Submit-->
                                                        <div class="row">
                                                                <label class="col-sm-2"></label>
                                                                <div class="col-sm-10">
                                                                    <button type="submit" class="btn btn-mat btn-primary m-b-0">Send</button>
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