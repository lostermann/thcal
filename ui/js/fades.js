$(document).ready(function() {
    $(".container").css("display", "none");
 
    $(".container").fadeIn(600);
 
    $("a").click(function(event){
        event.preventDefault();
        linkLocation = this.href;
        $(".container").fadeOut(600, function() { window.location = linkLocation });      
    });

    $("form").submit(function(event){
        event.preventDefault();
        formvar = this;
        $(".container").fadeOut(600, function() { formvar.submit(); });      
    });


       
});