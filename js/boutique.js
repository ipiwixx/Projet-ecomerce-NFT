var lesBtn = document.querySelectorAll(".addPanier");
lesBtn.forEach(unBtn => {
    unBtn.addEventListener("click", function(event) {
        var id = $(event.target).data('id');
        var url = "add" + id + "/" ;
        $.ajax({
            "url": url,

            "type": "GET",

            "success": function(){
                var element = document.getElementById("liveToast");
                var myToast = new bootstrap.Toast(element, {
                    delay: 4000
                });
                myToast.show();
                var element = document.getElementById("myprogressBar");   
                var width = 100;
                var identity = setInterval(scene, 40);
                function scene() {
                    width--; 
                    element.style.width = width + '%';
                };

                setTimeout(function(){
                    $('#panie').load('/boutique/ #panie');
                }, 50);

              }
        })
    })
});

var lesBtns = document.querySelectorAll(".fav");
lesBtns.forEach(unBtn => {
    unBtn.addEventListener("click", function(event) {
        var id = $(event.target).data('id');
        var url = "addF" + id + "/";
        $.ajax({
            "url": url,

            "type": "GET",

            "success": function(){
                location.reload(true);
            }
            
        })
    })
});

var lesBtns = document.querySelectorAll(".delfav");
lesBtns.forEach(unBtn => {
    unBtn.addEventListener("click", function(event) {
        var id = $(event.target).data('id');
        var url = "delF" + id + "/";
        $.ajax({
            "url": url,

            "type": "GET",

            "success": function(){
                location.reload(true);
            }

        })
    })
});
  