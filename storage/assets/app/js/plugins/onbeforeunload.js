// Warning
$(window).on('beforeunload', function(){
    return "Any changes will be lost";
});

// Form Submit
$(document).on("submit", "form", function(event){
    // disable unload warning
    $(window).off('beforeunload');
});