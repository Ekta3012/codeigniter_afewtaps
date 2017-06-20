<!DOCTYPE html>
<html lang="en">
<head>
<link rel="shortcut icon" href="images/Logo2.png" type="image/png" />
<!-- all the meta tags -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- end of all the meta tags -->

<title>afewtaps</title>
<base href="<?php echo base_url(); ?>" />
<!-- the stylesheets -->
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="assets/css/main.css" />
    <link rel="stylesheet" href="assets/css/animate.css" >
   

	<!-- the fonts -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
	
	<!-- the fonts -->
	
	<!-- Optional Bootstrap theme -->
	<link rel="stylesheet" href="assets/css/bootstrap-theme.min.css">
<!-- end of all the stylesheets -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link href="{{ captcha_layout_stylesheet_url() }}" type="text/css" rel="stylesheet">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script src="https://use.fontawesome.com/5cd91b09e0.js"></script>

    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/stylesheet.css') }}">
    <script src="{{ URL::asset('js/script.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $(".sec3_p1").mouseenter(function(){
                $("#sec3_p1").hide();
                $("#sec3_p1_h").show();
        });
            $(".sec3_p1").mouseleave(function(){
                $("#sec3_p1").show();
                $("#sec3_p1_h").hide();
        });
        })
    </script>
    <style type="text/css">
        p{
            letter-spacing: 1px;
        }
    </style>

</head>