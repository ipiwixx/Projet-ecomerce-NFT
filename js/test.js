 
/* document.addEventListener("DOMContentLoaded", function(){
    var toastElementList = [].slice.call(document.querySelectorAll(".toast"));
  var toastList = toastElementList.map(function(element){
        return new bootstrap.Toast(element, {
          autohide: false
      });
  });
}); */


document.addEventListener("DOMContentLoaded", function(){
  var btn = document.getElementById("liveToastBtn");
  var element = document.getElementById("liveToast");

  /* Create toast instance */
  var myToast = new bootstrap.Toast(element, {
      delay: 4000
  });

  btn.addEventListener("click", function(){
      myToast.show();
      var element = document.getElementById("myprogressBar");   
      var width = 100;
      var identity = setInterval(scene, 40);
      function scene() {
          width--; 
          element.style.width = width + '%';
      };
    });
  });

      /* document.addEventListener("DOMContentLoaded", function(){
        var btnErr = document.getElementById("liveToastBtnError");
        var elementErr = document.getElementById("liveToastError");
      
        var myToastErr = new bootstrap.Toast(elementErr, {
            delay: 4000
        });
      
        btnErr.addEventListener("click", function(){
        myToastErr.show();
        var elementErr = document.getElementById("myprogressBar");   
        var widthErr = 100;
        var identity = setInterval(scene, 40);
        function scene() {
          widthErr--; 
          elementErr.style.widthErr = widthErr + '%';
      };
  });
}); */

