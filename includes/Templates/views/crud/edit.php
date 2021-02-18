<div class="crud-form edit-crud">
    <h2>Edit employee</h2>
    <form action="" method="POST" data-id="<?php echo $row->id ?>">
        <?php
            foreach ( \crud\Crud::cols as $key => $val ) {
                update_input( $key, $row->$key );
            }
        ?>
        <div class="input-group">
            <input type="hidden" name="action" value="edit_employee">
            <input type="submit" value="Update" id="edit_employee">
        </div>
    </form>
    <script>
           $(`.edit-crud form`).on(`submit`, function (e) {
            e.preventDefault();
            let data = new FormData(document.querySelector(`.edit-crud form`));
            data.append(`id`, $(this).data(`id`));

            $.ajax({
                type: "POST",
                url: ajax_url,
                data: data,
                processData: false,
                contentType: false,
                success: function (response) {
                    employeeList();
                    closeLightbox();
                },
                error: function (res) {
                    alert(`Something went wrong!`);
                },
            });
        });
    </script>
</div>