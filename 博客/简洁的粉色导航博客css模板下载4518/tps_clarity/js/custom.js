$(function() {    
    $('.gallery img:first').css('margin-left', '0');   
    
    /* input focus */
    $('input[type="text"]').focus(function() {  
        if (this.value == this.defaultValue){ this.value = ''; }  
    });
    
});

