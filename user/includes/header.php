<!DOCTYPE html>
<html>
<head>
  	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<title>Truber</title>
  	<!-- Tell the browser to be responsive to screen width -->
  	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  	<!-- Bootstrap 3.3.7 -->
  	<link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  	<!-- Font Awesome -->
  	<link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="../bower_components/select2/dist/css/select2.min.css">
  	<!-- Theme style -->
  	<link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  	<!-- DataTables -->
    <link rel="stylesheet" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="../bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="../plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    <link rel="apple-touch-icon" href="./../../assets/img/trbs.png">
  	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  	<!--[if lt IE 9]>
  	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  	<![endif]-->

    <link rel="stylesheet" href="../maps/dist/leaflet.css" />
    <link rel="stylesheet" href="../maps/dist/leaflet-routing-machine.css" />
    <link rel="stylesheet" href="../maps/dist/index.css" />

<!--    MaPS-->
  
    <link rel="stylesheet" href="../assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="../assets/css/beautiful-dismissable-alert.css">
    <link rel="stylesheet" href="../assets/css/Button-Outlines---Pretty.css">
    <link rel="stylesheet" href="../assets/css/Google-Style-Login.css">
    <link rel="stylesheet" href="../assets/css/top-alert-ie-E-Mail-Confirmation.css">

  	<!-- Google Font -->
  	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  	<style type="text/css">
  		.mt20{
  			margin-top:20px;
  		}
      .bold{
        font-weight:bold;
      }

      /*chart style*/
      #legend ul {
        list-style: none;
      }

      #legend ul li {
        display: inline;
        padding-left: 30px;
        position: relative;
        margin-bottom: 4px;
       /* border-radius: 5px;*/
        padding: 2px 8px 2px 28px;
        font-size: 14px;
        cursor: default;
        -webkit-transition: background-color 200ms ease-in-out;
        -moz-transition: background-color 200ms ease-in-out;
        -o-transition: background-color 200ms ease-in-out;
        transition: background-color 200ms ease-in-out;
      }

      #legend li span {
        display: block;
        position: absolute;
        left: 0;
        top: 0;
        width: 20px;
        height: 100%;
       /* border-radius: 5px;*/
      }
        .rideBtn, #mm2{
            display: none;;
        }
        .all-info, .all-info2{
            position: absolute;
            display: none;
            z-index: 1;
            background: white;
            width: 93%;
            font-size: large;
        }
        .address-select:hover ,.address-select2:hover{
            text-decoration:none;
            text-shadow: 1px 1px 1px #555;
        }
        .address-select,.address-select2 {
            cursor:pointer;
        }
        .content-wrapper{
            /*background: transparent !important;*/
        }
        .adjust{
            z-index: 9;
            position: relative;
            background: #ecf0f5;
            padding: 40px;
        }
        .back-btn{
            position: fixed;
            z-index: 999;
            padding: 5px;
            color: antiquewhite;
        }
        @media (max-width: 1200px) {
            .adjust{
                width: 100% !important;
                padding: 2px;
            }

            form .fa{
                font-size: larger;
            }
        }

        .face1, .face2{
            z-index: 9;
            position: relative;
            border: none;
            font-weight: bolder;
        }
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
  	</style>
</head>