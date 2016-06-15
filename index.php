<?php
include("layouts/top_content.php");
?>
<!--content-->
<?php
if($has_db){
    echo '<h4>'."The database : $dbname".'</h4>';
    $tables = mysqli_query($link, "show tables");
} else {
    echo '<h4>'."Please select a database".'</h4>';
}
?>
<h5>Tables</h5>
<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>Name</th>
        <th>Attributes</th>
        <th>Rows</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if($has_db) {
        $tables_num = mysqli_num_rows($tables);
        if ($tables_num == 0) {
            echo '<tr><td colspan="4">' . "no table to show" . '</td></tr>';
        }
        while ($table = mysqli_fetch_row($tables)) {
            $rows = mysqli_query($link, "select * from $table[0]");
            $num_rows = mysqli_num_rows($rows);
            $num_attrs = mysqli_num_rows(mysqli_query($link, "describe $table[0]"));
            $table_url = "table.php?dbname=".$dbname."&table_name=".$table[0];
            $drop_table_url = "drop_table.php?dbname=".$dbname."&table_name=".$table[0];
            echo '<tr>';
            echo '<td><a class ="tb_link" href='.$table_url.'>'.$table[0].'</a></td>';
            echo '<td>' . $num_attrs . '</td>';
            echo '<td>' . $num_rows . '</td>';
            echo '
            <td>
            <a class="btn btn-sm btn-danger"
            href="'.$drop_table_url.'">
                <i class="fa fa-btn fa-trash"></i> drop
            </a>
            </td>';
            echo '</tr>';
        }

        echo '</tbody></table>';

        $create_table_url = "create_table.php?dbname=".$dbname;
        echo '<h4 class="text-info">create table</h4>
            <form role="form" action='.$create_table_url.' method="post">
                <div class="form-group">
                    <label for="name">table name :</label>
                    <input class="form-control" type="text" name="name">
                </div>
                <div class="form-group">
                    <label for="num_cols">column numbers</label>
                    <input class="form-control" type="text" name="num_cols">
                </div>
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-btn fa-share"></i>create
                </button>
            </form>';
    }
    ?>

<!--end content-->
<?php
include("layouts/down_content.php");
?>
