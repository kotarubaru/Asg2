<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>{pagetitle}</title>
        <meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8"/>
        <link rel="stylesheet" type="text/css" media="all" href="/assets/css/style.css"/>
        <link rel="stylesheet" type="text/css" media="all" href="/assets/css/menu.css"/>
	<!--<link rel="stylesheet" type="text/css" media="all" href="css/lightbox.css" />-->
    </head>
    <body>
        <div id="wrapper">
            <nav>
                <div id="nav-left">
                    <ul id="nav-bar">
                        <li><a href="/">Home</a></li> 
                        {menu}
                    </ul>
                </div>
                <div id="nav-right">{login}</div>
           </nav>
           <div id="navspace"></div>
            <div id="content">
                {content}
            </div>
            <hr/>
            <footer>
                Copyright &copy; 2016  Samuel McLaughlin, Wilson Hoy &amp; Michael Chung</a>.
            </footer>
        </div>
        <script type="text/javascript" src="/assets/js/jquery-1.11.1.min.js"></script> 
        <!--<script type="text/javascript" src="js/lightbox.min.js"></script> -->
    </body>
</html>

