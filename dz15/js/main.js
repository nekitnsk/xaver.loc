$(document).ready(function(){
  $("a.del").on("click",function(){
    var tr=$(this).closest('tr');
    var id=tr.children('td:last').html();
     
     $.get('index.php?del='+id, 
        
        function(response) {
            console.log(response);
            tr.fadeOut('slow',function(){
                $(this).remove();
            });
        });
     
    
    
    
    
  });
});