var lesBtn = document.querySelectorAll(".btnDelFav");
lesBtn.forEach((unBtn) => {
  unBtn.addEventListener("click", function (event) {
    var id = $(event.target).data("id");
    var url = "del" + id + "/";
    $.ajax({
      url: url,

      type: "GET",

      success: function (response) {
        location.reload(true);
      },
    });
  });
});

var lesBtn = document.querySelectorAll(".addPanier");
lesBtn.forEach((unBtn) => {
  unBtn.addEventListener("click", function (event) {
    var id = $(event.target).data("id");
    var url = "addP" + id + "/";
    $.ajax({
      url: url,

      type: "GET",

      success: function () {
        var element = document.getElementById("liveToast");
        var myToast = new bootstrap.Toast(element, {
          delay: 4000,
        });
        myToast.show();
        var element = document.getElementById("myprogressBar");
        var width = 100;
        var identity = setInterval(scene, 40);
        function scene() {
          width--;
          element.style.width = width + "%";
        }

        setTimeout(function () {
          $("#panie").load("/favoris/ #panie");
        }, 50);
      },
    });
  });
});
