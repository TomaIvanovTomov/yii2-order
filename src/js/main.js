//Change switch ( enable | default ) of model
function changeSwitch(id, elem, controller, action) {
    id = id || null;
    elem = $(elem);
    if(action === "index"){
        $.ajax({
            method: 'POST',
            url: location.href.split('/orders')[0]+"/orders/"+controller+"/change-switch",
            data: {
                id: id,
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
            elem.siblings('.hidden-status').eq(0).val(1);
        }else{
            elem.siblings('.hidden-status').eq(0).val(2);
        }
    }
}