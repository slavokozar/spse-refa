$( document ).ready(function() {
    $('#page-loader-wrapper').addClass('hidden');


    $('#create-ticket').click(function(e){
        e.preventDefault();
        $('#create').slideDown('slow')
    });

    $('#create-close').click(function(e){
        e.preventDefault();
        $('#create').slideUp('slow')

    });

    $('[data-toggle="modal"]').click(function(e){
        e.preventDefault();
        e.stopPropagation();
        $('#modal .modal-content').load($(this).attr('href'),function(){
            $('#modal').modal('show');

            if($('#modal').find('select').length > 0){
                $('#modal').find('select').select2({
                    data : users
                });

                $
            }

        })
    });
});

$.ajaxSetup({headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}});

$(document).ajaxStart(function () {
    $('#page-loader-wrapper').removeClass('hidden');
});

$(document).ajaxStop(function () {
    $('#page-loader-wrapper').addClass('hidden');
});