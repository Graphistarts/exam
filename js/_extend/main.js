$(document).ready(function() {
$('.management button').each(function(){
    $(this).click(function(e){
        e.preventDefault();
    });
});
    $('.management li input').each(function(){
        var previousValue = "";
        var hello ;
        $(this).focus(function(){
            inputSelector = $(this);
            previousValue = inputSelector.val();
        });
        $(this).focusout(function(){
            var newValue = $(this).val();
            $.ajax({
                method: "POST",
                url: "includes/assets/updateMail.php",
                data: { pEmail: previousValue, nEmail: newValue}
            })
                .done(function(data) {
                    if(data == 0)
                    {
                        $('.error').html('Invalid mail');
                        $(inputSelector).val(previousValue);
                    }
                });
        });
    });

    $('.delete').each(function(){
        $(this).on('click',function(){
            var parent = $(this).parent();
           var value = parent.find('input').val();
            $.ajax({
                method: "POST",
                url: "includes/assets/deleteMail.php",
                data: { email: value }
            })
                .done(function() {
                    $(parent).remove();
                });
        });
    });

    $('.addEmail button').on('click',function() {
        var value = $('.addEmail input').val();
        // add mail
        $.ajax({
            method: "POST",
            url: "includes/assets/addMail.php",
            data: { email: value }
        })
            .done(function(data) {
                // NOT VALID EMAIL
                if(data == 0)
                    $('.error').html('Invalid mail');
                else if(data == 1)
                    $('.error').html('Mail already exists');
                else{
                    // GENERATE THE NEW LINE
                    $('.management ul').html(function(){
                        return $(this).html() + data;
                    });
                }
            });
    });


    function isValidEmailAddress(emailAddress) {
        var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
        return pattern.test(emailAddress);
    };

});