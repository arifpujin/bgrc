@extends('layouts.app')

@section('title')
Data User
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
                                                    <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                                                    <thead>
                                                                    <tr>
                                                                        <th>Employee ID</th>
                                                                        <th>Name</th>
                                                                        <th><div class="col-sm-8">Level</div></th>
                                                                        <th><div class="col-sm-11">Department</div></th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                            @forelse($users as $us)
                                                            <tr>
                                                                <td>{{$us->username}}</td>
                                                                <td>{{$us->name}}</td>
                                                                <td>
                                                                    
                                                            <form method="post" action="{{url('hod-hr/useredit')}}">
                                                                {{ csrf_field() }}
                                                             <div class="col-sm-8">
                                                                    <select name="level" class="form-control form-control-sm">
                                                                    <option value="{{$us->level}}">{{$us->level}}</option>
                                                                    <option value="HOD">Head Of Department</option>
                                                                    <option value="Employee">Employee</option>
                                                                    <option value="Student">Student</option>
                                                                </select>
                                                                </div>
                                                                </td>
                                                                <td><div class="col-sm-11">
                                                                    <select name="depart" class="form-control form-control-sm">
                                                                    <option value="{{$us->depart}}">{{$us->depart}}</option>
                                                                        @foreach($department as $de)
						                                                    <option value="{{ $de->name }}">{{ $de->name }}</option>
						                                                @endforeach
						                                        </select>
						                                        </div>
						                                        </td>
                                                                <td><div class="col-sm-3">
                                                                     <input type="hidden" name="id" value="{{$us->id}}">
                                                                    <div class="btn-group btn-group-sm" style="float: none;">
                                                                    <button type="submit" class="tabledit-edit-button btn btn-primary waves-effect waves-light" style="float: none;margin: 5px;">
                                                                        <span class="icofont icofont-ui-edit"></span>
                                                                    </button>
                                                                    </div>
                                                                </form>
                                                                    <form method="post" action="{{url('hod-hr/userdel')}}">
                                                                    {{ csrf_field() }}
                                                                        <input type="hidden" name="id" value="{{$us->id}}">
                                                                        <div class="btn-group btn-group-sm" style="float: none;">
                                                                        <button type="submit" class="tabledit-delete-button btn btn-danger waves-effect waves-light" style="float: none;margin: 5px;">
                                                                            <span class="icofont icofont-ui-delete"></span>
                                                                        </button>
                                                                    </div>
                                                                    </form>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            @empty
                                                            <tr>    
                                                                <td colspan="8" style="text-align: center;"><b><i>NO DATA SHOWN</i></b></td>
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