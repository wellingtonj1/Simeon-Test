$(function() {
    $('.comment-content').hide(); // Hide all comment forms initially

    // Show comment form when button is clicked
    $('.show-comments').on('click', function() {
        var id = $(this).data('post-id');
        let $body = $(this).closest('.card-body');
        let $commentElm = $body.find('.comment-content[data-post-id="' + id + '"]');

        if ($commentElm.is(':visible')) {
            $commentElm.hide();
            $(this).text('Show comment');
        }
        else {
            $commentElm.show();
            $(this).text('Hide comment');
        }

    });

    // handle click on btn remove
    $('.btn-remove').on('click', function() {
        var id = $(this).data('post-id');
        var url = $(this).data('url');
        $('#deleteForm').attr('action', url);
        $('#deleteModal').modal('show');
        console.log('HERE');
    });

    // Handle click event of delete button
    $('#deleteBtn').on('click', function(event) {
        // Prevent default behavior of delete button
        event.preventDefault();

        // Get the form and submit the delete request using AJAX
        var form = $('#deleteForm');
        var url = form.attr('action');
        var data = form.serialize();
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            success: function(result) {
                location.reload();
            }
        });
    });

    // Handle click event of close modal
    $('button[data-dismiss="modal"]').on('click', function() {
        $(this).closest('div.modal').modal('hide');
    });

});
