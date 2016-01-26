<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>demo</title>

    <!-- Bootstrap Core CSS -->
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/bootstrap/css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="/bootstrap/css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/bootstrap/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link href="/bootstrap/css/jquery-ui.css" rel="stylesheet" type="text/css">


    <!-- jQuery -->
    <script src="/bootstrap/js/jquery.js"></script>
    
    <script src="/bootstrap/js/jquery-ui.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/bootstrap/js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript 
    <script src="/bootstrap/js/plugins/morris/raphael.min.js"></script>
    <script src="/bootstrap/js/plugins/morris/morris.min.js"></script>
    <script src="/bootstrap/js/plugins/morris/morris-data.js"></script>-->

</head>
<style type="text/css">
.page_section a {
position: relative;
float: left;
padding: 4px 8px;
margin-left: -1px;
line-height: 1.42857143;
color: #337ab7;
text-decoration: none;
background-color:#fff;
border: 1px solid #ddd;

}
.page_section strong {
position: relative;
float: left;
padding: 4px 8px;
margin-left: -1px;
line-height: 1.42857143;
color: #fff;
text-decoration: none;
background-color:#337ab7;
border: 1px solid #337ab7;

}
</style>

<body>
  <script>
  $(function() {
    $( ".dp" ).each(function(){
                $(this).datepicker({
                    showButtonPanel: true,
                    dateFormat: "yy-mm-dd"
                });
            })



  });
  function message(message_str,result){
    $('#message').html(message_str);
    if (result ==1) {
       $('#message').css('background','#00bce2'); 
    }else if (result ==0) {
        $('#message').css('background','red'); 
    }
     $('#message').show();
     setInterval(closemessage, 2000);


  }
  function closemessage(){

    $( "#message" ).fadeOut( "slow" );
  }







  </script>
<div id="message" style="width:100%; height:55px; line-height:55px;;position:fixed;top:0px; z-index:2001; font-size:20px; color:#FFFFFF; text-align:center;display:none; ">

  </div>


    <div id="wrapper">

              <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a class="navbar-brand" href="/index.php/store" style="font-size:24px;">  demo</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Admin <b class="caret"></b></a>
                    <ul class="dropdown-menu" style="min-width:190px;">
                        <li>
                            <a href="/index.php/auth/change_password"><i class="fa fa-fw fa-cog"></i> Change Password</a>
                        </li>
                        <li>
                            <a href="/index.php/auth/logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li id="store_li">
                        <a href="/index.php/store"><i class="fa fa-fw fa-home"></i> Dashboard</a>
                    </li>                   
                    <li id="brand_li" >
                        <a href="/index.php/brand"><i class="fa fa-fw fa-tags"></i> Brand</a>
                    </li> 
                    <li id="category_li" >
                        <a href="/index.php/category"><i class="fa fa-fw fa-list"></i> Category</a>
                    </li>           
                    <li id="product_li">
                        <a href="/index.php/product"><i class="fa fa-fw fa-shopping-cart"></i> Product</a>
                    </li> 
                    <li id="stock_li">
                        <a href="/index.php/stock"><i class="fa fa-fw fa-shopping-cart"></i> Stock</a>
                    </li> 
                    <li id="fetch_li">
                        <a href="/index.php/fetch"><i class="fa fa-fw fa-shopping-cart"></i> Fetch</a>
                    </li>  
                    <li id="consumer_li">
                        <a href="/index.php/consumer"><i class="fa fa-fw fa-male"></i> Consumer</a>
                    </li> 
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">