@extends('layouts.app')

@section('title')
Police Dasboard
@endsection

@section('navigation')
@include('employ.police.left-sidebar')
@endsection

@section('content')
<div class="page-wrapper">

                              <!-- Page-body start -->
                              <div class="page-body">
                                    <div class="card-block">
                                                                                <div class="row">
                                                                                    <div class="col-sm-12">
                                                                                        @if (Auth::user()->akun == 'belum')
                                                                                        <h4 class="task-detail" Style="Color:Red">Please Change Your Password, and Complete Your Data!!</h4>
                                                                                        @elseif (Auth::user()->akun == 'admin')
                                                                                        <h4 class="task-detail" Style="Color:Red">ADMIN HAS RESET YOUR PASSWORD, PLEASE CHANGE YOUR PASSWORD!!</h4>
                                                                                        @elseif (Auth::user()->akun == 'lost')
                                                                                        <h4 class="task-detail" Style="Color:Red">Anyone wants to login your account with unknown IP Address, please change your password!!</h4>
                                                                                        @elseif (Auth::user()->akun == 'onlypas')
                                                                                        <h4 class="task-detail" Style="Color:#ff6600">Please Complete Your Data, Don't Inform ID {{Auth::user()->level}} and Password to Anyone!!</h4>
                                                                                        @else
                                                                                        <h4 class="task-detail" Style="Color:Green">Don't Inform ID {{Auth::user()->level}} and Password to Anyone!!</h4>
                                                                                        @endif
                                                                                    </div>
                                                                                    <!-- end of col-sm-8 -->
                                                                                </div>
                                                                                <!-- end of row -->
                                                                            </div>
                                                                            <!-- end of card-block -->
                                        <div class="row">
                                            <div class="col-lg-12">
                                                
                                                <!-- tab content start -->
                                                <div class="tab-content">
                                                    <!-- tab panel personal start -->
                                                    <div class="tab-pane active" id="personal" role="tabpanel">
                                                        <!-- personal card start -->
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h5 class="card-header-text">About Me</h5>
                                                                <a href="edit"><button id="edit-btn" type="button" class="btn btn-sm btn-primary waves-effect waves-light f-right">
                                                                <i class="icofont icofont-edit"> </i> Edit
                                                                </button></a>
                                                            </div>
                                                            <div class="card-block">
                                                                <div class="view-info">
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <div class="general-info">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12 col-xl-6">
                                                                                        <div class="table-responsive">
                                                                                            <table class="table m-0">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <th scope="row"><span style="Color:Blue">Employee ID</span></th>
                                                                                                        <td><span style="Color:Blue"><h5>{{Auth::user()->username}}</h5></span></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th scope="row">Full Name</th>
                                                                                                        <td>{{Auth::user()->name}}</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th scope="row">Department</th>
                                                                                                        <td>{{Auth::user()->depart}}</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th scope="row">Level Access</th>
                                                                                                        <td>{{Auth::user()->level}}</td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- end of table col-lg-6 -->
                                                                                    <div class="col-lg-12 col-xl-6">
                                                                                        <div class="table-responsive">
                                                                                            <table class="table">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <th scope="row">Identity Card/Passport</th>
                                                                                                        <td>@if(Auth::user()->ic == '')
                                                                                                            <p style="Color:Red;">INCOMPLETE</p>
                                                                                                            @else
                                                                                                            {{Auth::user()->ic}}
                                                                                                            @endif
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th scope="row">Mobile Phone</th>
                                                                                                        <td>@if(Auth::user()->telpon == '')
                                                                                                            <p style="Color:Red;">INCOMPLETE</p>
                                                                                                            @else
                                                                                                            {{Auth::user()->telpon}}
                                                                                                            @endif
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th scope="row">Email</th>
                                                                                                        <td>@if(Auth::user()->email == '')
                                                                                                            <p style="Color:Red;">INCOMPLETE</p>
                                                                                                            @else
                                                                                                            {{Auth::user()->email}}
                                                                                                            @endif
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th scope="row">Address</th>
                                                                                                        <td>@if(Auth::user()->alamat == '')
                                                                                                            <p style="Color:Red;">INCOMPLETE</p>
                                                                                                            @else{{Auth::user()->alamat}}
                                                                                                            @endif
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- end of table col-lg-6 -->
                                                                                </div>
                                                                                <!-- end of row -->
                                                                            </div>
                                                                            <!-- end of general info -->
                                                                        </div>
                                                                        <!-- end of col-lg-12 -->
                                                                    </div>
                                                                    <!-- end of row -->
                                                                </div>
                                                            </div>
                                                            <!-- end of card-block -->
                                                        </div>
                                                            </div>
                                                        </div>
                                                        <!-- personal card end-->
                                                    </div>
                                                    <!-- tab pane personal end -->
                                                    
                                                                               
                                                                            </div>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- info card end -->
                                                    </div>
                                                    <!-- tab pane info end -->
                                                </div>
                                                <!-- tab content end -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Page-body end -->
</div>
@endsection


@section('header')
   <!-- Google font--><link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{url('assets/bower_components/bootstrap/css/bootstrap.min.css')}}">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="{{url('assets/icon/themify-icons/themify-icons.css')}}">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{{url('assets/icon/icofont/css/icofont.css')}}">
    <!-- flag icon framework css -->
    <link rel="stylesheet" type="text/css" href="{{url('assets/pages/flag-icon/flag-icon.min.css')}}">
    <!-- Menu-Search css -->
    <link rel="stylesheet" type="text/css" href="{{url('assets/pages/menu-search/css/component.css')}}">
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

<!-- i18next.min.js -->
<script type="text/javascript" src="{{url('assets/bower_components/i18next/js/i18next.min.js')}}"></script>
<script type="text/javascript" src="{{url('assets/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js')}}"></script>
<script type="text/javascript"
        src="{{url('assets/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js')}}"></script>
<script type="text/javascript" src="{{url('assets/bower_components/jquery-i18next/js/jquery-i18next.min.js')}}"></script>
<!-- Custom js -->

<script src="{{url('assets/js/pcoded.min.js')}}"></script>
<script src="{{url('assets/js/demo-12.js')}}"></script>
<script src="{{url('assets/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<script type="text/javascript" src="{{url('assets/js/script.js')}}"></script>
@endsection