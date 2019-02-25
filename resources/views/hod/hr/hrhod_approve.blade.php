@extends('layouts.app')

@section('title')
HOD Approve
@endsection

@section('navigation')
@include('hod.hr.left-sidebar')
@endsection

@section('content')
<div class="page-wrapper">
                                <!-- Page-header start -->
                                <div class="page-body">
                                    <div class="row">
                                        <!-- Marketing Start -->
                                        <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <div class="card-header-left">
                                                            <h5>Data Employee {{Auth::user()->depart}} Exit Pass</h5>
                                                        </div>
                                                        <div class="card-header-right">
                                                            <ul class="list-unstyled card-option">
                                                                <li><i class="icofont icofont-simple-left "></i></li>
                                                                <li><i class="icofont icofont-maximize full-card"></i></li>
                                                                <li><i class="icofont icofont-minus minimize-card"></i></li>
                                                                <li><i class="icofont icofont-refresh reload-card"></i></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="card-block p-t-0">
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Name</th>
                                                                        <th>Type</th>
                                                                        <th>Purpose</th>
                                                                        <th colspan="2">HOD Approve</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                        <td colspan="5" class="marketing-header">Today ( {{$tanggal}} )</td>
                                                                </tr>
                                                                @forelse($dataDepartPen as $DatPen)
                                                                    <tr>
                                                                        <td>
                                                                            <div class="table-contain">
                                                                                <h6>{{$DatPen->name}}</h6>
                                                                                <p class="text-muted">{{$DatPen->created_at}}</p>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <p class="text-muted">{{$DatPen->tipe}}</p>
                                                                        </td>
                                                                        <td>
                                                                            <i class="icofont icofont-bird text-c-green"></i>
                                                                            <p class="m-l-10 text-c-green">{{$DatPen->purpose}}</p>
                                                                        </td>
                                                                        <td><span>{{$DatPen->hod_status}}</span></td>
                                                                        <td>
                                                                            <from method="post" action="{{url('/hodlist/ubah-app/')}}" id="ubah-app">
                                                                            {{csrf_field()}}
                                                                                <input type="" name="idku" value="{{ old('id', $DatPen->id) }}">
                                                                                <button type="submit" class="btn btn-default btn-bg-c-green btn-outline-default btn-round btn-action reload-card">Approve</button>
                                                                            </form>
                                                                            <br>
                                                                            <br>
                                                                        
                                                                        </td>
                                                                    </tr>
                                                                    @empty
                                                                        <tr>    
                                                                            <td colspan="6" style="text-align: center;"><b><i>NO DATA SHOWN</i></b></td>
                                                                        </tr>
                                                                    @endforelse
                                                                    <tr>
                                                                        <td colspan="5"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="5" class="marketing-header">Not Approve</td>
                                                                    </tr>
                                                                    @forelse($dataDepartNotApp as $DatNotApp)
                                                                    <tr>
                                                                        <td>
                                                                            <div class="table-contain">
                                                                                <h6>{{$DatNotApp->name}}</h6>
                                                                                <p class="text-muted">{{$DatNotApp->created_at}}</p>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <p class="text-muted">{{$DatNotApp->tipe}}</p>
                                                                        </td>
                                                                        <td>
                                                                            <i class="icofont icofont-bird text-c-green"></i>
                                                                            <p class="m-l-10 text-c-green">{{$DatNotApp->purpose}}</p>
                                                                        </td>
                                                                        <td><span>{{$DatNotApp->hod_status}}</span></td>
                                                                        <td>
                                                                            <!--<button class="btn btn-default btn-bg-c-green btn-outline-default btn-round btn-action reload-card" data-pk="{{ $DatNotApp->id }}" data-url="{{ URL::to('/hodlist/ubah-app/') }}" >Approve</button><p>  </p-->
                                                                        </td>
                                                                    </tr>
                                                                    @empty
                                                                        <tr>    
                                                                            <td colspan="6" style="text-align: center;"><b><i>NO DATA SHOWN</i></b></td>
                                                                        </tr>
                                                                    @endforelse
                               
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="row marketing-card-footer">
                                                            
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Marketing End -->
                                            
                                            <!-- DOM/Jquery table start -->
                                            <div class="col-md-12">                                        
                                            <div class="card">
                                            <div class="card-header">
                                                <h5>Database Exit Pass Report</h5><br><br>
                                                <p>Department : {{Auth::user()->depart}}</p>
                                            </div>
                                            <div class="card-block">
                                                <div class="table-responsive dt-responsive">
                                                    <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                                                    <thead>
                                                                    <tr>
                                                                        <th>Date/ Time</th>
                                                                        <th>Name</th>
                                                                        <th>Type of Exit Pass</th>
                                                                        <th>Purpose</th>
                                                                        <th>Approved</th>
                                                                        <th>Date/Time Out</th>
                                                                        <th>Date/Time In</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                            @forelse($dataDepartApp as $DatApp)
                                                            <tr>
                                                                <td>{{$DatApp->created_at}}</td>
                                                                <td>{{$DatApp->name}}</td>
                                                                <td>{{$DatApp->tipe}}</td>
                                                                <td>{{$DatApp->purpose}}</td>
                                                                <td>{{$DatApp->hod_status}}<br>{{$DatApp->apr_name}} {{$DatApp->hod_date}} {{$DatApp->hod_time}}</td>
                                                                <td>Name Police : {{$DatApp->name_police_out}}<br>Date out : {{$DatApp->date_out}}<br>Time out : {{$DatApp->time_out}}</td>
                                                                <td>Name Police : {{$DatApp->name_police_in}}<br>Date in : {{$DatApp->date_in}}<br>Time in : {{$DatApp->time_in}}</td>
                                                            </tr>
                                                            @empty
                                                            <tr>    
                                                                <td colspan="7" style="text-align: center;"><b><i>NO DATA SHOWN</i></b></td>
                                                            </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        <!-- DOM/Jquery table end -->

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
    <!-- Validation js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
    <script type="text/javascript" src="{{url('assets/pages/form-validation/validate.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/pages/form-validation/form-validation.js')}}"></script>
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