<?php
include("layouts/top_content.php");
?>
    <!--content-->

<?php
if($has_db){
    if($has_table){
        echo '<h4>'."Query result on the database : $dbname and table : $table_name".'</h4>';
    }else{
        echo '<h4>'."Query result on the database : $dbname".'</h4>';
    }
}else{
    echo '<h4>'."Query result on the server localhost(127.0.0.1)".'</h4>';
}

$query_string = $_POST['query'];
echo '<pre class="text-info" style="font-size: 17px;">'.$query_string.'</pre>';
echo '<br>';
$result = mysqli_query($link, $query_string);
if(!$result){
    echo '<p class="text-danger" style="font-size: 17px;">Invalid query!!  :(</p>';
} else {
    if(gettype($result) == "boolean"){
        echo '<p class="text-success" style="font-size: 17px;">Query successful :)</p>';
    } elseif(gettype($result) == "object"){
        $num_fields = mysqli_num_fields($result);
        $num_rows = mysqli_num_rows($result);
        echo '<div class="table-responsive">';
        echo '<table class="table table-bordered table-hover"><thead><tr>';
        for($i = 0; $i < $num_fields;$i++){
            $field_info = mysqli_fetch_field($result);
            echo '<th>';
            echo $field_info->name;
            echo '</th>';
        }
        echo '</tr>';
        echo '</thead>';

        echo '<tbody>';

        if($num_rows == 0){
            echo '<tr><td colspan="'.$num_fields.'">no record to show</td></tr>';
        } else {
            while($rows_arr = mysqli_fetch_row($result)){
                echo '<tr>';
                for($i = 0; $i < $num_fields; $i++){
                    echo '<td>';
                    echo $rows_arr[$i];
                    echo '</td>';
                }
                echo '</tr>';
            }
        }

        echo '</tbody>';
        echo '</table>';
        echo '</div>';
    }
}

?>



<!--end content-->
<?php
include("layouts/down_content.php");
?>