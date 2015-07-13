$(document).ready(function(){
    
    function showResponse(response){
        if (response.action == 'insert') {
            $('#all_ads>tbody').append(response.tr);
        }else if (response.action == 'update') {
            $('#all_ads td#'+response.id).closest('tr').replaceWith(response.tr);
        };
        if(response.status=='success'){
                    $('#container').removeClass('alert-danger').addClass('alert-warning');
                    $('#container_info').html(response.message);
                    $('#container').fadeIn('slow');
                }else if(response.status=='error'){
                    $('#container').removeClass('alert-warning').addClass('alert-danger');
                    $('#container_info').html(response.message);
                    $('#container').fadeIn('slow');
                };
                console.log(response);
    };
    
  
  $("body").on("click","a.del",function(){
      $('#ads_add')[0].reset();
    var tr=$(this).closest('tr');
    var id=tr.children('td:last').html();
     

        var param= {"del":id};
        $.getJSON('controller.php', 
        param,
        function(response) {
            tr.fadeOut('slow', function(){
                if(response.status=='success'){
                    $('#container').removeClass('alert-danger').addClass('alert-warning');
                    $('#container_info').html(response.message);
                    $('#container').fadeIn('slow');
                }else if(response.status=='error'){
                    $('#container').removeClass('alert-warning').addClass('alert-danger');
                    $('#container_info').html(response.message);
                    $('#container').fadeIn('slow');
                };
                $(this).remove();
            });
        });
  });
  
  $("body").on("click","a.change",function(e){
      e.preventDefault();
      
    var tr=$(this).closest('tr');
    var id=tr.children('td:last').html();
    
      var param= {"change":id};
        $.getJSON('controller.php', 
        param,
        function(ad) {
            $('#ads_add')[0].reset();
            $('#ads_add input:radio[name=whois][value='+ad.whois+']').prop('checked',true);
            $('#ads_add input[name=name]').val(ad.name);
            $('#ads_add input[name=email]').val(ad.email);
            $('#ads_add input:checkbox[name=subscribe][value='+ad.subscribe+']').prop('checked',true);
            $('#ads_add input[name=phone]').val(ad.phone);
            $('#ads_add select[name=city]').val(ad.city);
            $('#ads_add select[name=category]').val(ad.category);
            $('#ads_add input[name=title]').val(ad.title);
            $('#ads_add textarea[name=message]').val(ad.message);
            $('#ads_add input[name=price]').val(ad.price);
            $('#ads_add input[name=id]').val(ad.id);





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
 
    // bind form using 'ads_add' 
    $('#ads_add').ajaxForm(options);
    
    
      
});

