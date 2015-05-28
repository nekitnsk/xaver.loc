$(document).ready(function(){
  $("a.del").on("click",function(){
    var tr=$(this).closest('tr');
    var id=tr.children('td:last').html();
     

        var param= {"del":id};
        $.getJSON('controller.php', 
        param,
        function(response) {
            tr.fadeOut('slow', function(){
                if(response.status=='success'){
                    $('#container').removeClass('alert-info').addClass('alert-warning');
                    $('#container_info').html(response.message);
                    $('#container').fadeIn('slow');
                }else if(response.status=='error'){
                    $('#container').removeClass('alert-info').addClass('alert-danger');
                    $('#container_info').html(response.message);
                    $('#container').fadeIn('slow');
                }
                $(this).remove();
            });
        });
     
    
    
    
    
  });
});