$(document).ready(function(){

  
/*
   $("#closeModal").click(function(){
     toggleModal($("#modal-container"));
   })

   //ES6 Arrow function 

   $(".check-out").click(()=>{
    toggleModal($("#modal-container"));
   })


   function toggleModal(myModal){
    console.log(myModal)

    if(myModal.hasClass("hide")){

    myModal.removeClass("hide")
     myModal.addClass("show")

    }else{
         myModal.removeClass("show");
     myModal.addClass("hide")  ;
    }
   }
   
   
  */
  $(".check-out").click(function(){

    var nber_id = $(this).attr("id");
    $.post("includes/load_library.php",{
      book_id: nber_id 
      }, function(data,status){
        $("#load").html(data);
      });

    $("#modal-container").css({display:"block"});     

  });


   $("#closeModal").click(function(){
    $("#modal-container").css({display:"none"});
   })

   function account(myAccount){
     if(myAccount.hasClass("hide")){
       myAccount.removeClass("hide");
       myAccount.addClass("show");
     }
     else{
       myAccount.removeClass("show");
       myAccount.addClass("hide");
     }
   }

   $("#my_account_action").click(function(){
     account($("#my-account"));
   });

   $(".account-owned").click(function(){
     $(".owned-books").addClass("show");
     $(".owned-books").removeClass("hide");
     $(".books-history").removeClass("show");
     $(".books-history").addClass("hide");
     $(".account-owned a").css({
       "border-right":"3px groove red","background-color":"#999","padding":"3px","border-radius":"8px"});
     $(".account-library a").css({"border-right":"none", "background-color":"transparent"});
   })

   $(".account-library").click(function(){
    $(".owned-books").removeClass("show");
    $(".owned-books").addClass("hide");
    $(".books-history").removeClass("hide");
    $(".books-history").addClass("show");
    $(".account-library a").css({
      "border-right":"3px groove red","background-color":"#999","padding":"3px","border-radius":"8px"});
    $(".account-owned a").css({"border-right":"none","background-color":"transparent"});
   })




 })
