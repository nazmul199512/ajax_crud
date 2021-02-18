<div class="crud-list">
    <table>
        <thead>
            <?php
                foreach ( \crud\Crud::cols as $key => $val ) {
                ?>
            <th><?php echo $val['title'] ?></th>
            <?php
                }
            ?>
            <th>Actions</th>
        </thead>
        <tbody>
            <?php
                while ( $row = $r->fetch_object() ) {
                    echo "<tr data-id='{$row->id}'>";
                    foreach ( \crud\Crud::cols as $key => $val ) {
                        echo "<td>{$row->$key}</td>";
                    }
                    echo "<td>
                        <i class='single-crud-edit fas fa-user-edit'></i>
                        <i class='single-crud-delete far fa-trash-alt'></i>
                        </td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
    <script>
    $(`.single-crud-delete`).on(`click`, function(e) {
        dlt($(this).parent().parent());
    });
    $(`.single-crud-edit`).on(`click`, function(e) {
        edt($(this).parent().parent());
    })
    </script>
</div>