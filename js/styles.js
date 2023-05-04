    

      const toastTrigger = document.getElementById('liveToastBtn')
      const toastLiveExample = document.getElementById('liveToast')
      if (toastTrigger) {
      toastTrigger.addEventListener('click', () => {
      const toast = new bootstrap.Toast(toastLiveExample)

      toast.show()
  })
}

 
document.addEventListener("DOMContentLoaded", function(){
  var toastElementList = [].slice.call(document.querySelectorAll(".toast"));
var toastList = toastElementList.map(function(element){
      return new bootstrap.Toast(element, {
        autohide: false
    });
});
});


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








 