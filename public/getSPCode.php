<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phoenix Health Insurance Ltd. | Claims Portal - User Authentication</title>
    <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link type="text/css" href="css/theme.css" rel="stylesheet">
    <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
    <!-- <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'  rel='stylesheet'> -->
</head>
<body  >

    


    <div class="wrapper" > 
        <div class="container" align="center" >
            <div class="row" >
                <div class="module module-login span4 offset4">
                    <form class="form-vertical" method="post" action="/">
                        <div class="module-head">
                            <h3 style="color:red">Service Provider Code Required</h3>
                        </div>
                        <br>
                        <p>
                        <img src="images/logo.png" width="200" height="100" align="center"> 
                        </p>


                        <div class="module-body">
                            
                            <div class="control-group">
                                <div class="controls row-fluid">
                            <input style="font-size:15px; padding:25px;" class="span12" type="text" id="spcode" name="spcode" placeholder="Service Provider Code">
                                </div>
                        </div>

                            
                            <div class="control-group">
                                
                                <div class="controls row-fluid">
                                    <input style="font-size:15px; padding:25px;" class="span12" type="password" id="password" name="password" placeholder="Password">
                                </div>
                            </div>
                            <p></p>
                        </div>
                        <div class="module-foot">
                            <div class="control-group">
                                <div class="controls clearfix">
                                    <button type="submit" class="btn btn-primary pull-right">Continue</button>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                </div>
                            </div><p></p>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>  <!--/.wrapper-->

    
    <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</body>
<div style="padding:20px; float:left; width:40%;">
<b><font color="red">PRIVACY NOTIFICATION</font></b><br><br>
<p>
You are welcome to Phoenix Health Insurance Ltd. Claims Portal. This section allows you to configure your sessions with your facility's tarrifs. You are required to provide your Service Provider Code and Password in the section above.
</p>
 Please contact Phoenix Health Insurance Ltd. if you are not sure of your SP Code and password.
</div>