(function ($) {
    var roomsOptions;
    var sizeOptions;
    
    // Get the ul that holds the collection of tags
    var collectionHolder = $('#storesList');
    
    // setup an "add a tag" link
    var $addTagLink = $('<a href="javascript:;">Add</a>');
    var $newLinkLi = $('<li></li>').append($addTagLink);
    
    jQuery(document).ready(function() {
        // add the "add a tag" anchor and li to the tags ul
        collectionHolder.append($newLinkLi);
        
        // count the current form inputs we have (e.g. 2), use that as the new
        // index when inserting a new item (e.g. 2)
        collectionHolder.data('index', collectionHolder.find(':input').length);
        
        $addTagLink.on('click', function(e) {
            // prevent the link from creating a "#" on the URL
            e.preventDefault();
            if($('#roomsSize option:selected').val()==0){
                alert('Please select room')
                return( false );
            }
            // add a new tag form (see next code block)
            addTagForm(collectionHolder, $newLinkLi);
        });
        
        
        
        $('#roomsName').change(function() {
            $("#roomsSize").val($('#roomsName option:selected').val())
        });
        
        $('#roomsSize').change(function() {
            var $sizeObj={};
            var $roomObj={};
            var $size=$('#roomsSize option:selected').text();
            
            if($('#roomsSize option:selected').val()==0){
                setOptions(roomsOptions,'#roomsName');
                return( false );
            }
            
            $("#roomsSize option").each  ( function() {
                if($(this).text()==$size){
                    $roomObj[$(this).val()]=roomsOptions[$(this).val()];
                }
            });
            setOptions($roomObj,'#roomsName');
        //$("#roomsName").val($('#roomsSize option:selected').val());
        });
        
        roomsOptions=getOptions("#roomsName");
        sizeOptions=getOptions("#roomsSize");
        //alert(Object.keys(roomsOptions).length);
        
        $(".remove_room").live("click", function(){ 
            
            if(confirm('Delete this room')){
                var $tr=$(this).closest('tr');
                $($tr).remove();
                updateFormValues();
            }
        });
    
    });
    
    function addTagForm(collectionHolder, $newLinkLi) {
        var $isExist=false;
        // get selected room
        var selectedRoom = $('#roomsName option:selected');
        var selectedSize = $('#roomsSize option:selected');
        // check if new store is exist
        $("input[name='acme_demobundle_agreementstype[store][]']").each(function(){
            if($(this).val()==selectedRoom.val()){
                $isExist=true;
                return( false );
            }
        });
        if($isExist){
            alert('Cant add exist store');
            return;
        }
        
        var rowCount = $('#selectedtables tr').length;
        var newForm = "<input type=\"hidden\"  value=\""+selectedRoom.val()+"\" name=\"acme_demobundle_agreementstype[store][]\" id=\"acme_demobundle_agreementstype_store_"+rowCount+"\"></li>";
        
        //    $("#roomsSize").val('10');
        $('#selectedtables').append('<tr><td><a href="javascript:;" class="remove_room">Delete</a>'+newForm+'</td><td class="roomSize">'+selectedSize.text()+'</td><td>'+selectedRoom.text()+'</td><td>'+rowCount+'</td></tr>')
        updateFormValues();
    }
    
    
    function getOptions(element) {
        var obj = {};
        $(element+" option").each  ( function() {
            obj[$(this).val()]=$(this).text();
        });
        //    alert(Object.keys(obj).length);
        return obj;
    }
    
    function setOptions(options,select) {
        var mySelect = $(select);
        mySelect.empty();
        $.each(options, function(val, text) {
            //    alert(text);
            mySelect.append(
                $('<option></option>').val(val).html(text)
                );
        });
    }
    //******************** update agreement discound and net value
    function updateFormValues(){
        var rentalPeriodId=$('#acme_demobundle_agreementstype_rentalPeriod').val();
        var discountPolicies=$('#acme_demobundle_agreementstype_discountPolicies').val();
        var depositValue=$('#acme_demobundle_agreementstype_depositValue').val();
        var insuranceValue=$('#acme_demobundle_agreementstype_insuranceValue').val();
        var otherFees=$('#acme_demobundle_agreementstype_otherFees').val();
        var otherDiscount=$('#acme_demobundle_agreementstype_otherDiscount').val();
        var startDate=$('#acme_demobundle_agreementstype_startDate').val();
        var roomSize=0;
        
        //alert($("input[name='acme_demobundle_agreementstype[store][]']").length);
        $("#selectedtables > tbody  > tr > td.roomSize").each(function() {
            var value = $(this).html();
            roomSize= (parseFloat(roomSize)+parseFloat(value));
            $('#acme_demobundle_agreementstype_totalArea').val(roomSize);
        });
        
        if(rentalPeriodId==''){
            resetFormValues();
            return;
        }
        
        if(roomSize>0 && rentalPeriodId !=''){
            formReq(rentalPeriodId,roomSize,discountPolicies,depositValue,insuranceValue,otherFees,otherDiscount,startDate);
        }
    }
    function resetFormValues(){
        $('#acme_demobundle_agreementstype_offerDiscount').val('0');
        $('#acme_demobundle_agreementstype_depositValue').val('0');
        $('#acme_demobundle_agreementstype_insuranceValue').val('0');
        $('#acme_demobundle_agreementstype_otherFees').val('0');
        $('#acme_demobundle_agreementstype_otherDiscount').val('0');
        
        $('#acme_demobundle_agreementstype_rentalValue').val('0');
        $('#acme_demobundle_agreementstype_totalValue').val('0');
        $('#acme_demobundle_agreementstype_netValue').val('0');
    }
    

    function formReq(rentalPeriodId,roomSize,discountPolicies,depositValue,insuranceValue,otherFees,otherDiscount,startDate){
        $.ajax({
            type: "POST",
            async: false,
            url: updateFormUrl, 
            data: {
                rentalPeriodId:rentalPeriodId,
                roomSize:roomSize,
                discountPolicies:discountPolicies,
                depositValue:depositValue,
                insuranceValue:insuranceValue,
                otherFees:otherFees,
                otherDiscount:otherDiscount,
                startDate:startDate
            },
            type: "post",
            //contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function(data) {
                updateForm(data);
            },
            error: function(err) {
//                alert('Error:' + err.responseText + '  Status: ' + err.status);
alert('Unable to fetch total room size');
            }
        });
    }
    
    function updateForm(data){
        if(data.code=='error'){
             alert('mmmm');
             return false;
        }
        $.each(data.fiels, function( key, value ) {
            //alert( key + ": " + value );
            $('#acme_demobundle_agreementstype_'+key).val(value);
        });
       
    }
    //******************** end

    $(".delete_cuotation").click(function(){
        var confirmed=confirm('You Are Sure Want Delete This Item');
        if(!confirmed){
            return false;
        }
        $('#deleteForm').submit() 
    });


    $(document).ready(function() {
        $('#acme_demobundle_agreementstype_rentalPeriod').on('change', function() {
            updateFormValues();
        })

    });
    
    
    // update agreement form if input value changed
        $("#acme_demobundle_agreementstype_depositValue").live("change", function(){ 
            var intRegex = /^\d+$/;
            var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;

            var str = $(this).val();
            if(intRegex.test(str) || floatRegex.test(str)) {
                updateFormValues();
            }else{
                alert('Invalid Value');
            }
        });
        
         // update agreement form if input value changed
        $("#acme_demobundle_agreementstype_insuranceValue").live("change", function(){ 
            var intRegex = /^\d+$/;
            var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;

            var str = $(this).val();
            if(intRegex.test(str) || floatRegex.test(str)) {
                updateFormValues();
            }else{
                alert('Invalid Value');
            }
        });
        
         // update agreement form if input value changed
        $("#acme_demobundle_agreementstype_otherFees").live("change", function(){ 
            var intRegex = /^\d+$/;
            var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;

            var str = $(this).val();
            if(intRegex.test(str) || floatRegex.test(str)) {
                updateFormValues();
            }else{
                alert('Invalid Value');
            }
        });
        // update agreement form if input value changed
        $("#acme_demobundle_agreementstype_otherDiscount").live("change", function(){ 
            var intRegex = /^\d+$/;
            var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;

            var str = $(this).val();
            if(intRegex.test(str) || floatRegex.test(str)) {
                updateFormValues();
            }else{
                alert('Invalid Value');
            }
        });
        // update agreement form if input value changed
        $("#acme_demobundle_agreementstype_startDate").live("change", function(){ 
            var dateRegex = /^\d{4}-\d{2}-\d{2}$/;

            var str = $(this).val();
            if(dateRegex.test(str)) {
                updateFormValues();
            }else{
                alert('Invalid Value');
            }
        });
        
        // update agreement form if input value changed
        $("#acme_demobundle_agreementstype_discountPolicies").live("change", function(){ 
                updateFormValues();
        });

})(jQuery);
