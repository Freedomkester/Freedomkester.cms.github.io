    <!DOCTYPE html>
    <html lang="en">

    <!-- linking php header-markup -->
    <?php include "includes/header.php"; ?>

    <body>

    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>
    <?php include "includes/sidebar.php"; ?>
    <!-- Page Content -->
    <div class="container">

    <div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-8">
    <!-- 
    <h1 class="page-header">
    Page Heading
    Heading
    <small>
    Secondary Text

    </small>
    </h1> -->

    <!-- First Blog Post -->


    <?php
    //Displaying dynamic data from our cms database
    //displaying data from the posts table;

    //our query
    $query = "SELECT * FROM posts where post_status = 'published'";

    //querying the database;
    $querying_db = mysqli_query($db_connect,$query);

    // using a loop to continously assign rows in our posts 
    //table to variables so as to display values dynamically 
    //in our webpage;
    $id=0;
    while($row = mysqli_fetch_assoc($querying_db))
    {
    //assigning rows from posts table to variables;
    $post_id = $row['post_id'];
    $post_title = $row['post_title'];
    $post_author = $row['post_author'];
    $post_date = $row['post_date'];
    $post_content = substr($row['post_content'],0,50);
    $post_image = $row['post_image'];
    //closing php so as to put html btw the loop
    ?>
    <h2>
    <a href="post.php?p_id=<?php echo "{$post_id}" ?>"><?php echo "{$post_title}"; ?></a>
    </h2>
    <p class="lead">
    by <a href="post.php?p_id=<?php echo "{$post_id}" ?>"  ><?php echo "{$post_author}" ;?></a>
    </p>
    <p><span class="glyphicon glyphicon-time"></span> <?php echo "{$post_date}"; ?> </p>
    <a href="post.php?p_id=<?php echo "{$post_id}" ?>">
    <img class="img-responsive" src="<?php echo "{$post_image}"; ?>" alt="">
    </a>
    <?php

    ?>
    <p style="margin-top:3rem; margin-bottom:2rem;"><?php echo "{$post_content}"; ?></p>
    <form action="" method="post">
    <a class="btn btn-primary more" name="more"  style="width:120px; margin-bottom: 6rem;" href="post.php?p_id=<?php echo "{$post_id}" ?>">Read More</a> 
    </form>
    <?php
    //opening php tags to add the enclosing brace for the loop;
    } 
    ?>
    </div>

    <!-- Blog Sidebar Widgets Column -->


    </div>
    <!-- /.row -->


    <!-- Footer -->
    <?php include "includes/footer.php"; ?>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    </body>

    </html>
