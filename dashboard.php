<?php
    require_once 'inc/mysql.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Bootstrap, from Twitter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/font-awesome.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }

      table i {
        float: right;
      }
      
      .sql-table tr td i {
        float:right;
        margin-right:5px;
      }
      
      .table-nav {
        float:right;
      }

      footer {
        float:right;
      }

      footer img {
        height:30px;
      }
      
      .plus img {
        height:15px;
      }
      
      .plus-new {
        margin-left:5px;
      }

      @media (max-width: 980px) {
        /* Enable use of floated navbar text */
        .navbar-text.pull-right {
          float: none;
          padding-left: 5px;
          padding-right: 5px;
        }
      }
    </style>
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="assets/ico/favicon.png">
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#">Sequelly</a>
          <div class="nav-collapse collapse">
            <p class="navbar-text pull-right">
              Using database <b><a href="#" class="navbar-link">users</a></b>
            </p>
            <ul class="nav">
                <li><a href="#" class="plus"><img src="assets/img/plus.png" /> <span class="plus-new">New Row</span></a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span3">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header"><i class="icon-hdd"></i> Tables</li>
              <?php
                    // Fetch all the tables from the database
                    $q = mysql_query("SHOW TABLES");
                    
                    // Loop through the results and show each table as a list item
                    while ($table = mysql_fetch_assoc($q))
                    {
                        echo "<li><a href=\"" . $table['Tables_in_' . $database]. "\">", $table['Tables_in_' . $database], "</a></li>";
                    }
              ?>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span9">
          <div class="row-fluid">
            <table class="table table-bordered table-striped sql-table">
                   <?php
                        $table = substr($_GET['table'], 1);
                        if ($table != "")
                        {
                            $result = mysql_query("SHOW TABLES LIKE '" . $table . "'");
                            $tableExists = mysql_num_rows($result) > 0; 
                            if ($tableExists == 1)
                            {
                                $rows = mysql_query("SELECT * FROM " . $table . " LIMIT 1", $db) or die(mysql_error());
                                
                                $columns = mysql_fetch_assoc($rows);
                                ?>
                                <thead>
                                <?php
                                foreach ($columns as $key => $value)
                                {
                                    echo "<th>" . $key . "</th>";
                                }
                                ?>
                                </thead>
                                <tbody>
                                <?php
                                $rows = mysql_query("SELECT * FROM " . $table . "", $db) or die(mysql_error());
                                while ($row = mysql_fetch_assoc($rows))
                                {

                                    echo "<tr>";
                                    foreach ($row as $key => $value)
                                    {
                                        echo "<td>" . $value . "</td>";
                                    }
                                    echo "<td><i class=\"icon-pencil\"></i><i class=\"icon-remove\"></i></td>";
                                    echo "</tr>";
                                }
                            }
                            else
                            {
                                // Fetch all the tables from the database
                                $q = mysql_query("SHOW TABLES");
                                
                                // Loop through the results and show each table as a list item
                                while ($table = mysql_fetch_assoc($q))
                                {
                                    echo "<tr><td><a href=\"#\">", $table['Tables_in_sequelly'], "</a></td></tr>";
                                }      
                            }
                        }
                        else
                        {
                            // Fetch all the tables from the database
                            $q = mysql_query("SHOW TABLES");
                            
                            // Loop through the results and show each table as a list item
                            while ($table = mysql_fetch_assoc($q))
                            {
                                echo "<tr><td><a href=\"#\">", $table['Tables_in_sequelly'], "</a></td></tr>";
                            }       
                        }
                    ?>
                </tbody>
            </table>
            <div class="pagination table-nav">
  <ul>
    <li><a href="#">&laquo;</a></li>
    <li><a href="#">1</a></li>
    <li class="active"><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li>
    <li><a href="#">&raquo;</a></li>
  </ul>
</div>
          </div><!--/row-->
        </div><!--/span-->
      </div><!--/row-->

      <hr>

      <footer>
        <p>{ "madeBy": <a href="http://www.shne.info/">"Shane Curran"</a>,
             "github": <a href="http://github.com/ShaneCurran/Sequelly"><img src="assets/img/github.png" height="30" /></a> 
           }</p>
      </footer>

    </div><!--/.fluid-container-->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap-transition.js"></script>
    <script src="assets/js/bootstrap-alert.js"></script>
    <script src="assets/js/bootstrap-modal.js"></script>
    <script src="assets/js/bootstrap-dropdown.js"></script>
    <script src="assets/js/bootstrap-scrollspy.js"></script>
    <script src="assets/js/bootstrap-tab.js"></script>
    <script src="assets/js/bootstrap-tooltip.js"></script>
    <script src="assets/js/bootstrap-popover.js"></script>
    <script src="assets/js/bootstrap-button.js"></script>
    <script src="assets/js/bootstrap-collapse.js"></script>
    <script src="assets/js/bootstrap-carousel.js"></script>
    <script src="assets/js/bootstrap-typeahead.js"></script>

  </body>
</html>