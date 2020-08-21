/**
 * Description modo pandemia trabajando desde la house #covd-19
 * Creado jonier cabrera bermudez
 * dusoft medical
 * 02/06/2020
 * @author jonier.cabrera
 */

//xajax.config.defaultMode = 'synchronous';
$(document).ready(function () {

    start();

});

start = function () {
//    $('#my-select').multiSelect({
//        selectableHeader: "<div class='rounded-lg'>Usuarios Seleccionables</div>",
//        selectionHeader: "<div class='rounded-lg'>Usuarios Seleccionados</div>",
//        selectableFooter: "<div class='rounded-lg'>Usuarios Seleccionables</div>",
//        selectionFooter: "<div class='rounded-lg'>Usuarios Seleccionados</div>"
//    });
    
$('.searchable').multiSelect({
  selectableHeader: "<input type='text' class='search-input' autocomplete='off' placeholder='try \"12\"'>",
  selectionHeader: "<input type='text' class='search-input' autocomplete='off' placeholder='try \"4\"'>",
  afterInit: function(ms){
    var that = this,
        $selectableSearch = that.$selectableUl.prev(),
        $selectionSearch = that.$selectionUl.prev(),
        selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
        selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

    that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
    .on('keydown', function(e){
      if (e.which === 40){
        that.$selectableUl.focus();
        return false;
      }
    });

    that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
    .on('keydown', function(e){
      if (e.which == 40){
        that.$selectionUl.focus();
        return false;
      }
    });
  },
  afterSelect: function(){
    this.qs1.cache();
    this.qs2.cache();
  },
  afterDeselect: function(){
    this.qs1.cache();
    this.qs2.cache();
  }
});

new SlimSelect({
  select: '#single'
})

new SlimSelect({
  select: '#multiple'
})

}