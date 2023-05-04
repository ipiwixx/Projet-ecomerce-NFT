$('#tProduit').delegate('.deleteProduit', 'click', function(event) {
    $('#confirm-delete').on('click', ()=> {
        var id = $(event.target).data('id');
        var url = "del/" + id + "/";
        $.ajax({
            "url": url,
    
            "type": "GET",
    
            "success": function() { 
                location.reload(true);
            }  
        });
    });
});

$('#tProduitCateg').delegate('.deleteProduit', 'click', function(event) {
    $('#confirm-delete').on('click', ()=> {
        var id = $(event.target).data('id');
        var url = "../del/" + id + "/";
        $.ajax({
            "url": url,
    
            "type": "GET",
    
            "success": function() { 
                location.reload(true);
            }  
        });
    });
});

$('#tCategorie').delegate('.deleteCategorie', 'click', function(event) {
    $('#confirm-delete').on('click', ()=> {
        var id = $(event.target).data('id');
        var url = "del/" + id + "/";
        $.ajax({
            "url": url,
    
            "type": "GET",
    
            "success": function() { 
                location.reload(true);
            }  
        });
    });
});

$('#tClient').delegate('.deleteClient', 'click', function(event) {
    $('#confirm-delete').on('click', ()=> {
        var id = $(event.target).data('id');
        var url = "del/" + id + "/";
        $.ajax({
            "url": url,
    
            "type": "GET",
    
            "success": function() { 
                location.reload(true);
            }  
        });
    });
});