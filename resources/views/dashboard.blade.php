@extends('layouts.app')

@section('css')
<style type="text/css">
    .mod{
        background-color: #fff;
        text-align: center;
        justify-content: center;
        display: block;
        margin-top: 10px;
    }
     a:hover{
        /*box-shadow: 10px 10px 5px grey;*/
        box-shadow: 0 10px 20px 0 rgba(177,177,177,0.5);
    }
    .inmod{
        text-align: left;
        margin-bottom: 10px;
    }
    .inmod-l{padding-right: 0; padding-top: 5px;}
    .inmod-r{padding-left: 0;padding-top: 15px;}
    .mod i{
        font-size: 50px;
    }
     .mod p{

        font-size: 28px;
        color: #000D19;
        line-height: 20px;
    }
    .btnn{
        background-color: #E7372C;        
        width: 128px;
        margin-bottom: 10px;
    }
</style>
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
        @include('flash::message')
        </div>
    </div>
    <!-- <h1>
        Dashboard
        <small>Menu</small>
    </h1> -->
    
</section>

<!-- Main content -->
<section class="content">
    <!-- Info boxes -->
    <div class="row">
        @role(['superadministrator', 'administrator', 'user'])
        

        <div class="col-md-3 col-sm-6 col-xs-12" >
            <a class="col-md-12 mod" href="{{ url('analytics') }}">
                <div class="col-sm-12 inmod" >
                    <div class="col-sm-4 inmod-l">
                        <i class="fa fa-list-alt"></i>
                    </div>
                    <div class="col-sm-8 inmod-r">
                        <p>Analitik</p>
                    </div>
                </div>
                <div class="col-sm-12" >
                    <div class="btn btn-danger btnn">BUKA</div>
                </div>
                
            </a>
            
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12" >
            <a class="col-md-12 mod" href="{{ url('suratJalans') }}">
                <div class="col-sm-12 inmod" >
                    <div class="col-sm-4 inmod-l">
                        <i class="fa fa-list-alt"></i>
                    </div>
                    <div class="col-sm-8 inmod-r">
                        <p>Modul</p>
                    </div>
                </div>
                <div class="col-sm-12" >
                    <div class="btn btn-danger btnn">BUKA</div>
                </div>
                
            </a>
            
        </div>

        
        @endrole

        @role(['superadministrator'])

        <div class="col-md-3 col-sm-6 col-xs-12" >
            <a class="col-md-12 mod" href="{{ url('users') }}">
                <div class="col-sm-12 inmod" >
                    <div class="col-sm-4 inmod-l">
                        <i class="fa fa-list-alt"></i>
                    </div>
                    <div class="col-sm-8 inmod-r">
                        <p>User</p>
                    </div>
                </div>
                <div class="col-sm-12" >
                    <div class="btn btn-danger btnn">BUKA</div>
                </div>
                
            </a>
            
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12" >
            <a class="col-md-12 mod" href="{{ url('cars') }}">
                <div class="col-sm-12 inmod" >
                    <div class="col-sm-4 inmod-l">
                        <i class="fa fa-list-alt"></i>
                    </div>
                    <div class="col-sm-8 inmod-r">
                        <p>Master</p>
                    </div>
                </div>
                <div class="col-sm-12" >
                    <div class="btn btn-danger btnn">BUKA</div>
                </div>
                
            </a>
            
        </div>
        
        @endrole
        @role(['superadministrator', 'administrator'])

        <div class="col-md-3 col-sm-6 col-xs-12" >
            <a class="col-md-12 mod" href="{{ url('settings') }}">
                <div class="col-sm-12 inmod" >
                    <div class="col-sm-4 inmod-l">
                        <i class="fa fa-list-alt"></i>
                    </div>
                    <div class="col-sm-8 inmod-r">
                        <p>Pengaturan</p>
                    </div>
                </div>
                <div class="col-sm-12" >
                    <div class="btn btn-danger btnn">BUKA</div>
                </div>
                
            </a>
            
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12" >
            <a class="col-md-12 mod" href="{{ url('settings') }}">
                <div class="col-sm-12 inmod" >
                    <div class="col-sm-4 inmod-l">
                        <i class="fa fa-list-alt"></i>
                    </div>
                    <div class="col-sm-8 inmod-r">
                        <p>Laporan</p>
                    </div>
                </div>
                <div class="col-sm-12" >
                    <div class="btn btn-danger btnn">BUKA</div>
                </div>
                
            </a>
            
        </div>
        

       
        @endrole
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
@endsection

@section('scripts')
    <!-- FastClick -->
    <script src="{{ asset('vendor/adminlte/plugins/fastclick/fastclick.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('vendor/adminlte/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
    <!-- jvectormap -->
    <script src="{{ asset('vendor/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('vendor/adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="{{ asset('vendor/adminlte/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="{{ asset('vendor/adminlte/plugins/chartjs/Chart.min.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('vendor/adminlte/dist/js/pages/dashboard2.js') }}"></script>
@endsection
