jQuery(document).ready(function () {
    function globalAssignEvent() {
        jQuery('.fieldset')
          .on('click', '.editfieldset', function () {
            let $fieldset = $(this).closest('.fieldset');
            $fieldset.find('.contenteditable').toggleClass('active');
            $fieldset.find('.icon.badge').toggleClass('no_display');
        }).on('click', '.savefieldset', function () {
            let $fieldset = $(this).closest('.fieldset');
            //console.log(isValidate($fieldset), $fieldset);
            //return;
            if(!isValidate($fieldset))
                return;
            saveEditableContent($fieldset, function(result){
                if(result.success!=true)
                    return;
                console.log('changed');
                $fieldset.find('.contenteditable').toggleClass('active');
                $fieldset.find('.icon.badge').toggleClass('no_display');
            });
        }).on('click', '.upload-imagefieldset', function () {
            let $fieldset = $(this).closest('.fieldset');
            $fieldset.find('input[type="file"]').trigger('click');
            $fieldset.find('.icon.badge').toggleClass('no_display');
        }).on('click', '.save-imagefieldset', function () {
            let $fieldset = $(this).closest('.fieldset');
            $fieldset.find('.icon.badge').toggleClass('no_display');
            $fieldset.find('form').submit();
        }).on('click', '.cancel-editfieldset', function () {
            let $fieldset = $(this).closest('.fieldset');
            $fieldset.find('.icon.badge').toggleClass('no_display');
            $fieldset.find('.contenteditable').toggleClass('active');
            $fieldset.find('.inputerror').removeClass('inputerror');
            //revertEditableFieldValues($fieldset);
        });
    }

    globalAssignEvent();
    
    var dboptionMethods = {
        params: function () {
            return {
                coverpanel: '.option_panel',
                option: '',
                group: ''
            }
        },
        init: function (options) {},
        destroy: function () {},
        assignEvent: function () {
            var params = this.dboption('params');
            var $me = this.dboption;
            jQuery(params.coverpanel).on('click', '.save_option', function () {
                $me('saveOptionParams', [this]);
            });
            jQuery(params.coverpanel).on('click', '.remove_option', function () {
                var obj = this;
                $me('removeOption', [
                    jQuery(obj).parent().data('key'),
                    function () {
                        jQuery(obj).closest('.an_option').remove();
                    }
                ]);
            });
            jQuery(params.coverpanel).on('click', '.add_new', function () {
                $me('newOption', [this]);
            });
            jQuery(params.coverpanel).find('.add_new_group').bind('click', function () {
                $me('newGroup');
            });
            jQuery(params.coverpanel).on('click', '.save_group', function () {
                $me('saveGroup', [this]);
            });
        },
        saveOptionParams: function (obj) {
            var url = jQuery('.option_panel').data('saveurl');
            var group = jQuery(obj).closest('.a_group').data('key');
            var data = jQuery(obj).parent().find('input').serialize() + '&group=' + group;
            sendData(url, data);
        },
        removeOption: function (key, callback) {
            var url = jQuery('.option_panel').data('removeurl');
            var data = {
                action: 'remove-option',
                key: key
            };
            sendData(url, data, 'POST', callback);
        },
        newGroup: function () {
            var $aRow = jQuery('.option_panel .cover_an_option .a_group').first().clone();
            jQuery('.option_panel .cover_an_option').after($aRow);
        },
        saveGroup: function (obj) {
            var $covergroup = jQuery(obj).closest('.a_group');
            console.log($covergroup);
            var url = jQuery('.option_panel').data('savegroupurl');
            var groupname = $covergroup.find('input[name="group_name"]').val();
            var data = {
                alias: $covergroup.find('input[name="group_alias"]').val(),
                name: groupname
            }
            sendData(url, data, 'POST', function (result) {
                $covergroup.find('input').attr('disabled', 'disabled');
                $covergroup.data('key', groupname);
            });
        },
        newOption: function (obj) {
            var $aRow = jQuery('.option_panel .cover_an_option .an_option').first().clone();
            jQuery(obj).closest('.a_group').append($aRow);
        }
    };

    jQuery.fn.dboption = function (method) {
        if (dboptionMethods[method]) {
            return dboptionMethods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return dboptionMethods.init.apply(this, arguments);
        } else {
            jQuery.error('Method ' + method + ' does not exist on jQuery.dboption');
        }
    };

    jQuery.fn.dboption('assignEvent');
    jQuery('img').on( "error", function(){
        jQuery(this).attr('src', 'images/shim.png');
    })
});

// Upload ajax
ajaxUploadFile = {
    frameName: 'frameUpload',
    frame: function (c) {
        var d = document.createElement('DIV');
        d.innerHTML = '<iframe style="display:none" src="about:blank" id="'+this.frameName+'" name="'+this.frameName+'" onload="ajaxUploadFile.loaded(\''+this.frameName+'\')"></iframe>';
        document.body.appendChild(d);
        var i = document.getElementById(this.frameName);
        if (c && typeof (c.onComplete) == 'function') {
            i.onComplete = c.onComplete;
        }
        return this.frameName;
    },
    form: function (f, name) {
        f.setAttribute('target', name);
    },
    submit: function (f, c) {
        this.form(f, this.frame(c));
        if (c && typeof (c.onStart) == 'function') {
            return c.onStart();
        } else {
            return true;
        }
    },
    loaded: function (id) {
        var i = document.getElementById(id);
        if (i.contentDocument) {
            var d = i.contentDocument;
        } else if (i.contentWindow) {
            var d = i.contentWindow.document;
        } else {
            var d = window.frames[id].document;
        }
        if (d.location.href == "about:blank") {
            return;
        }
        if (typeof (i.onComplete) == 'function') {
            i.onComplete(d.body.innerHTML);
        }
    },
    resetUpload: function(form, callback) {
        var result = jQuery('#'+this.frameName).contents().find('body').text();
        result = JSON.parse(result);
        if(result.success==true) {
            if(typeof callback == 'function')
                callback(form, result);
        } else {
            console.log('Something wrong when upload file in server');  
        }
    }
}

// $(document).ajaxStop(function () {
//     $('#loading').hide();
// });

// $(document).ajaxStart(function () {
//     $('#loading').show();
// });

function showLoading() {
    $('#loading').show();
}
function hideLoading() {
    $('#loading').hide();
}
    
function sendData(url, data, method, callback, error) {
    showLoading();
    method = method || 'POST';
    var token = data._token = jQuery('meta[name="csrf-token"]').attr('content');
    jQuery.ajax({
        url: url,
        method: method,
        data: data,
        dataType: "json",
        headers: {
            "X-CSRF-Token": token
        },
        success: function (result) {
            (callback || jQuery.noop)(result);
            hideLoading();
        },
        error: function (result) {
            (error || jQuery.noop)(result);
            hideLoading();
        }
    });
}

function sendDataWithToken(url, data, method, callback, error) {
    showLoading();
    var key = jQuery('meta[name="api-token"]').attr('content');
    method = method || 'POST';
    jQuery.ajax({
        url: url,
        method: method,
        data: data,
        dataType: "json",
        headers: {
            "Accept": "application/json",
            "Authorization": "Bearer " + key
        },
        success: function (result) {
            (callback || jQuery.noop)(result);
            hideLoading();
        },
        error: function (result) {
           (error || jQuery.noop)(result);
           hideLoading();
        }
    });
}

function getEditableFieldValues($obj){
    let values = [];
    $obj.find('.contenteditable').each(function(){
        let $me = jQuery(this);
        let value = $me.is(':input') ? $me.val() : $me.text();
        values.push({ name : $me.attr('name'), value: value });
    });
    return values;
}

function revertEditableFieldValues($obj){
    $obj.find('.contenteditable').each(function(){
        let $me = jQuery(this);
        let value = $me.data('value');
        $me.is(':input') ? $me.val(value) : $me.text(value);
    });
}

function saveEditableContent($obj, callback) {
    let data = getEditableFieldValues( $obj );
    console.log(data);
    data = jQuery.param(data);
    sendData($obj.attr('action'), data, $obj.attr('method'), function (result) {
        (callback || jQuery.noop)(result);
    }, function () {
        console.log('something wrong');
    });
}

function isValidate($fieldset) {
    let $fields = $fieldset.find('[data-validate]');
    let result = true;
    $fields.each(function(){    
        if(!checkOneField(this)) {
            jQuery(this).addClass('inputerror');
            result = false;
        }
    });
    return (result && ($fieldset.find('.inputerror').length==0));
}

function checkOneField(field) {
    let $needs = jQuery(field).data('validate');
    $needs = $needs.split('|');
    let value = (jQuery(field).is(':input')) ? 
                    jQuery.trim(jQuery(field).val()): 
                    jQuery.trim(jQuery(field).text());
    for(let i=0; i<$needs.length; i++) {
        if(!checkContent(value, $needs[i]))
            return false;
    }
    jQuery(field).removeClass('inputerror');
    return true;
}

function checkContent(value, type) {
    switch(type) {
        case 'require':
            return (value!='');
        break;
        case 'email':
            let re = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
            return re.test(value); 
        break;
        case 'number':
            return jQuery.isNumeric(value);
        break;
    }
}

function saveForm($form, callback) {
    sendData($form.attr('action'), $form.serialize(), $form.attr('method'), function (result) {
        (callback || jQuery.noop)(result);		
    }, function () {
        console.log('something wrong');
    })
}