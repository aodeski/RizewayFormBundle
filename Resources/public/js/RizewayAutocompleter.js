var RizewayAutocompleter = function(input, options) {
    
    var _options = $.extend({
        mustMatch: false,
        separator: ',',
        values: []
    }, options);
    
    var _view = new RizewayAutocompleterView(this, _options);
    _view.init(input);
    
}

RizewayAutocompleter.prototype.values = {};
RizewayAutocompleter.prototype.addValue = function(value, label) {
    this.values[value] = label;
};
RizewayAutocompleter.prototype.getValues = function() {
    return this.values
};
RizewayAutocompleter.prototype.removeValue = function(value) {
    if (this.values[value] !== undefined) {
        delete this.values[value];
    }
};

var RizewayAutocompleterView = function(controller, options) {

    var _controller = controller;
    var _list;
    var _result_input;
    var _new_input;
    var _options = options;
    
    var initNewItemInput = function(focus) {
        
        // Delete the current autocomplete
        _list.find('.rizeway_new_item').remove();
        
        // Create The add value input
        _new_input = $('<input type="text" id="rizeway_new_item" />');
        var li_input = $('<li class="rizeway_new_item"></li>');
        li_input.append(_new_input);
        _list.append(li_input);

        // Attach the autocomplete behaviour
        _new_input.autocomplete({
            source: _options.url,
            select: function( event, ui ) {
                addNewItem(ui.item);
            },
            create: function () {
                if (focus !== undefined && focus) {
                    _list.find('.rizeway_new_item .ui-autocomplete-input').focus();
                }
                
                
                _list.find('.rizeway_new_item .ui-autocomplete-input').bind( "keydown", function( event ) {
                
                    // Attach custom elements add
                    if (!_options.mustMatch && (event.keyCode === $.ui.keyCode.TAB || event.keyCode === 188)) {
                        event.preventDefault();
                        var value = $(this).attr('value');
                        addNewItem({id: value, label: value});
                    }
                    
                    // Attach delete last item
                    if (event.keyCode === $.ui.keyCode.BACKSPACE || event.keyCode === $.ui.keyCode.DELETE) {
                        if ($(this).attr('value') == '')
                        {
                            var last_elm = _list.find('li:not(.rizeway_new_item):last');
                            if (last_elm !==undefined) {
                                deleteItem(last_elm);
                            }
                        }
                    }
                });
                
            }
        });
    }
    
    var addNewItem = function(item, ignore_autocomplete) {
        if ($.trim(item.id)) {
            _controller.addValue(item.id, item.label); 
            var elm = $('<li>'+ item.label +'<a class="rizeway_delete_item" href="'+item.id+'">X</a></li>')
            elm.insertBefore(_list.find('.rizeway_new_item'));
            elm.find('.rizeway_delete_item').click(function(e){
                e.preventDefault();
                deleteItem(elm);
            });
            if (ignore_autocomplete === undefined || !ignore_autocomplete) {
                initNewItemInput(true);
            }
            updateHiddenValue();
        }
    }
    
    var deleteItem = function(elm) {
        var value =  elm.find('.rizeway_delete_item').attr('href');
        _controller.removeValue(value);
        elm.remove();
        updateHiddenValue();
    }
    
    var updateHiddenValue = function() {
        var values = new Array();
        for (val in _controller.getValues()) {
            values.push(val); 
        }
        
        _result_input.attr('value', values.join(_options.separator));
    }
    
    return {
        init: function(input) {
            
            // Create The list
            _list = $('<ul class="rizeway_autocomplter_results"></ul>');
            _list.insertBefore(input)
            
            // Create The hidden input
            _result_input = $('<input type="hidden" name="'+$(input).attr('name')+'" />');
            _result_input.insertBefore(input);
            
            // Initialize the autocomplete input
            initNewItemInput();
            
            // Ajouter les valeurs initiales
            for (val in _options.values)
            {
                addNewItem(_options.values[val], true);
            }
            
            // Delete original input
            $(input).remove();
        }
    }
    
}