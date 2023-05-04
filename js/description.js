var unBtn = document.getElementById("addPanier");
unBtn.addEventListener("click", function(event) {
        var id = $(event.target).data('id');
        var url = "addP" + id + "/" ;
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
                    $('#panie').load('/description/' + id + '/ #panie');
                }, 50);
            }
        })
    });


var unBtn = document.getElementById("addFavoris");
unBtn.addEventListener("click", function(event) {
        var id = $(event.target).data('id');
        var url = "addF" + id + "/" ;
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
              }
        })
    });