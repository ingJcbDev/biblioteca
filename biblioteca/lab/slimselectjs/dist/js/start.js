/**
 * Description modo pandemia trabajando desde la house #covd-19
 * Creado jonier cabrera bermudez
 * dusoft medical
 * 02/06/2020
 * @author jonier.cabrera
 */

$(document).ready(function () {

//    new SlimSelect({
//        select: '#single'
//    })
//
//    new SlimSelect({
//        select: '#multiple'
//    })


});

var selectMultiple;

start = function(){
    
    selectMultiple = new SlimSelect({
      select: '#multiple'
      ,closeOnSelect: false
    })
    
    var displayData = [
        {value: 'A', text: 'A_'},
        {value: 'B', text: 'B_'},
        {value: 'C', text: 'C_'},
        {value: 'D', text: 'D_'},
        {value: 'E', text: 'E_'},
        {value: 'F', text: 'F_'},
        {value: 'G', text: 'G_'},
        {value: 'F', text: 'F_'}
    ];

    selectMultiple.setData(displayData)
    selectMultiple.set(['A', 'C'])    
    
}

destroy_ = function(){
    selectMultiple.destroy() 
}
