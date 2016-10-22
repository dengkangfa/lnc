$(document).ready(function(){
   $('#attentionStatus').click(function(){
       var id=$('#b_id').val();
       if($('#attentionStatus').html()==='+关注'){
           var url ="/lnc/Board/attention";
       }else{
           var url ="/lnc/Board/unSubscribe";
       }
       var data = {'b_id':id};
       var success = function (data) {

       }
       $.post(url, data, success);
   });
})