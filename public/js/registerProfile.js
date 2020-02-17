$(function() {
    $('.upProfile').on('change', function(e) {
        let input = document.querySelector('.upProfile');

        if( $(this).val() != "" ){
            let ext = $(this).val().split('.').pop().toLowerCase();            
            if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
                alert('gif, png, jpg, jpeg 파일만 업로드 할수 있습니다.');
                return;
            }
        }

        for( let i = 0; i < input.files.length; i++ ) {
            let reader = new FileReader();
            reader.onload = function(e) {
                // $('.result').append(`<div>${input.files[i].name}</div>`);
                // $('.drop-list').append(`<img src="${e.target.result}" alt="" />`);

                console.log(input.files[i].name, e.target.result);
            }
            reader.readAsDataURL(input.files[i]);
        }
    });
});