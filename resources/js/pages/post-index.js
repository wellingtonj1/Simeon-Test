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

    // Send comment when form is submitted
    $('form.comment-form').on('submit', function(e) {
        e.preventDefault();
        var comment = $(this).closest('.comment-form').find('textarea').val();
        var postId = $(this).closest('.comment-form').find('input[name="post_id"]').val();

        $.ajax({
            type: 'POST',
            url: '/posts/' + postId + '/comments',
            data: {
                comment: comment,
                _token: $(this).closest('.comment-form').find('input[name="_token"]').val()
            },
            success: function(data) {
                // Append new comment to list of comments
                $(this).closest('.card-body').find('.comments').append(data);

                // Clear comment form
                $(this).closest('.comment-form').find('textarea').val('');

                // Hide comment form
                $(this).closest('.comment-form').hide();
            }
        });
    });
});
