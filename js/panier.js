var lesBtn = document.querySelectorAll(".btn-close");
lesBtn.forEach((unBtn) => {
  unBtn.addEventListener("click", function (event) {
    var id = $(event.target).data("id");
    var url = "del" + id + "/";
    $.ajax({
      url: url,

      type: "GET",

      success: function (response) {},
    });
  });
});

function addPanier(event) {
  var id = $(event.target).data("id");
  var qte = $(event.target).val();
  var url = "qte" + qte + "/id" + id + "/";
  $.ajax({
    url: url,

    type: "GET",

    success: function (response) {
      //$('#prix').load('#prix');
      //alert();
    },
  });
}

var lesInput = document.querySelectorAll(".qtePanier");
lesInput.forEach((unInput) => {
  unInput.addEventListener("click", function (event) {
    addPanier(event);
    setTimeout(function () {
      $("#prix").load("/panier/ #prix");
    }, 50);

    setTimeout(function () {
      $("#panie").load("/boutique/ #panie");
    }, 50);
  });
});

var lesInput = document.querySelectorAll(".qtePanier");
lesInput.forEach((unInput) => {
  unInput.addEventListener("keyup", function (event) {
    addPanier(event);
    setInterval(function () {
      location.reload(true);
    }, 2000);

    setTimeout(function () {
      $("#panie").load("/boutique/ #panie");
    }, 50);
  });
});

var lesBtns = document.querySelectorAll(".fav");
lesBtns.forEach((unBtn) => {
  unBtn.addEventListener("click", function (event) {
    var id = $(event.target).data("id");
    var url = "addF" + id + "/";
    $.ajax({
      url: url,

      type: "GET",

      success: function () {
        location.reload(true);
      },
    });
  });
});
