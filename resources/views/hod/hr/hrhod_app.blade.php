@extends('layouts.app')

@section('title')
Approve User
@endsection

@section('navigation')
@include('hod.hr.left-sidebar')
@endsection

@section('content')
<div class="page-wrapper">
                               <!-- Page-header start -->
                               <div class="page-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                 <!-- DOM/Jquery table start -->
                                 <div class="card">
                                            <div class="card-header">
                                                <h5>USER Exit Pass</h5>
                                            </div>
                                            <div class="card-block">
                                                <div class="table-responsive dt-responsive">
                                                    <table class="table table-striped table-bordered nowrap">
                                                    <thead>
                                                                    <tr>
                                                                        <th>Name</th>
                                                                        <th>Type</th>
                                                                        <th>Purpose</th>
                                                                        <th colspan="2">HOD Approve</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                            @forelse($dataDepartPen as $DatPen)
                                                            <tr>
                                                                <td>{{$DatPen->name}}</td>
                                                                <td>{{$DatPen->tipe}}</td>
                                                                <td>{{$DatPen->purpose}}</td>
                                                                <td>{{$DatPen->hod_status}}</td>
                                                                <td>
                                                                    <form method="post" action="{{url('hod-hr/app')}}">
                                                                    {{csrf_field()}}
                                                                        <input type="hidden" name="id" value="{{$DatPen->id}}">
                                                                        <button type="submit" class="btn btn-success btn-mat">Approve</button>
                                                                    </form><span><p></p></span>
                                                                    <form method="post" action="{{url('hod-hr/notapp')}}">
                                                                    {{csrf_field()}}
                                                                        <input type="hidden" name="id" value="{{$DatPen->id}}">
                                                                        <button type="submit" class="btn btn-danger btn-mat">Not Approve</button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                            @empty
                                                            <tr>    
                                                                <td colspan="5" style="text-align: center;"><b><i>NO DATA SHOWN</i></b></td>
                                                            </tr>
                                                            @endforelse
                                                            <tr>
                                                                <td colspan="5"></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="5" class="marketing-header">Not Approve</td>
                                                            </tr>
                                                            @forelse($dataDepartNotApp as $Datno)
                                                            <tr>
                                                                <td>{{$Datno->name}}</td>
                                                                <td>{{$Datno->tipe}}</td>
                                                                <td>{{$Datno->purpose}}</td>
                                                                <td>{{$Datno->hod_status}}</td>
                                                                <td>
                                                                    <form method="post" action="{{url('hod-hr/app')}}">
                                                                    {{csrf_field()}}
                                                                        <input type="hidden" name="id" value="{{$Datno->id}}">
                                                                        <button type="submit" class="btn btn-success btn-mat">Approve</button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                            @empty
                                                            <tr>    
                                                                <td colspan="5" style="text-align: center;"><b><i>NO DATA SHOWN</i></b></td>
                                                            </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- DOM/Jquery table end -->
                                        </div>                 
                                    </div>
                                </div>
                                <!-- Page-header end -->

                                <!-- Page-header start -->
                               <div class="page-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                 <!-- DOM/Jquery table start -->
                                 <div class="card">
                                            <div class="card-header">
                                                <h5>Exit Pass Report</h5>
                                            </div>
                                            <div class="card-block">
                                                <div class="table-responsive dt-responsive">
                                                    <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                                                    <thead>
                                                                    <tr>
                                                                        <th>Name</th>
                                                                        <th>Type</th>
                                                                        <th>Purpose</th>
                                                                        <th>Approved</th>
                                                                        <th>Gate Out</th>
                                                                        <th>Gate In</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                            @forelse($dataDepartApp as $DA)
                                                            <tr>
                                                                <td>{{$DA->name}}</td>
                                                                <td>{{$DA->tipe}}</td>
                                                                <td>{{$DA->purpose}}</td>
                                                                <td>{{$DA->hod_status}}<br>{{$DA->apr_name}} {{$DA->hod_date}} {{$DA->hod_time}}
                                                                <td>Polis : {{$DA->name_police_out}}<br>{{$DA->date_out}} {{$DA->time_out}}</td>
                                                                <td>Polis : {{$DA->name_police_in}}<br>{{$DA->date_in}} {{$DA->time_in}}</td>
                                                            </tr>
                                                            @empty
                                                            <tr>    
                                                                <td colspan="6" style="text-align: center;"><b><i>NO DATA SHOWN</i></b></td>
                                                            </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- DOM/Jquery table end -->
                                        </div>                 
                                    </div>
                                </div>
                                <!-- Page-header end -->
</div>
@endsection


@section('header')
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
    <!-- Data Table Css -->
    <link rel="stylesheet" type="text/css" href="{{url('assets/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('assets/pages/data-table/css/buttons.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('assets/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}">
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
<!-- data-table js -->
<script src="{{url('assets/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{url('assets/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{url('assets/pages/data-table/js/jszip.min.js')}}"></script>
<script src="{{url('assets/pages/data-table/js/pdfmake.min.js')}}"></script>
<script src="{{url('assets/pages/data-table/js/vfs_fonts.js')}}"></script>
<script src="{{url('assets/bower_components/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{url('assets/bower_components/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{url('assets/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{url('assets/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{url('assets/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
<!-- Custom js -->
<script src="{{url('assets/pages/data-table/js/data-table-custom.js')}}"></script>
    <script src="{{url('assets/js/pcoded.min.js')}}"></script>
    <script src="{{url('assets/js/demo-12.js')}}"></script>
    <script src="{{url('assets/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/js/script.js')}}"></script>
@endsection