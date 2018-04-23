//Change switch ( enable | disable ) of model
function changeMode(id, elem, controller, action) {
    id = id || null;
    elem = $(elem);
    if(action === "index"){
        $.ajax({
            method: 'POST',
            url: location.href.split('/orders')[0]+"/orders/"+controller+"/changeSwitch",
            data: {
                id: id
            },
            success: function ( data ) {
                return false;
            },
            error: function ( e ) {
                console.log(e);
            }
        });
    }else{
        if(elem.is(':checked')){
            $('#hidden-status').val(1);
        }else{
            $('#hidden-status').val(2);
        }
    }
}