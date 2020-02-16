$(function() {
    $('.upImage').on('change', function(e) {
        let input = document.querySelector('.upImage');

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
                $('.drop-list').append(`<img src="${e.target.result}" alt="" />`);

                console.log(input.files[i].name, e.target.result);
            }
            reader.readAsDataURL(input.files[i]);
        }
    });

    $("#post").on("click", function() {
        post();
    });

    function post() {
        console.log($(".drop-list").children('img'));
        let previewList = Array.from($(".drop-list img"));
        let fileList = [];

        console.log(previewList); 

        previewList.forEach(x => {
            fileList.push( fileObjects[$(x).data('idx')] );
        });

        let formData = new FormData();

        fileList.forEach(x => {
            formData.append("list[]", x);
        });

        $.ajax({
            url : "/write",
            method : "post",
            data : formData,
            processData: false,
            contentType: false,
            success:(result)=>{
                console.log(result);
            }
        });
    }
});