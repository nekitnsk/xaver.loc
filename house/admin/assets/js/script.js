$(function(){

    var ul = $('#upload ul');

    $('#drop a').click(function(){
        // Simulate a click on the file input button
        // to show the file browser dialog
        $(this).parent().find('input').click();
    });

    // Initialize the jQuery File Upload plugin
    $('#upload').fileupload({
      
        // This element will accept file drag/drop uploading
        dropZone: $('#drop'),

        // This function is called when a file is added to the queue;
        // either via the browse button, or via drag/drop:
        add: function (e, data) {

            var tpl = $('<li class="working"><input type="text" value="0" data-width="48" data-height="48"'+
                ' data-fgColor="#0788a5" data-readOnly="1" data-bgColor="#3e4043" /><p></p><span></span></li>');

            // Append the file name and file size
            tpl.find('p').text(data.files[0].name)
                         .append('<i>' + formatFileSize(data.files[0].size) + '</i>');

            // Add the HTML to the UL element
            data.context = tpl.appendTo(ul);

            // Initialize the knob plugin
            tpl.find('input').knob();

            // Listen for clicks on the cancel icon
            tpl.find('span').click(function(){

                if(tpl.hasClass('working')){
                    jqXHR.abort();
                }

                tpl.fadeOut(function(){
                    tpl.remove();
                });

            });

            // Automatically upload the file once it is added to the queue
            var jqXHR = data.submit();
        },

        progress: function(e, data){

            // Calculate the completion percentage of the upload
            var progress = parseInt(data.loaded / data.total * 100, 10);

            // Update the hidden input field and trigger a change
            // so that the jQuery knob plugin knows to update the dial
            data.context.find('input').val(progress).change();

            if(progress == 100){
                data.context.removeClass('working');
                

            }
        },

        fail:function(e, data){
            // Something has gone wrong!
            data.context.addClass('error');
        }

        ,
        done: function (e, data) {
            var result = JSON.parse(data.result);
            $('.cc-selector').append(result.file_data);
                    }



    });


    // Prevent the default action when a file is dropped on the window
    $(document).on('drop dragover', function (e) {
        e.preventDefault();
    });

    // Helper function that formats the file sizes
    function formatFileSize(bytes) {
        if (typeof bytes !== 'number') {
            return '';
        }

        if (bytes >= 1000000000) {
            return (bytes / 1000000000).toFixed(2) + ' GB';
        }

        if (bytes >= 1000000) {
            return (bytes / 1000000).toFixed(2) + ' MB';
        }

        return (bytes / 1000).toFixed(2) + ' KB';
    }

});



$(document).ready(function(){
$("#select_main_photo").on("click", "input[type='radio']",function(){ 
   
        $("#main_photo").val($(this).val());

});
$('#table_house').dataTable({
	"language": {
	"aria": {
	  "sortAscending": "Кликните для сортировки по этому столбцу",
          "sortDescending": "Кликните для сортировки по этому столбцу",
		   },
        "paginate": {
            "first": "Первая",
            "last": "Последняя",
            "next": "след. ",
            "previous": " пред.",
	},
        
        "sEmptyTable": "Нет данных",
        "sInfo": "Показано с _START_ по _END_ из _TOTAL_ записей",
        "sInfoEmpty": "Показано с 0 по 0 из 0 записей",
        "sLengthMenu": "Показать _MENU_ записей",
        "sLoadingRecords": "Загрузка...",
        "sProcessing": "Подождите...",
        "sSearch": "Поиск:",
        "sSearchPlaceholder": "Профилированный брус",
        "sZeroRecords": "Не найдено ни одной записи",
               }
           }
            );

//$("#saveHouse").click(function(){ saveHouse('addHouse', 'add_house.php'); return false; });

//$("#saveHouse").click(function (response) {
//
//                jQuery.ajax({
//                    url:     'add_House.php', //Адрес подгружаемой страницы
//                    type:     "POST", //Тип запроса
//                    dataType: "html", //Тип данных
//                    data: jQuery("#addHouse").serialize(), 
//                    success: function(response) { //Если все нормально
//
//                    $('#container_info').html(response.message);
//                    $('#container').removeClass('alert-danger').addClass('alert-warning');
//                    
//                    $('#container').fadeIn('slow');
//
//
//                    $('#saveHouse').reset();
//                },
//                error: function(response) { //Если ошибка
//                console.log(response);
//                }
//             });
//
//
//        });

$("#saveHouse").click(function (response) {
        $.getJSON('add_house.php', 
        
        function(response) {
            if(response.status=='success'){
              $('#container').removeClass('alert-danger').addClass('alert-warning');
              $('#container_info').html(response.message);
              $('#container').fadeIn('slow');
                }else if (response.status == 'error'){
              $('#container').removeClass('alert-warning').addClass('alert-danger');
              $('#container_info').html(response.message);
              $('#container').fadeIn('slow');      
                }
            }
            );
        });




});
