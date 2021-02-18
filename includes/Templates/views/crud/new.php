<div class="crud-form new-crud">
    <h2>New employee</h2>
    <form action="" method="POST">
        <?php
            foreach ( \crud\Crud::cols as $key => $val ) {
                input( $key );
            }
        ?>
        <div class="input-group">
            <input type="hidden" name="action" value="new_crud">
            <input type="submit" value="Insert" id="new_employee">
        </div>
    </form>
    <script>
           $(`.new-crud form`).on(`submit`, function (e) {
            e.preventDefault();
            let data = new FormData(document.querySelector(`.new-crud form`));

            $.ajax({
                type: "POST",
                url: ajax_url,
                data: data,
                processData: false,
                contentType: false,
                success: function (response) {
                    closeLightbox();
                },
                error: function (res) {
                    alert(`Something went wrong!`);
                },
            });
        });
    </script>
</div>