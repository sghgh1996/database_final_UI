<?php
include("layouts/top_content.php");
?>
<!--content-->

<?php
if($has_db){
    echo '<h4>'."Run SQL on the database : $dbname".'</h4>';
    if($has_table){
        echo '<h4>'."Run SQL on the table : $table_name".'</h4>';
        $query_result_url = "query_result.php?dbname=".$dbname."&table_name=".$table_name;
    }else{
        $query_result_url = "query_result.php?dbname=".$dbname;
    }
} else {
    echo '<h4>'."Run the SQL on server localhost(127.0.0.1)".'</h4>';
    $query_result_url = "query_result.php";
}

?>

<form role="form" action=<?php echo $query_result_url; ?> method="post">
    <div class="form-group">
        <label for="query">your query here</label>
        <textarea class="form-control" rows="5" name="query"></textarea>
    </div>
    <button type="submit" class="btn btn-success">
        <i class="fa fa-btn fa-share"></i> run
    </button>
</form>

<!--end content-->
<?php
include("layouts/down_content.php");
?>