
        <?php include "includes/admin_header.php"; ?>

        <body>

        <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"; ?>

        <div id="page-wrapper">

        <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
        <div class="col-lg-12">
        <h1 class="jumbotron">
        Welcome to Admin
        <small><?php echo $_SESSION['username'] ?></small>
        </h1>
        </div>
        </div>

        <div class="row">
        <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
        <div class="panel-heading">
        <div class="row">
        <div class="col-xs-3">
        <i class="fa fa-file-text fa-5x"></i>
        </div>
        <div class="col-xs-9 text-right">

        <?php
       $query = "SELECT * FROM posts";
        $select_all_post = mysqli_query($db_connect,$query);
        //using mysqli_num_rows to select number of rows in the result set;
        $all_post = mysqli_num_rows($select_all_post);


        ?>
        <div class='huge'><?php echo "$all_post"; ?></div>
        <div>Posts</div>
        </div>
        </div>
        </div>
        <a href="posts.php?source=view_all_posts">
        <div class="panel-footer">
        <span class="pull-left">View Details</span>
        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
        <div class="clearfix"></div>
        </div>
        </a>
        </div>
        </div>
        <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
        <div class="panel-heading">
        <div class="row">
        <div class="col-xs-3">
        <i class="fa fa-comments fa-5x"></i>
        </div>
        <div class="col-xs-9 text-right">


        <?php
        $query = "SELECT * FROM comments";
        $select_all_comm = mysqli_query($db_connect,$query);
        //using mysqli_num_rows to select number of rows in the result set;
        $comm_count = mysqli_num_rows($select_all_comm);


        ?>

        <div class='huge'><?php echo"$comm_count";?></div>
        <div>Comments</div>
        </div>
        </div>
        </div>
        <a href="comments.php?source=view_all_comments">
        <div class="panel-footer">
        <span class="pull-left">View Details</span>
        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
        <div class="clearfix"></div>
        </div>
        </a>
        </div>
        </div>
        <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
        <div class="panel-heading">
        <div class="row">
        <div class="col-xs-3">
        <i class="fa fa-user fa-5x"></i>
        </div>
        <div class="col-xs-9 text-right">


        <?php
        $query = "SELECT * FROM users";
        $select_all_users = mysqli_query($db_connect,$query);
        //using mysqli_num_rows to select number of rows in the result set;
        $users_count = mysqli_num_rows($select_all_users);


        ?>
        <div class='huge'><?php echo "$users_count";?></div>
        <div> Users</div>
        </div>
        </div>
        </div>
        <a href="users.php?source=view_all_users">
        <div class="panel-footer">
        <span class="pull-left">View Details</span>
        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
        <div class="clearfix"></div>
        </div>
        </a>
        </div>
        </div>
        <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
        <div class="panel-heading">
        <div class="row">
        <div class="col-xs-3">
        <i class="fa fa-list fa-5x"></i>
        </div>
        <div class="col-xs-9 text-right">

        <?php
        $query = "SELECT * FROM categories";
        $select_all_categories = mysqli_query($db_connect,$query);
        //using mysqli_num_rows to select number of rows in the result set;
        $cat_count = mysqli_num_rows($select_all_categories);


        ?>

        <div class='huge'><?php echo "$cat_count";?></div>
        <div>Categories</div>
        </div>
        </div>
        </div>
        <a href="categories.php">
        <div class="panel-footer">
        <span class="pull-left">View Details</span>
        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
        <div class="clearfix"></div>
        </div>
        </a>
        </div>
        </div>


        <?php
        $query = "SELECT * from posts where post_status != 'published'";
        $querying_db = mysqli_query($db_connect,$query);
        $pending_post_count = mysqli_num_rows($querying_db);


            $queryx = "SELECT * FROM users where user_role = 'subscriber'";
            $q_db = mysqli_query($db_connect,$queryx);
            $sub_count=mysqli_num_rows($q_db);

            $queryy = "SELECT * FROM comments where comment_status != 'approved'";
            $q_db2 = mysqli_query($db_connect,$queryy);
            $un_comm = mysqli_num_rows($q_db2);

            $queryy = "SELECT * FROM comments where comment_status = 'approved'";
            $q_db2 = mysqli_query($db_connect,$queryy);
            $ap_comm = mysqli_num_rows($q_db2);


            $queryd = "SELECT * FROM posts where post_status = 'published'";
            $q_dbd = mysqli_query($db_connect,$queryd);
            $post_count = mysqli_num_rows($q_dbd);

            $queryx = "SELECT * FROM users where user_role = 'admin'";
            $q_db = mysqli_query($db_connect,$queryx);
            $admin_count=mysqli_num_rows($q_db);
            ?>
        </div>
        <!-- /.row -->


        <div class="chart">
        <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data','count'],
        //   ['post', 1000],
        ['All posts',<?php echo "$all_post";?>],
        ['Active posts',<?php echo "$post_count"; ?>],
        ['Draft posts',<?php echo "$pending_post_count";?>],
        ['Approved comments',<?php echo "$ap_comm"; ?>],
        ['Pending comments',<?php echo "$un_comm";?>],
        ['Admins',<?php echo"$admin_count";?>],
        ['Subscribers',<?php echo"$sub_count";?>],
        ['Categories',<?php echo "$cat_count";?>],
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>

<div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>

        </div>
        </div>
        <!-- /.container-fluid -->

        <!-- footer -->
        <?php include "includes/admin_footer.php"; ?>