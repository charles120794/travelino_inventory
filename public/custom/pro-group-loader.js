

function modal_add_group(event)
{
    $('#modaladdproductgroup').modal('show');
    $('#modalgroupparent').val($(event).data('group'));
}

function selected_group(event)
{
    var groupTX = $(event).text();

    var groupID = $(event).data('group');
    var groupPR = $(event).data('parent');

    $(event).closest('td').nextAll('td').remove();

    $('#replace_' + groupPR).closest('li').nextAll('li').remove();

    if($('#replace_' + groupPR).length > 0) {

        $('#replace_' + groupPR).html(groupTX);
    } else {

        $('#product_group_breadcrumb').append($('<li></li>').attr('class','breadcrumb-item').attr('id','replace_' + groupPR).html(groupTX));
    }

    $('#selected_group').val(groupID);

}

function search_product_ajax(event)
{
    if($(event).hasClass('group-data')) {
        
        var groupTX = $(event).text();
        var groupPR = $(event).data('parent');

        if(!$(event).parent().hasClass('active')) {

            $(event).closest('td').nextAll('td').remove();
            
            $('#replace_' + groupPR).closest('li').nextAll('li').remove();

            if($('#replace_' + groupPR).length > 0) {

                $('#replace_' + groupPR).html(groupTX);
            } else {

                $('#product_group_breadcrumb').append($('<li></li>').attr('class','breadcrumb-item').attr('id','replace_' + groupPR).html(groupTX));
            }

            $('#selected_group').val("");

            search_product(event);
        }
    }
}

function search_product(event)
{
    var groupID = $(event).data('group');
    var groupPR = $(event).data('parent');
    var routeJS = $('#search_product_route').val();

    $.ajax({
        url : routeJS,
        type : 'get',
        data : { group_id: groupID, group_parent: groupPR },
        dataType: 'html',
        success : function(data){
            $(event).closest('td').after(data);
        },
    });
}

$(function(){

    $('.group-data').on('click', function(){
        search_product_ajax(this);
    });

    $('.selected-group').on('click', function(){
        selected_group(this);
    });

    $('.modal-add-group').on('click',function(){
        modal_add_group(this);
    });

    $('.btn-move-up').on('click', function(event){

        event.preventDefault();

        var row = $(this).parents("tr:first");

        console.log(row)

        if ($(this).is(".btn-move-down")) {
            row.insertAfter(row.next());
        } else {
            row.insertBefore(row.prev());
        }

        $('.tr-order-level').each(function(key, value){
            $('#order_level' + $(this).data('group')).val(key);
        });

    });

    $('.btn-move-down').on('click', function(event){

        event.preventDefault();

        var row = $(this).parents("tr:first");

        if ($(this).is(".btn-move-up")) {
            row.insertBefore(row.prev());
        } else {
            row.insertAfter(row.next());
        }

        $('.tr-order-level').each(function(key, value){
            $('#order_level' + $(this).data('group')).val(key);
        });

    });

    $('.btn-move-left').on('click', function(event){

        event.preventDefault();

        var groupid = $(this).closest('tr');
        var uniqid  = $(this).data('uniqid');
        var level   = $('#level_id' + uniqid).val();

        /* Less Padding */
        var padding = $('#td-level-padding' + uniqid).css('padding-left').replace(/\D/g,'');
        var lessPadding = (Number(padding) - 50);

        var groupPrev = $('#td-level-padding' + uniqid).closest('tr').prev().data('group');

        var groupNext = $('#td-level-padding' + uniqid).closest('tr').next().data('group');

        if(padding >= 0) {

            $('#td-level-padding' + uniqid).css('padding-left', lessPadding + 'px');

            if($('#level_id' + uniqid).val() > 1) {
                
                $('#level_id' + uniqid).val($('#level_id' + uniqid).val() - 1);
            } 

            if(lessPadding < 50) {
                $('#type_id' + uniqid).val(0);
                $('#parent_id' + uniqid).val(0);
                $('#level_id' + uniqid).val(1);
            }

        }

    });

    $('.btn-move-right').on('click', function(event){

        event.preventDefault();

        var uniqid  = $(this).data('uniqid');

        var level   = $('#level_id' + uniqid).val();

        var padding = $('#td-level-padding' + uniqid).css('padding-left').replace(/\D/g,'');

        var groupPrev = $('#td-level-padding' + uniqid).closest('tr').prev().data('group');

        var addPadding = (Number(padding) + 50);

        if(padding >= 0) {

            if(groupPrev != undefined) {

                if( $('#level_id' + uniqid).val() < 2) {

                    addPaddingLeft(uniqid)

                    if(addPadding >= 50) {

                        /* Make  Type to 0 */
                        $('#type_id' + uniqid).val(0);
                        /* Add level Count  */
                        $('#level_id' + uniqid).val(Number(level) + 1);
                        /* Update Childs Parent */
                        $('#parent_id' + uniqid).val(groupPrev);

                        $('#parent_id' + uniqid).val(findParent(uniqid));

                        $('#type_id' + findParent(uniqid)).val(1);

                        if(findChild(uniqid) > 0) {
                            $('#type_id' + uniqid).val(1);
                        }
                        
                    }

                }

            } else {

                $('#level_id' + uniqid).val(1);

                $('#parent_id' + uniqid).val(0);

            }

        }

    });

});