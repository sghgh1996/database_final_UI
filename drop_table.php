<?php
include("layouts/top_content.php");
?>
    <!--content-->

<?php
mysqli_query($link, "drop table $table_name");

Print '<script>window.location.assign("index.php?dbname='.$dbname.'");</script>';
?>


    <!--end content-->
<?php
include("layouts/down_content.php");
?>