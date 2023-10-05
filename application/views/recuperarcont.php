<!DOCTYPE html><!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
					<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
					<!--[if IE 8]><html class="no-js lt-ie9" lang="en"> <![endif]-->
					<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
				
<!-- Mirrored from repositorio.autonoma.edu.pe/forgot by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 02 Oct 2023 17:28:30 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head><META http-equiv="Content-Type" content="text/html; charset=UTF-8">

<meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
<meta content="width=device-width,initial-scale=1" name="viewport">

 <link rel="shortcut icon" href="#"> 

<link rel="apple-touch-icon" href="https://repositorio.autonoma.edu.pe/themes/Mirage2/images/apple-touch-icon.png">

<meta name="Generator" content="DSpace 6.3">
<link href="https://repositorio.autonoma.edu.pe/themes/Mirage2/styles/main.css" rel="stylesheet">
<link type="application/opensearchdescription+xml" rel="search" href="https://repositorio.autonoma.edu.pe/open-search/description.xml" title="DSpace">
<script crossorigin="anonymous" integrity="sha384-3LK/3kTpDE/Pkp8gTNp2gR/2gOiwQ6QaO7Td0zV76UFJVhqLl4Vl3KL1We6q6wR9" src="../use.fontawesome.com/releases/v5.1.0/js/all.js" defer></script><script>
				//Clear default text of empty text areas on focus
				function tFocus(element){
					if(element.value == ' '){
						element.value='';
					}
				}
				//Clear default text of empty text areas on submit
				function tSubmit(form){
					var defaultedElements = document.getElementsByTagName("textarea");
					for(var i=0; i != defaultedElements.length; i++){
						if (defaultedElements[i].value == ' '){
							defaultedElements[i].value='';
						}
					}
				}
				//Disable pressing 'enter' key to submit a form (otherwise pressing 'enter' causes a submission to start over)
				function disableEnterKey(e){
					var key;
					if(window.event)
						key = window.event.keyCode; //Internet Explorer
					else
						key = e.which; //Firefox and Netscape
					if(key == 13) //if "Enter" pressed, then disable!
						return false;
					return true;
				}
			</script><!--[if lt IE 9]><script src="/themes/Mirage2/vendor/html5shiv/dist/html5shiv.js"> </script><script src="/themes/Mirage2/vendor/respond/dest/respond.min.js"> </script><![endif]--><script src="https://repositorio.autonoma.edu.pe/themes/Mirage2/vendor/modernizr/modernizr.js"></script>
<title >recuperar contraseña</title>
</head >
<body style="background-color: #080911 ;">
<header>
	
<div role="navigation" class="navbar navbar-default navbar-static-top" style="background-color: #080911 ;">
<div class="container">
<div class="navbar-header">
<button data-toggle="offcanvas" class="navbar-toggle" type="button"><span class="sr-only">navegacion</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a class="navbar-brand" href="<?php echo base_url(); ?>index.php/system/index"><img src="<?php echo base_url(); ?>/img/logobig.jpg"  class="brand-image img-circle elevation-3" style="opacity: .8"></a>
<div class="navbar-header pull-right visible-xs hidden-sm hidden-md hidden-lg">


<ul class="nav nav-pills pull-left">
<li>
<form target="_blank" method="post" action="https://repositorio.autonoma.edu.pe/static/documents/PoliticasAutonoma.pdf" style="display: inline">
<button class="navbar-toggle navbar-link"><b aria-hidden="true" class="visible-xs glyphicon glyphicon-bookmark"></b></button>
</form>
</li>
</ul>
<ul class="nav nav-pills pull-left">
<li>
<form target="_blank" method="post" action="https://repositorio.autonoma.edu.pe/aws/awstats.pl?config=autonoma" style="display: inline">
<button class="navbar-toggle navbar-link"><b aria-hidden="true" class="visible-xs glyphicon glyphicon-signal"></b></button>
</form>
</li>
</ul>
<ul class="nav nav-pills pull-left">
<li>
<form method="get" action="https://repositorio.autonoma.edu.pe/login" style="display: inline">
<button class="navbar-toggle navbar-link"><b aria-hidden="true" class="visible-xs glyphicon glyphicon-user"></b></button>
</form>
</li>
</ul>
</div>
</div>
<div class="navbar-header pull-right hidden-xs">
<ul class="nav navbar-nav pull-left negrita">
<li>
<a target="_blank" href="https://repositorio.autonoma.edu.pe/static/documents/PoliticasAutonoma.pdf">Pol&iacute;ticas</a>
</li>
</ul>
<ul class="nav navbar-nav pull-left">
<li>
<a target="_blank" href="https://repositorio.autonoma.edu.pe/aws/awstats.pl?config=autonoma">Estad&iacute;sticas</a>
</li>
</ul>
<ul class="nav navbar-nav pull-left"></ul>
<ul class="nav navbar-nav pull-left">
<li>
<a href="<?php echo base_url(); ?>index.php/usuarios/logout"><span class="hidden-xs">Usuario</span></a>
</li>
</ul>
<button type="button" class="navbar-toggle visible-sm" data-toggle="offcanvas"><span class="sr-only">navegacion</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
</div>
</div>
</div>
</header>
<div class="trail-wrapper hidden-print" style="background-color: #021ff6;">
<div class="container">
<div class="row">
<div class="col-xs-12">
<div class="breadcrumb dropdown visible-xs">
<a data-toggle="dropdown" class="dropdown-toggle" role="button" href="#" id="trail-dropdown-toggle"> Password&nbsp;<b class="caret"></b></a>
<ul aria-labelledby="trail-dropdown-toggle" role="menu" class="dropdown-menu">
<li role="presentation">
<a role="menuitem" href="https://repositorio.autonoma.edu.pe/"><i aria-hidden="true" class="glyphicon glyphicon-home"></i>
							&nbsp;
							Repositorio</a>
</li>
<li role="presentation" class="disabled">
<a href="#" role="menuitem">Has olvidado tu contraseña</a>
</li>
</ul>
</div>
<ul class="breadcrumb hidden-xs">
<li>
<i aria-hidden="true" class="glyphicon glyphicon-home"></i>
				&nbsp;
			<a href="https://repositorio.autonoma.edu.pe/">Repositorio </a>
</li>
<li class="active">Has olvidado tu contraseña</li>
</ul>
</div>
</div>
</div>
</div>
<div class="hidden" id="no-js-warning-wrapper">
<div id="no-js-warning">
<div class="notice failure">JavaScript is disabled for your browser. Some features of this site may not work without it.</div>
</div>
</div>
<div class="container" id="main-container">
<div class="row row-offcanvas row-offcanvas-right">
<div class="horizontal-slider clearfix">
<div class="col-xs-12 col-sm-12 col-md-9 main-content">
<div>
<form id="aspect_eperson_StartForgotPassword_div_start-forgot-password" class="ds-interactive-div primary" action="https://repositorio.autonoma.edu.pe/forgot" method="post" onsubmit="javascript:tSubmit(this);">
<h2 class="ds-div-head page-header first-page-header">Has olvidado tu contraseña</h2>
<ul id="aspect_eperson_StartForgotPassword_list_forgot-password-progress" class="ds-progress-list list-inline">
<li class="current first">
<span class="label label-success">
Verificar correo electrónico</span>
</li>
<li class="arrow">&rarr;</li>
<li class="">
<span class="label label-default">
Restablecer la contraseña</span>
</li>
<li class="arrow">&rarr;</li>
<li class=" last">
<span class="label label-default">Finalizado</span>
</li>
</ul>
<p class="ds-paragraph">Ingrese la dirección de correo electrónico que proporcionó cuando se registró en el sistema. Se enviará un correo electrónico a esa dirección con más instrucciones.</p>
<fieldset id="aspect_eperson_StartForgotPassword_list_form" class="col ds-form-list">
<div class="ds-form-item row">
<div class="control-group col-sm-12">
<label class="control-label required" for="aspect_eperson_StartForgotPassword_field_email">
Dirección de correo electrónico:&nbsp;</label><input id="aspect_eperson_StartForgotPassword_field_email" class="ds-text-field form-control" name="email" type="text" value="" autofocus="autofocus" title="Enter the same address used when registering.">
<p class="help-block">Ingrese la misma dirección utilizada al registrarse.</p>
</div>
</div>
<div class="ds-form-item row">
<div class="control-group col-sm-12">
<button id="aspect_eperson_StartForgotPassword_field_submit" class="ds-button-field btn btn-default" name="submit" type="submit">Enviar información</button>
</div>
</div>
</fieldset>
<p id="aspect_eperson_StartForgotPassword_p_hidden-fields" class="ds-paragraph hidden">
<input id="aspect_eperson_StartForgotPassword_field_eperson-continue" class="ds-hidden-field form-control" name="eperson-continue" type="hidden" value="4c2005535b2145141f511a29734445177676372f">
</p>
</form>
</div>
<div class="visible-xs visible-sm">
<footer>
<div class="row text-center">
<hr>
<div class="col-sm-4">
<p style="margin-top: 70px">
						Contacto:&nbsp;
						<a href="mailto:repositorio@autonoma.pe">repositorio@autonoma.pe</a>
</p>
</div>
<div class="col-sm-4">
<a style="display: inline-block" target="_blank" href="http://alicia.concytec.gob.pe/"><img alt="" src="https://repositorio.autonoma.edu.pe/themes/Mirage2/images/alicia.png" class="img-responsive"></a>
</div>
<div class="col-sm-4">
<a style="display: inline-block" target="_blank" href="http://www.lareferencia.info/es/"><img style="display: inline-block" alt="" src="https://repositorio.autonoma.edu.pe/themes/Mirage2/images/lareferencia.png" class="img-responsive"></a>
</div>
</div>
<a class="hidden" href="https://repositorio.autonoma.edu.pe/htmlmap">&nbsp;</a>
<p>&nbsp;</p>
</footer>
</div>
</div>
<div role="navigation" id="sidebar" class="col-xs-6 col-sm-3 sidebar-offcanvas">
<div class="word-break hidden-print" id="ds-options">
<div class="ds-option-set" id="ds-search-option">
<form method="post" class="" id="ds-search-form" action="https://repositorio.autonoma.edu.pe/discover">
<fieldset>
<div class="input-group">
<input placeholder="buscar" type="text" class="ds-text-field form-control" name="query"><span class="input-group-btn"><button title="Go" class="ds-button-field btn btn-primary"><span aria-hidden="true" class="glyphicon glyphicon-search"></span></button></span>
</div>
</fieldset>
</form>
</div>
<h2 class="ds-option-set-head page-header  h6">Navegar</h2>
<div id="aspect_viewArtifacts_Navigation_list_browse" class="list-group"  >
<a style="background-color: #080911 ;" class="list-group-item active"><span class="h5 list-group-item-heading  h5" >todo</span></a><a href="https://repositorio.autonoma.edu.pe/community-list" class="list-group-item ds-option" >Communities &amp; colecciones</a><a href="https://repositorio.autonoma.edu.pe/browse?type=dateissued" class="list-group-item ds-option">Por fecha de emisión</a><a href="https://repositorio.autonoma.edu.pe/browse?type=author" class="list-group-item ds-option">Autores</a><a href="https://repositorio.autonoma.edu.pe/browse?type=title" class="list-group-item ds-option">Titulo</a><a href="https://repositorio.autonoma.edu.pe/browse?type=subject" class="list-group-item ds-option">sujetos</a>
</div>
<h2 class="ds-option-set-head page-header  h6">Mi cuenta</h2>
<div id="aspect_viewArtifacts_Navigation_list_account" class="list-group">
<a href="https://repositorio.autonoma.edu.pe/login" class="list-group-item ds-option">Usuario</a><a href="https://repositorio.autonoma.edu.pe/register" class="list-group-item ds-option">Registrarse</a>
</div>
<div id="aspect_viewArtifacts_Navigation_list_context" class="list-group"></div>
<div id="aspect_viewArtifacts_Navigation_list_administrative" class="list-group"></div>
<div id="aspect_discovery_Navigation_list_discovery" class="list-group"></div>
</div>
</div>
</div>
</div>
<div class="hidden-xs hidden-sm">
<footer>
<div class="row text-center">
<hr>
<div class="col-sm-4">
<p style="margin-top: 70px">
						Contacto:&nbsp;
						<a href="mailto:repositorio@autonoma.pe">repositorio@gmail.com</a>
</p>
</div>
<div class="col-sm-4">
<a style="display: inline-block" target="_blank" href="http://alicia.concytec.gob.pe/"><img alt="" src="https://repositorio.autonoma.edu.pe/themes/Mirage2/images/alicia.png" class="img-responsive"></a>
</div>
<div class="col-sm-4">
<a style="display: inline-block" target="_blank" href="http://www.lareferencia.info/es/"><img style="display: inline-block" alt="" src="https://repositorio.autonoma.edu.pe/themes/Mirage2/images/lareferencia.png" class="img-responsive"></a>
</div>
</div>
<a class="hidden" href="https://repositorio.autonoma.edu.pe/htmlmap">&nbsp;</a>
<p>&nbsp;</p>
</footer>
</div>
</div>
<script type="text/javascript">if(typeof window.publication === 'undefined'){window.publication={};};window.publication.contextPath= '';window.publication.themePath= 'https://repositorio.autonoma.edu.pe/themes/Mirage2/';</script><script>if(!window.DSpace){window.DSpace={};}window.DSpace.context_path='';window.DSpace.theme_path='https://repositorio.autonoma.edu.pe/themes/Mirage2/';</script><script src="https://repositorio.autonoma.edu.pe/themes/Mirage2/scripts/theme.js"> </script>
</body>
<!-- Mirrored from repositorio.autonoma.edu.pe/forgot by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 02 Oct 2023 17:28:31 GMT -->
</html>
