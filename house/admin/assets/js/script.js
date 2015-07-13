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
    //определяем главную фотку и передадим в основную форму
$("#select_main_photo").on("click", "input[type='radio']",function(){ 
   
        $("#main_photo").val($(this).val());

});

        //обрабатываем таблицу и делаем из нее крутую со всякими доп функциями
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


function showResponse(response){
//        if (response.action == 'insert') {
//            $('#all_ads>tbody').append(response.tr);
//        }else if (response.action == 'update') {
//            $('#all_ads td#'+response.id).closest('tr').replaceWith(response.tr);
//        };
        if(response.status=='success'){
                    $('#container').removeClass('alert-danger').addClass('alert-warning');
                    $('#container_info').html(response.message);
                    $('#container').fadeIn('slow');
                }else if(response.status=='error'){
                    $('#container').removeClass('alert-warning').addClass('alert-danger');
                    $('#container_info').html(response.message);
                    $('#container').fadeIn('slow');
                };
                
    };

$("body").on("click","a.delete",function(e){
      e.preventDefault();
    var tr=$(this).closest('tr');
    var id=tr.children('td:first').html();
     

        var param= {"del":id};
        $.getJSON('controller.php', 
        param,
        function(response) {
            tr.fadeOut('slow', function(){
                if(response.status=='success'){
                    $('#message_delete').removeClass('alert-danger').addClass('alert-warning');
                    $('#message_delete_info').html(response.message);
                    $('#message_delete').fadeIn('slow');
                    $(this).remove();
                }else if(response.status=='error'){
                    $('#message_delete').removeClass('alert-warning').addClass('alert-danger');
                    $('#message_delete_info').html(response.message);
                    $('#message_delete').fadeIn('slow');
                };
                
            });
        });
  });
  
    $("body").on("click","a.change",function(e){
      e.preventDefault();
      
    var tr=$(this).closest('tr');
    var id=tr.children('td:first').html();
    
      var param= {"change":id};
        $.getJSON('controller.php', 
        param,
        function(dom) {
            $('#addHouse')[0].reset();
            $('.cc-selector').empty();
            for (i in dom.info){
                $('#addHouse input[name='+i+']').val(dom.info[i]);
            };
            for (i in dom.info){
                $('#addHouse textarea[name=' + i + ']').val(dom.info[i]);
                
            };
            $('#addHouse select[name=category]').val(dom.info.category);
            if (dom.info.default_house == 'true'){
                $('#addHouse input:checkbox[name=default_house]').prop('checked',true);
            };
            $('.cc-selector').append(dom.code);
            $('#file_name').val(dom.info.seo_name);
            $('#select_main_photo input:radio[name='+dom.info.seo_name+ '][value='+ '"' + dom.info.main_photo + '"' +']').prop('checked','checked');
//            $('#addHouse #'+dom.info.main_photo).prop('checked','checked');
            $("#addHouse input[name=seo_name]").prop('readonly', true);
            $("#addHouse input[name=name]").prop('readonly', true);
            
            
        });
      
  });

var options = { 
        target:        '#container_info',   // target element(s) to be updated with server response 
        //beforeSubmit:  showRequest,  // pre-submit callback 
        success:       showResponse,   // post-submit callback 
 
        // other available options: 
        url:       'controller.php?add',         // override for form's 'action' attribute 
        type:      'post',        // 'get' or 'post', override for form's 'method' attribute 
        dataType:  'json',        // 'xml', 'script', or 'json' (expected server response type) 
        clearForm: true,     // clear all form fields after successful submit 
        resetForm: true      // reset the form after successful submit 
 
        // $.ajax options can be used here too, for example: 
        //timeout:   3000 
    }; 
    
  $("#saveHouse").click(function (response) {
       
        
        $('#addHouse').ajaxSubmit(options); 
         
        return false; 
    
  });


});
