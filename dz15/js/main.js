$(document).ready(function(){
  $("a.del").on("click",function(){
    var tr=$(this).closest('tr');
    var id=tr.children('td:last').html();
    
    
    
    
    console.log(id);
  })
})