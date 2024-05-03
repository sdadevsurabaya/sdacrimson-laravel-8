$("#floatingSelectShipper").select2({
   width: 'resolve' // need to override the changed default
});

$("#floatingSelectCountry").select2({
   width: 'resolve' // need to override the changed default
});

$("#floatingSelectProvince").select2({
   width: 'resolve' // need to override the changed default
});

$("#floatingSelectCity").select2({
   width: 'resolve' // need to override the changed default
});



// open collapse id receipients
$('#btnRecipientsID').on("click", function () {
   $('#recipientsName').toggle();
   $('#recipientsSave').toggle();
})