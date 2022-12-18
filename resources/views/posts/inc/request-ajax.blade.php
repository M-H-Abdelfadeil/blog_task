
function sendRequest(url ,  method , data){
   $('button[type="submit"]').attr('disabled',true)
    $('.invalid-feedback').html(null)
    $('input , textarea').removeClass('is-invalid')



    $.ajax({
        url: url,
        method: method,
        data,
        cache: false,
        contentType: false,
        processData: false,
        success: function(res) {

            $('.modal-msg').html(res.message)
            $('.modal-post-title').html("Title : " + res.post.title)
            $('.modal-post-content').html("Content : " + res.post.content)
            $('.modal-post-image').attr('src',res.post.image)
            $('#postModal').modal('show');
            $('button[type="submit"]').attr('disabled',false)
            if(res.update){
                $('#title-post-page').html(res.post.title)
            }else{
                $('input[type="text"] , input[type="file"] , textarea').val(null)
            }

        },
        error: function(error, status, type_error) {

            console.log("test")
            var message =error.responseJSON.message
            var errors = error.responseJSON.errors
            $.each(errors, function(key, val) {
                $(`#${key}`).addClass('is-invalid');
                $(`.msg-${key}`).html(val[0])
            })
            $('button[type="submit"]').attr('disabled',false)
        }
    })
}
