<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Demo</title>
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
  </script>
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
                <a class="navbar-brand" href="/index.php/store" style="font-size:24px;"> Demo</a>
            </div>
            <!-- Top Menu Items -->


        </nav>

        <div id="page-wrapper">