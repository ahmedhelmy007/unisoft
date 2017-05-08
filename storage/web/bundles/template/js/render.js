(function() {
    var renderer = {
        renderTemplate: function(templateId, data, elapsedTime, async) {
            if (Notifications && Notifications.instance) {
                Notifications.instance.dismissAll();
            }

            if (async) {
                $('#execution_time').text(elapsedTime);
                $('#primary>ul>li').removeClass('active');
                $('#primary-menu-' + data._.layout.activeMainLink).addClass('active');
                
                $('#submenu-container').empty()
                    .append($('#template-menu-item').tmpl(data._.layout.menuItems));

                $('#topmenu-container').empty()
                    .append($('#template-top-menu-item').tmpl(data._.layout.topMenuItems));
            }

            $('#main-container').empty()
                .append($("#" + templateId).tmpl(data))
                .find('tscript').each(function (index, element) {
                    var newScript = $(this).attr("src")? " src=\"" + $(this).attr("src") + "\"" : "";
                    newScript = "<script type=\"text/javascript\"" + newScript + ">" + $(this).text() + "</script>";

                    $(this).replaceWith(newScript);
                }
            );
        },
        
        renderUnAutherized: function(data) {
            $('#template-dlg').tmpl({
                title: data.title,
                message: data.message,
                showOk: false
            }).modal();
        },
        
        renderNewLayout: function(data) {
            window.location.href = data;
        },
        
        renderNotifications: function(notifications) {
          for (var notification in notifications) {
                var notificationData = notifications[notification];
                if (notificationData instanceof Function) {
                    continue;
                }

                Notifications.push({
                    imagePath: notificationData.icon,
                    text: notificationData.text,
                    autoDismiss: notificationData.timeout,
                    "class": notificationData.cssClass
                });
            }
        }
    };
    
    if (!window.unisoft) {
        window.unisoft = {};
    }
    if (!window.unisoft.renderer) {
        window.unisoft.renderer = renderer;
    }
})();

$(function() {
    prettyPrint();
    $('.search-button-trigger').click(function(e) {
        e.preventDefault();
        return false;   
    });
    $.fn.navify({
        enabled: true,
        render: function (url, content) {
            $('.input-error').tooltip();
            $(".chzn-select").chosen();
            $('textarea.tagme').tagify();
            $('#unisoft_assetsbundle_assetstype_purchaseDate').datepicker();
            $('.data-table').dataTable({
                "bJQueryUI": true,
                "sPaginationType": "full_numbers",
                "sDom": '<""l>t<"F"fp>'
            });
        }
    });
    
    $('body').on('beforeNavigation', function (event, params) {
        $('#icon-loading').show();
        //params.cancel = false;
    });
    $('body').on('afterNavigation', function (event, params) {
        $('#icon-loading').hide();
    });

});