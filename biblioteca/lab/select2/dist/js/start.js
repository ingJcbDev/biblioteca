//xajax.config.defaultMode = 'synchronous';
$(document).ready(function () {
    
    var data1 = "";
    var item1 = "";
    data1 = [];
    for (i = 0; i < 11; i++) {
        item1 = {};
        item1 ["id"] = i;
        item1 ["text"] = i;
        if (i === 5) {
            item1 ["selected"] = true;
        }
        data1.push(item1);
    }    
    
    $('.js-example-basic-single').select2({
        data: data1       
    });
    
    var data1 = "";
    var item1 = "";
    data1 = [];
    for (i = 0; i < 11; i++) {
        item1 = {};
        item1 ["id"] = i;
        item1 ["text"] = i;
        if (i === 5 || i === 8) {
            item1 ["selected"] = true;
        }
        data1.push(item1);
    }    
    
    $('#multipleSelect').select2({
        data: data1       
    });
    
});