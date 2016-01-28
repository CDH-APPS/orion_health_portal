<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Phoenix Health Insurance - Vetting Portal</title>
        <link href="{{ URL::to('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::to('bootstrap/css/bootstrap-responsive.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::to('css/theme.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::to('css/popup.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::to('images/icons/css/font-awesome.css') }}" rel="stylesheet" type="text/css" />
        <script src="{{ URL::to('scripts/jquery-1.9.1.min.js') }}"></script>
        <script src="{{ URL::to('scripts/jquery-ui-1.10.1.custom.min.js') }}"></script>
        <script src="{{ URL::to('scripts/jquery.dataTables.min.js') }}"></script>
        <script src="{{ URL::to('scripts/jquery-1.11.3.min.js') }}"></script>
       
    </head>
    <body>

        <!-- Top Bar Showing Service Provider Name -->
        <div class="navbar navbar-fixed-top" >
            <div class="navbar-inner" style="background:black;">
                <div class="container" style="padding:10px;">
                    <div class="nav pull-left" >  
                     <b>
                     <font color="white">
                         VETTING PORTAL
                     </font>
                     </b>
                     </div>

                    <div class="nav pull-right">                       
                    Phoenix Health Vetting Portal | <?php echo date('d-m-Y'); ?>
                    </div>

                </div>
            </div>
        </div>
        <!-- End Top Bar Showing Provider Name -->


        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                        <i class="icon-reorder shaded"></i></a><a class="brand" href="/Home">           
                        {!! Html::image('images/logo.png', 'Logo',array('width' => 150 , 'height' => 50)) !!}
                        </a>
                    <div class="nav-collapse collapse navbar-inverse-collapse">
                       
                        <ul class="nav pull-right">
                           
                          
                            <li><a href="#">Welcome, John Doe</a></li>
                            <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                               
                                {!! Html::image('images/user.png','User',array('width' => 20 , 'height' => 20)) !!}
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">User Profile</a></li>
                                    <li><a href="#">Change Password</a></li>
                                   
                                    <li class="divider"></li>
                                    <li><a href="/Vetting">Logout</a></li>
                                </ul>
                            </li>

                        </ul>
                    </div>
                    <!-- /.nav-collapse -->
                </div>
            </div>
            <!-- /navbar-inner -->
        </div>
        <!-- /navbar -->
        <div class="iniwrapper wrapper">
            <div class="container">
                <div class="row">
                    <div class="span3">
                        <div class="sidebar">
                            <ul class="widget widget-menu unstyled">
                                
                                <li>
                                <a href="/ClaimsPool"><i class="menu-icon icon-file"></i>Claims Pool</a>
                                </li>
                                <li>
                                <a href="/PendingClaims"><i class="menu-icon icon-tasks"></i>Pending Claims<b class="label green pull-right">                                 
                                </b> </a>
                                </li>
                                 <li>
                                <a href="/PriorAuthorization"><i class="menu-icon icon-user"></i>Prior Authorization<b class="label green pull-right">                                 
                                </b> </a>
                                </li>
                                <li>
                                <a href="/VettingReports"><i class="menu-icon icon-paste"></i>Reports<b class="label green pull-right">                                 
                                </b> </a>
                                </li>
                                
                            </ul>
                            
                            
                        </div>
                        <!--/.sidebar-->
                    </div>
                    <!--/.span3-->
                    <div class="span9">
                        <div class="content">
                            

                        @if (Session::has('success_message'))
                            <div class="alert alert-success">
                            <p class="alert">{{ Session::get('success_message')}}</p>
                            </div>
                        @endif

                        @if (Session::has('error_message'))
                            <div class="alert alert-warning">
                            <p class="alert">{{ Session::get('error_message')}}</p>
                            </div>
                        @endif

                        @yield('content')      


                        </div>
                        <!--/.content-->
                    </div>
                    <!--/.span9-->
                </div>
            </div>
            <!--/.container-->
        </div>
        <!--/.wrapper-->
        <div class="footer">
            <div class="container">
                <b class="copyright">&copy; <?php echo date('Y'); ?> Phoenix Health Insurance Ltd.</b> | Developed By OrionLabs.
            </div>
        </div>
       

        <script src="{{ URL::to('bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ URL::to('scripts/flot/jquery.flot.js') }}"></script>
        <script src="{{ URL::to('scripts/flot/jquery.flot.resize.js') }}"></script>
        <script src="{{ URL::to('scripts/datatables/jquery.dataTables.js') }}"></script>
        <script src="{{ URL::to('scripts/common.js') }}"></script>
        <script src="{{ URL::to('scripts/jquery.popup.js') }}"></script>
        <script src="{{ URL::to('scripts/jquery.popup.min.js') }}"></script>

      
    </body>


					
 <script type="text/javascript" src="scripts/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("images/login-bg.png", {speed: 500});
    </script>

