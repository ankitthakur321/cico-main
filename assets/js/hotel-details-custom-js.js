 $('#timepicker1').timepicker({
    uiLibrary: 'bootstrap4',
});

$('#timepicker2').timepicker({
    uiLibrary: 'bootstrap4'
});

$("#timepicker1").on('change', function(){
    var time1 = $(this).val().split(":");
    var time2;
    var stType = $("#bookingStayType").val();
    if(stType === "6 Hours Stay")
    {
        time2 = parseInt(time1[0])+6;
    }
    else if(stType === "3 Hours Stay") {
        time2 = parseInt(time1[0])+3;
    }
    
    var time;
    if(time2 > 23)
    {
        time3 = Math.abs(24-time2);
        time =  time3 + ":" + time1[1];
    }
    else{
        time =  time2 + ":" + time1[1];
    }
   $('#timepicker2').val(time);
});
var date3 = $("#datepicker2").flatpickr({
    minDate: new Date(),
    dateFormat: "d-m-Y",
    disableMobile: "true",
    onChange: function(selectedDates, dateStr, instance) {
    date4.set('minDate', dateStr);
    $("#datepicker3").val(dateStr);
    }
});
var date4 = $("#datepicker3").flatpickr({
    minDate: new Date(),
    dateFormat: "d-m-Y",
    disableMobile: "true",
    onChange: function(selectedDates, dateStr, instance) {
    date3.set('maxDate', dateStr);
    }
});

$(document).ready(function () {
    if ($(window).width() > 991) {
        $(".product_img_scroll, .pro_sticky_info").stick_in_parent();
    }
    
    $('#bookingRooms').val($('#bookedRooms').val());
    
    
});


$('#guestAdd').click(function(){
    var gsts = parseInt($('#bookedGuests').val());
    if(gsts >=10)
    {
        return false;
    }
    else{
        $('#bookedGuests').val((gsts + 1));
        rooms_change();
        $('#bookingGuests').val($('#bookedGuests').val());
        $('#bookingRooms').val($('#bookedRooms').val());
        var rm = parseInt($('#bookingRooms').val());
        var price = parseInt($('#bookingPriceInitial').val());
        $('#bookingPrice').val(price * rm);
        $('#rPrice').html("₹ " + price * rm);
        $('#rPrice1').html("<del>₹ " + Math.ceil(res.roomPrice*1.2) + "</del>");
    }
});

$('#guestRemove').click(function(){
    var gsts = parseInt($('#bookedGuests').val());
    if(gsts <= 1)
    {
        return false;
    }
    else{
        $('#bookedGuests').val((gsts - 1));
        rooms_change();
        $('#bookingGuests').val($('#bookedGuests').val());
        $('#bookingRooms').val($('#bookedRooms').val());
         var rm = parseInt($('#bookingRooms').val());
        var price = parseInt($('#bookingPriceInitial').val());
        $('#bookingPrice').val(price * rm);
        $('#rPrice').html("₹ " + price * rm);
        $('#rPrice1').html("<del>₹ " + Math.ceil(res.roomPrice*1.2) + "</del>");
    }
});

$('#roomAdd').click(function(){
    var room = parseInt($('#bookedRooms').val());
    if(room == parseInt($('#bookedGuests').val()))
    {
        return false;
    }
    else{
        $('#bookedRooms').val((room + 1));
        $('#bookingRooms').val($('#bookedRooms').val());
        var rm = parseInt($('#bookingRooms').val());
        var price = parseInt($('#bookingPriceInitial').val());
        $('#bookingPrice').val(price * rm);
        $('#rPrice').html("₹ " + price * rm);
        $('#rPrice1').html("<del>₹ " + Math.ceil(res.roomPrice*1.2) + "</del>");
        
    }
});

$('#roomRemove').click(function(){
    var prs = parseInt($('#bookedGuests').val());
    var rm=0;
    if (prs % 2 === 0) {
        rm = Math.floor(prs / 2);
    } else {
        rm = Math.floor(prs / 2) + Math.floor(prs % 2);
    }
    
    var room = parseInt($('#bookedRooms').val());
    if(room == rm)
    {
        return false;
    }
    else{
        $('#bookedRooms').val((room - 1));
        $('#bookingRooms').val($('#bookedRooms').val());
        rm = parseInt($('#bookingRooms').val());
        var price = parseInt($('#bookingPriceInitial').val());
        $('#bookingPrice').val(price * rm);
        $('#rPrice').html("₹ " + price * rm);
        $('#rPrice1').html("<del>₹ " + Math.ceil(res.roomPrice*1.2) + "</del>");
    }
});

$('#applyBtn').click(function(){
    $('#totalGuests').val( $('#bookedRooms').val()+" Room, "+$('#bookedGuests').val()+" Guest");
    $('.selector-box').prop("style", "display:none");
});

$('#totalGuests').click(function(){
    $('.selector-box').prop("style", "display:block");
});

function rooms_change() {
    var prs = parseInt($('#bookedGuests').val());
    var rm=0;
    if (prs % 2 === 0) {
        rm = Math.floor(prs / 2);
        $('#bookedRooms').val(Math.floor(prs / 2));
    } else {
        rm = Math.floor(prs / 2) + Math.floor(prs % 2);
        $('#bookedRooms').val(( Math.floor(prs / 2) + Math.floor(prs % 2)));
    }
}

var url = window.location.origin;
$("#bookingStayType").change(function(){
var st = $("#bookingStayType").val();
    if( st === "3 Hours Stay")
    {
        date4.set("minDate", $("#datepicker2").val());
        date4.set("maxDate", $("#datepicker2").val());
        $("#datepicker3").val($("#datepicker2").val());
        $('#timeDiv').prop("style","display:block");
        $('#timepicker1').prop("required",true);
        $('#timepicker2').prop("required",true);
        var today = new Date();
        var time4 = today.getHours() + ":" + today.getMinutes();
        $('#timepicker1').val(time4);
        time5 = parseInt(today.getHours())+3;
        if(time5 > 23)
        {
            var time6 = Math.abs(24-time5);
            time7 =  time6 + ":" + today.getMinutes();
        }
        else{
            time7 =  time5 + ":" + today.getMinutes();
        }
        $('#timepicker2').val(time7);
        
        var rId = $('#bookingRoomType').val();
        if(rId!=''){
            $.ajax({
            type: "POST",
            url: url+"/hotels/getRoomPrice",
            dataType: 'json',
            data: {rmId: rId},
            success: function(res) {
                if(res.threeHrsPrice!='')
                {
                    $('#roomsType').html(res.roomTitle + " Rate");
                    $('#rPrice').html("₹ " + res.threeHrsPrice);
                    $('#rPrice1').html("<del>₹ " + Math.ceil(res.threeHrsPrice*1.2) + "</del>");
                    $('#bookingPriceInitial').val(res.threeHrsPrice);
                    $('#bookingPrice').val(res.threeHrsPrice * $('#bookingRooms').val());
                    
                }
            }
          });
        }
    }
    else if(st === "6 Hours Stay")
    {
        date4.set("minDate", $("#datepicker2").val());
        date4.set("maxDate", $("#datepicker2").val());
        $("#datepicker3").val($("#datepicker2").val());
        $('#timeDiv').prop("style","display:block");
        $('#timepicker1').prop("required",true);
        $('#timepicker2').prop("required",true);
        var today = new Date();
        var time4 = today.getHours() + ":" + today.getMinutes();
        $('#timepicker1').val(time4);
        time5 = parseInt(today.getHours())+6;
        if(time5 > 23)
        {
            var time6 = Math.abs(24-time5);
            time7 =  time6 + ":" + today.getMinutes();
        }
        else{
            time7 =  time5 + ":" + today.getMinutes();
        }
        $('#timepicker2').val(time7);
        
        var rId = $('#bookingRoomType').val();
        if(rId!=''){
            $.ajax({
            type: "POST",
            url: url+"/hotels/getRoomPrice",
            dataType: 'json',
            data: {rmId: rId},
            success: function(res) {
                if(res.sixHrsPrice!='')
                {
                    $('#roomsType').html(res.roomTitle + " Rate");
                    $('#rPrice').html("₹ " + res.sixHrsPrice);
                    $('#rPrice1').html("<del>₹ " + Math.ceil(res.sixHrsPrice*1.2) + "</del>");
                    $('#bookingPriceInitial').val(res.sixHrsPrice);
                    $('#bookingPrice').val(res.sixHrsPrice * $('#bookingRooms').val());
                    
                }
            }
          });
        }
    }
    else{
        date4.set("minDate", $("#datepicker2").val());
        date4.set("maxDate", new Date("3000-01-01"));
        var today = $('#datepicker2').val().split("-");
        var date =  parseInt(today[0])+1;
        var tomorrow = date + "-" + today[1] + "-" + today[2];
        $("#datepicker3").val(tomorrow);
        $('#timeDiv').prop("style","display:none");
        $('#timepicker1').prop("required",false);
        $('#timepicker2').prop("required",false);
        var rId = $('#bookingRoomType').val();
        if(rId!=''){
            $.ajax({
            type: "POST",
            url: url+"/hotels/getRoomPrice",
            dataType: 'json',
            data: {rmId: rId},
            success: function(res) {
                if(res.roomPrice!='')
                {
                    $('#roomsType').html(res.roomTitle + " Rate");
                    $('#rPrice').html("₹ " + res.roomPrice);
                    $('#rPrice1').html("<del>₹ " + Math.ceil(res.roomPrice*1.2) + "</del>");
                    $('#bookingPriceInitial').val(res.roomPrice);
                    $('#bookingPrice').val(res.roomPrice * $('#bookingRooms').val());
                }
            }
          });
        }
    }
});

let date11 = document.getElementById('datepicker2');
let date12 = document.getElementById('datepicker3');
date12.addEventListener('change',function(){
    if(date12.value !==null || price!=="NaN"){
        var dateString = date11.value;
        var dateString2 = date12.value;
    
        var dateParts = dateString.split("-");
        var dateParts2 = dateString2.split("-");
        
        // month is 0-based, that's why we need dataParts[1] - 1
        var dateObject = new Date(+dateParts[2], dateParts[1] - 1, +dateParts[0]); 
        var dateObject2 = new Date(+dateParts2[2], dateParts2[1] - 1, +dateParts2[0]); 
        const diffTime1 = Math.abs(dateObject2 - dateObject);
        const diffDays1 = Math.ceil(diffTime1 / (1000 * 60 * 60 * 24));
        var diffDays2 = diffDays1==0?1:diffDays1;
        // console.log(diffDays2);
        var rm = document.getElementById('bookingRooms').value * diffDays2;
        var price = document.getElementById('bookingPriceInitial').value;
        document.getElementById('bookingPrice').value = price * rm;
        document.getElementById('rPrice').innerHTML = "₹ " + price * rm;
        document.getElementById('rPrice1').innerHTML = "<del>₹ " + Math.ceil(price * rm*1.2)+"</del>";
    }
});

date11.addEventListener('change',function(){
    var dateString = date11.value;
    var dateString2 = date12.value;

    var dateParts = dateString.split("-");
    var dateParts2 = dateString2.split("-");
    
    // month is 0-based, that's why we need dataParts[1] - 1
    var dateObject = new Date(+dateParts[2], dateParts[1] - 1, +dateParts[0]); 
    var dateObject2 = new Date(+dateParts2[2], dateParts2[1] - 1, +dateParts2[0]); 
    const diffTime1 = Math.abs(dateObject2 - dateObject);
    const diffDays1 = Math.ceil(diffTime1 / (1000 * 60 * 60 * 24));
    var diffDays2 = diffDays1==0?1:diffDays1;
    // console.log(diffDays2);
    var rm = document.getElementById('bookingRooms').value * diffDays2;
    var price = document.getElementById('bookingPriceInitial').value;
    if(price!=="NaN"){
    document.getElementById('bookingPrice').value = price * rm;
    document.getElementById('rPrice').innerHTML = "₹ " + price * rm;
    document.getElementById('rPrice1').innerHTML = "<del>₹ " + Math.ceil(price * rm*1.2)+"</del>";
    }
});

let roomType2 = document.getElementById("bookingRoomType");
    roomType2.addEventListener('change',function(){
        
        var rId = $(this).val();
        if(rId!=''){
            $.ajax({
            type: "POST",
            url: url+"/hotels/getRoomPrice",
            dataType: 'json',
            data: {rmId: rId},
            success: function(res) {
                if(res.roomPrice!='')
                {
                    $('#roomsType').html(res.roomTitle + " Rate");
                    $('#rPrice').html("₹ " + res.roomPrice);
                    document.getElementById('rPrice1').innerHTML = "<del>₹ " + Math.ceil(price * rm*1.2)+"</del>";
                    $('#bookingPriceInitial').val(res.roomPrice);
                    
                }
            }
          });
        }
    });