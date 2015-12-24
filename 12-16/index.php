<!DOCTYPE html>
<html lang="en">

<head>
    <?php
        include 'header.php';
    ?>
    <style>
    .footer {
      position: absolute;
      bottom: 0;
      width: 100%;
      height: 60px;
      background-color:#F8F8F8;
      color:black;
      border:1px solid transparent;
      border-color: #e7e7e7;
    }
    </style>
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">NITT Results (Batch 2012-16)</a>
            </div>
            <!-- /.navbar-header -->
            <div class="nav navbar-right">
              Results are scrapped from nitt.edu, there may be some errors...<br>
              <a href="javascript:call()"id="issue">Click here</a> to notify such errors
                  <!-- <a href="#" class="btn btn-primary" id="issues">Any issues? </a> -->
            </div>
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse collapse">
                    <ul class="nav" id="side-menu">
                        <?php
                            include 'sidebar.php';
                        ?>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <center>
                <div id="loader">
                <br><br><br>
                <img src="../imgs/ajax-loader.gif">
                </div>
            </center>
            <div id="container">
                <div class="row">
                    <center>
                    <h1 class="page-header">NITT Results (Batch 2012-16)</h1>
                    <h3>With a difference</h3>
                    <h3>Try selecting sem, dept and view from the side pane</h3>
                    <h5>In mobiles, click on right corner to open side pane</h5>
                    </center>
                </div>
                <br><br><br>
                <br><br><br>
                <br><br><br>
                
            </div>
            <br><br><br>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <footer class="footer">
        <br>
        <center><p>Made with &hearts; by Delta Force</p></center>
    </footer>
    <!-- jQuery -->
    <script src="../theme/js/jquery-1.11.0.js"></script>
    <script src="../theme/js/bootstrap.min.js"></script>
    <script src="../theme/js/morris.js"></script>
    <script src="../theme/js/raphael-2.1.0.min.js"></script>
    <script src="../theme/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="../theme/js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script>

        $("input[name='dept'],input[name='sem'],input[name='view']").change(function (e){
            if($(this).is("input[name='dept']"))
            dept = $(this).val();
            if($(this).is("input[name='sem']"))
            sem = $(this).val();
            if($(this).is("input[name='view']"))
            url = $(this).val();
            console.log(dept);
            $.ajax(
            {
                url: url,
                type: "GET",
                data: {dept:dept, sem:sem},
                success:function(data, textStatus, jqXHR)
                {
                $('#container').html(data);
                },
                error: function(jqXHR, textStatus, errorThrown)
                {

                }

            });
        });
        function call(e){
            $.ajax(
            {
            url: 'issues.php',
            type: "GET",

            success:function(data, textStatus, jqXHR)
            {
            $('#page-wrapper').html(data);
            },
            error: function(jqXHR, textStatus, errorThrown)
            {

            }

            });
        }
        $('#loader').hide();
        $(document).ajaxStart(function(){
            $('#container').empty();
            $('#loader').show();
        });

        $(document).ajaxComplete(function(){
            $('#loader').hide();
        });


    </script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-71718424-1', 'auto');
  ga('send', 'pageview');

</script>
</body>

</html>
