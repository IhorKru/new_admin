//correct loading of campaign traffic type form
$('#campaign_input_traffic_type').on('change', function() {
    if (this.value == '') {
        $("#partnername").hide();
        $("#usergeo").hide();
        $("#resourcename").hide();
        $("#templatename").hide();
        $("#numemailspicker").hide();
        $("#timezonepicker").hide();
        $("#datetimepcr").hide();
        $("#paidlink").hide();
        $("#fbuttons").hide();
    } else if (this.value != ''){
        $("#partnername").show();
        $("#usergeo").hide();
        $("#resourcename").hide();
        $("#templatename").hide();
        $("#numemailspicker").hide();
        $("#timezonepicker").hide();
        $("#datetimepcr").hide();
        $("#paidlink").hide();
        $("#fbuttons").hide();
    }
}).trigger("change")
//correct oading of campaign additional fields
$('#campaign_input_partnername').on('change', function() {
    if (this.value == '') {
        $("#usergeo").hide();
        $("#resourcename").hide();
        $("#templatename").hide();
        $("#numemailspicker").hide();
        $("#timezonepicker").hide();
        $("#datetimepcr").hide();
        $("#paidlink").hide();
        $("#fbuttons").hide();
    } else if (this.value == '4'){
        $("#usergeo").show();
        $("#resourcename").hide();
        $("#templatename").hide();
        $("#paidlink").hide();
        $("#numemailspicker").show();
        $("#timezonepicker").show();
        $("#datetimepcr").show();
        $("#fbuttons").show();
    } else if (this.value != '4') {
        $("#partnername").show();
        $("#usergeo").show();
        $("#resourcename").show();
        $("#templatename").show();
        $("#numemailspicker").show();
        $("#timezonepicker").show();
        $("#datetimepcr").show();
        $("#paidlink").show();
        $("#fbuttons").show();
    }
}).trigger("change")
//loading date/time picker
//js for date/time picker
$('.form_datetime').datetimepicker({
    //language:  'uk',
    weekStart: 1,
    todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    forceParse: 0,
    showMeridian: 1
});

$('.form_date').datetimepicker({
    language:  'uk',
    weekStart: 1,
    todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    minView: 2,
    forceParse: 0
});

$('.form_time').datetimepicker({
    language:  'uk',
    weekStart: 1,
    todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 1,
    minView: 0,
    maxView: 1,
    forceParse: 0
});

