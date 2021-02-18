var ajax_url = `${site_url}/server.php`;
(function () {
    $(document).ready(function () {
        $(`.new-employee`).on(`click`, function (e) {
            template(`new_employee`);
        });

        $(`.employee-list`).on(`click`, employeeList);

        $(`.load-single`).on(`click`, load_single_row);
    });
})();

function employeeList() {
    let data = new FormData();
    data.append(`action`, `employee_list`);
    $.ajax({
        type: "POST",
        url: ajax_url,
        data: data,
        contentType: false,
        processData: false,
        success: function (response) {
            $(`.content`).html(response);
        },
        error: function (res) {
            alert(`Something went wrong!`);
        },
    });
}

function template(templateName) {
    let data = new FormData();
    data.append(`action`, templateName);
    $.ajax({
        type: "POST",
        url: ajax_url,
        data: data,
        contentType: false,
        processData: false,
        success: function (response) {
            lightbox(response);
        },
        error: function (res) {
            alert(`Something went wrong!`);
        },
    });
}
/**
 * Shows or hides the loading spinner
 *
 * @param {string} cls
 * @param {bool} stop
 */
function load(cls, stop = false) {
    if (!stop) {
        $(cls).addClass(`is-loading`);
    } else {
        $(cls).removeClass(`is-loading`);
    }
}

/**
 * Show contents inside lightbox
 * @param {string} content
 */
function lightbox(content) {
    $(`body`).append(
        `<div class="lightbox"><div class="close-lightbox">X</div>${content}</div>`
    );
    $(`.close-lightbox`).on(`click`, closeLightbox);
}

/**
 * Close the lightbox
 */
function closeLightbox() {
    $(`.lightbox`).remove();
}

/**
 *Deletes a row
 */
function dlt(el) {
    if (!confirm(`Are you sure to delete this item?`)) return;
    let id = el.data(`id`);
    let data = new FormData();
    data.append(`action`, `delete_crud`);
    data.append(`id`, id);
    $.ajax({
        type: "POST",
        url: ajax_url,
        data: data,
        contentType: false,
        processData: false,
        success: function (response) {
            el.css({ backgroundColor: `red` }).hide(500, function (e) {
                el.remove();
            });
        },
        error: function (res) {
            alert(`Something went wrong`);
        },
    });
}

function edt(el) {
    let id = el.data(`id`);

    let data = new FormData();
    data.append(`action`, `update_crud_template`);
    data.append(`id`, id);

    $.ajax({
        type: "POST",
        url: ajax_url,
        data: data,
        contentType: false,
        processData: false,
        success: function (response) {
            lightbox(response);
        },
        error: function (res) {
            alert(`Something went wrong!`);
        },
    });
}

function load_single_row() {
    let data = new FormData();
    let el = $(`.crud-list tr:last-child`);
    let offset = $(`.crud-list tbody tr`).length;

    data.append(`action`, `load_single_row`);
    data.append(`offset`, offset);

    $.ajax({
        type: "POST",
        url: ajax_url,
        data: data,
        contentType: false,
        processData: false,
        success: function (response) {
            if (offset == 0) {
                $(`.content`).html(response);
            } else {
                $(`.crud-list tbody`).append(response);
            }
        },
        error: function (res) {
            alert(`something went wrong!`);
        },
    });
}
