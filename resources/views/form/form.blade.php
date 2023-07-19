@extends('layouts.master')
@section('menu')
@section('style')
    <style>
        .error{
            color: red;
            border-color: red;
            font-weight: 900;
        }
    </style>
@endsection
    <!-- [ Layout sidenav ] Start -->
    <div id="layout-sidenav" class="layout-sidenav sidenav sidenav-vertical bg-dark">
        <!-- Brand demo (see assets/css/demo/demo.css) -->
        <div class="app-brand demo">
            <span class="app-brand-logo demo">
                <img src="{{URL::to('assets/img/logo-thumb.png')}}" alt="Brand Logo" class="img-fluid">
            </span>
            <a href="{{ route('home') }}" class="app-brand-text demo sidenav-text font-weight-normal ml-2">{{ Auth::user()->name }}</a>
            <a href="javascript:" class="layout-sidenav-toggle sidenav-link text-large ml-auto">
                <i class="ion ion-md-menu align-middle"></i>
            </a>
        </div>
        <div class="sidenav-divider mt-0"></div>

        <!-- Links -->
        <ul class="sidenav-inner py-1">

            <!-- Dashboards -->
            <li class="sidenav-item">
                <a href="{{ route('home') }}" class="sidenav-link">
                    <i class="sidenav-icon feather icon-home"></i>
                    <div>Dashboards</div>
                    @if(Auth::user()->role_name == 'Admin')
                    <div class="pl-1 ml-auto">
                        <div class="badge badge-success">{{ Auth::user()->role_name }}</div>
                    </div>
                    @endif
                    @if(Auth::user()->role_name == 'Normal User')
                    <div class="pl-1 ml-auto">
                        <div class="badge badge-danger">{{ Auth::user()->role_name }}</div>
                    </div>
                    @endif
                    @if(Auth::user()->role_name == null)
                    <div class="pl-1 ml-auto">
                        <div class="badge badge-warning">{{ Auth::user()->role_name }} {{ '[N/A]' }}</div>
                    </div>
                    @endif
                </a>
            </li>

            <!-- Layouts -->
            <li class="sidenav-divider mb-1"></li>
            <li class="sidenav-header small font-weight-semibold">Menu</li>

            <!-- UI elements -->
            @if(Auth::user()->role_name == 'Admin')
            <li class="sidenav-item">
                <a href="javascript:" class="sidenav-link sidenav-toggle">
                    <i class="sidenav-icon fa fa-user"></i>
                    <div>User Management</div>
                </a>
                <ul class="sidenav-menu">
                    <li class="sidenav-item active">
                        <a href="{{ route('role/user/view') }}" class="sidenav-link">
                            <div>User Role</div>
                        </a>
                    </li>

                    <li class="sidenav-item">
                        <a href="bui_progress.html" class="sidenav-link">
                            <div>Maintanain user</div>
                        </a>
                    </li>
                </ul>
            </li>
            @endif
           <!-- Forms -->
           <li class="sidenav-item active open">
                <a href="javascript:" class="sidenav-link sidenav-toggle">
                    <i class="sidenav-icon feather icon-clipboard"></i>
                    <div>Forms</div>
                </a>
                <ul class="sidenav-menu">
                    <li class="sidenav-item active">
                        <a href="{{ route('form/new') }}" class="sidenav-link">
                            <div>User Infomation</div>
                        </a>
                    </li>
                </ul>
            </li>

        <!-- Report -->
            <li class="sidenav-item">
                <a href="javascript:" class="sidenav-link sidenav-toggle">
                    <i class="sidenav-icon feather icon-file-minus"></i>
                    <div>Report</div>
                </a>
                <ul class="sidenav-menu">
                    <li class="sidenav-item">
                        <a href="{{ route('form/view/report') }}" class="sidenav-link">
                            <div>Report Data</div>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- [ Layout sidenav ] End -->
@endsection
@section('content')
<!-- [ Layout content ] Start -->
<div class="layout-content">
    <!-- [ content ] Start -->
    <div class="container-fluid flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-0">Form / New</h4>
        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="feather icon-home"></i></a></li>
                <li class="breadcrumb-item">Form</li>
                <li class="breadcrumb-item active">Form</li>
            </ol>
        </div>

        <div class="card mb-4">
            <h6 class="card-header"><i class="feather icon-user"></i> Form Infomation</h6>

            <div class="card-body">

                <div class="form-group row">
                    <div class="col-sm-12">
                        @if(\Session::has('insert'))
                            <div id="hide-message" class="alert alert-success alert-dismissible fade show">
                                <i class="feather icon-check-circle" style="font-size:1em"></i>
                                {!! \Session::get('insert') !!}
                            </div>
                        @endif
                        <div class="clearfix"></div>
                    </div>
                </div>
                <form id="validation" action="{{ route('form/save') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-sm-right">Full Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Full Name" required>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-sm-right">Company Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="company" name="company" placeholder="Enter Company Name" required>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-sm-right">Email Address</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email Address" >
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-sm-right">Gender</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="sex" name="sex" placeholder="Enter Gender" >
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-sm-right">Country</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="country" name="country" placeholder="Enter Country" >
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-sm-right">Phone Number</label>
                        <div class="col-sm-10">
                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter Phone Number" required>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-sm-right">Notes</label>
                        <div class="col-sm-10">
                            {{-- <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter Phone Number" required> --}}
                            <textarea name="notes" class="form-control" rows="4" placeholder="Enter Notes"></textarea>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    {{-- <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-sm-right">Facebook Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="facebook_name" name="facebook_name" placeholder="Enter Facebook Name" required>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-sm-right">YouTube Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="youtube_name" name="youtube_name" placeholder="Enter YouTube Name" required>
                            <div class="clearfix"></div>
                        </div>
                    </div> --}}

                    <div class="form-group row">
                        <label class="col-form-label col-sm-2 text-sm-right"></label>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-danger">Cencel</button>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- [ content ] End -->
    </div>

    <!-- [ Layout footer ] Start -->
    <nav class="layout-footer footer bg-white">
        <div class="container-fluid d-flex flex-wrap justify-content-between text-center container-p-x pb-3">
            <div class="pt-3">
                <span class="footer-text font-weight-semibold">&copy; <a href="https://innoworx.site/" class="footer-link" target="_blank">INNOWORX</a></span>
            </div>
            <div>
                <a href="javascript:" class="footer-link pt-3">About Us</a>
                <a href="javascript:" class="footer-link pt-3 ml-4">Help</a>
                <a href="javascript:" class="footer-link pt-3 ml-4">Contact</a>
                <a href="javascript:" class="footer-link pt-3 ml-4">Terms &amp; Conditions</a>
            </div>
        </div>
    </nav>
    <!-- [ Layout footer ] End -->
</div>

<!-- [ Layout content ] Start -->

@endsection
@section('script')
    <!-- library js validate -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.js"></script>
    {{-- form validate --}}

    <script>
        $('#validation').validate({
            reles:{
                name:{
                    required:true,
                },
                company:{
                    required:true,
                },
                // email:{
                //     required:false,
                // },
                // sex:{
                //     required:false,
                // },
                // country:{
                //     required:false,
                // },
                phone:{
                    required:true,
                },
                // facebook_name:{
                //     required:false,
                // },
                // youtube_name:{
                //     required:false,
                // }
            },
            messages:{
                name:"Please input full name*",
                company:"Please input company name*",
                // email:"Please input email*",
                // sex:"Please input sex*",
                // country:"Please input country*",
                phone:"Please input phone number*",
                // facebook_name:"Please input facebook name*",
                // youtube_name:"Please input youtube name*",
            }
        });
    </script>

    {{-- hide message js --}}
    <script>

        $('#hide-message').show();
        setTimeout(function()
        {
            $('#hide-message').hide();
        },5000);

    </script>
@endsection
