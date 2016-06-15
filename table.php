<?php
include("layouts/top_content.php");
?>
<!--content-->

<?php
if($has_db){
    echo '<h4>'."The database : $dbname".'</h4>';
    if($has_table)
        echo '<h4>'."The Table : $table_name".'</h4>';
    else
        echo '<h4>'."no table selected".'</h4>';
} else {
    echo '<h4>'."Please select a database".'</h4>';
}
?>
<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
        <?php
        if($has_db && $has_table) {
            $describe_query = mysqli_query($link, "describe $table_name");
            $num_cols = mysqli_num_rows($describe_query);

            while($cols = mysqli_fetch_row($describe_query)){
                echo '<th>'.$cols[0].'</th>';
            }

            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            $select_all_query = mysqli_query($link, "select * from $table_name");
            while($table_row = mysqli_fetch_row($select_all_query)){
                echo '<tr>';
                for($i = 0; $i < $num_cols; $i++){
                    echo '<td>'.$table_row[$i].'</td>';
                }
                echo '</tr>';
            }

            echo '<tr id="insert_row" class="collapse">';
            for($i = 0; $i < $num_cols; $i++){
                $input_names = mysqli_fetch_row($describe_query);
                echo '<td><input type="text" class="form-control"
                      form="insert_form"  name="'.$input_names[$i].'"></td>';
            }
            echo '</tr>';

            echo '<tr id="insert_submit" class="collapse">
                <td colspan="'.$num_cols.'">
                    <button class="btn btn-sm btn-success" id="insert_btn">
                        <i class="fa fa-btn fa-share"></i> insert
                    </button>
                </td>
            </tr>';

            echo '<tr id="insert_btn_row">
            <td colspan="'.$num_cols.'">
                <button class="btn btn-sm btn-default" type="button" data-toggle="collapse"
                data-target="#insert_submit, #insert_row" aria-expanded="false" aria-controls="insert_submit"
                id="insert_btn">
                    <i class="fa fa-btn fa-plus"></i> insert
                </a>
            </td>
        </tr>';


            $insert_url = "insert.php?dbname=".$dbname."&table_name=".$table_name;
        }
        ?>

        </tbody>
    </table>
</div>

<form action=<?php echo $insert_url; ?> method="post" id="insert_form"></form>

<!--end content-->
<?php
include("layouts/down_content.php");
?>
