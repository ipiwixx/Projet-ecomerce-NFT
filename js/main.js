function Alert($){

    $('.addPanier').click(function(event){
        event.preventDefault();
        $.get($(this).attr('href'),{},(data) => {
            console.log(data);
            },'json');
        return false;
    });

};

window.onload = Alert($);