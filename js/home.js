var menuStartPosY = 0;
var menuStartPosX = 0;
//Home page login form
$(document).ready(function(){
    $('.login_button').click(function(){
        $('#login_form').trigger('submit');
    }); 
        
    $("#login_form").validate({
        rules: {
                login_email: {
                    required: true,
                    exicommail: true,
                    email: true
                },
                login_name: {
                    required: true
                }
        },
        messages: {
                login_email: {
                    required: "Please enter email id",
                    exicommail: "Please enter valid email id",
                    email: "Please enter valid email id"
                },
                login_name: {
                    required: "Please enter your name"
                }
        }
    });
    $.validator.addMethod('exicommail', function(value, element) {
        var domain = value.replace(/.*@/, "");
        return this.optional(element) || (domain == 'exicom.in');
    },
    'Please enter valid email id');
});

$(document).ready(function(){
    var msg="";
    var msg2="";
    $('.log_case_battery').click(function(){
        $('#cbms_button').slideUp(700);        
        $('#battery_button').slideDown(700);
        $('.log_case_battery').css('background-color','rgb(192, 192, 192)');
        $('.log_case_cbms').css('background-color','rgb(230, 230, 230)');
    });
    $('.log_case_cbms').click(function(){        
        $('#cbms_button').slideDown(700);
        $('#battery_button').slideUp(700);
        $('.log_case_battery').css('background-color','rgb(230, 230, 230)');
        $('.log_case_cbms').css('background-color','rgb(192, 192, 192)');
    });
    //Battery Case Form
    $('#battery_proceed').click(function(){
            $("#battery_form").trigger("submit");
    });
    $("#battery_form").validate({
        rules: {
                battery_number: {
                    required: true,
                    alphanum: true,
                    minlength: 20,
                    maxlength: 20
                }
        },
        messages: {
                battery_number: {
                    required: "The serial number field is required",
                    alphanum: "Enter valid serial number",
                    minlength: "Enter valid serial number",
                    maxlength: "Enter valid serial number"
                }
        }
    });
    //CBMS case form
    $('#cbms_proceed').click(function(){
        $("#cbms_form").trigger("submit");
    });
    
    $("#cbms_form").validate({
        rules: {
                cbms_number: {
                    required: true,
                    alphanum: true,
                    minlength: 8,
                    maxlength: 8
                }
        },
        messages: {
                cbms_number: {
                    required: "The serial number field is required",
                    alphanum: "Enter valid serial number",
                    minlength: "Enter valid serial number",
                    maxlength: "Enter valid serial number"
                }
        }
    });
    $.validator.addMethod('alphanum', function(value, element) {
        return this.optional(element) || (value.match(/[a-zA-Z]/) && value.match(/[0-9]/));
    },
    'Use at least one numeric and one alphabetic character');
});

$(document).ready(function(){
    var d = new Date();
    var month = d.getMonth()+1;
    var day = d.getDate();
    $('.autodate').val(d.getFullYear() + '-' + (month<10 ? '0' : '') + month + '-' + (day<10 ? '0' : '') + day);
    $('.add_more_issues').click(function(){  
        $('.moreIssues').each(function(i, n){
            if($(this).css('display') == 'none'){  
                $(this).css('display', 'block');
                if(i == 2){
                    $('.add_more_issues').hide();
                }
                return false;
            }
        });    
    });
    
    $('.next').click(function(){
        $('.faultScreen').hide();
        $('.reworkScreen').slideDown();
        $('.form-bat-head').text($('.form-bat-head').data('rework'));
    });
    
    $('.back').click(function(){
       $('.reworkScreen').hide();
       $('.faultScreen').slideDown();
       $('.form-bat-head').text($('.form-bat-head').data('fault'));
     });

    $.validator.setDefaults({ 
        ignore: [],
    });
                
    $.validator.addClassRules({
        voltage_data: {
            required: true,
            voltage: true,
        }
    });
    $.validator.addClassRules({
        temprature_data: {
            required: true,
            temprature: true,
        }
    });
    
    $.validator.addClassRules({
    req_field: {
            required: true
        }
    });
    
    $.validator.addClassRules({
        check_remark: {
            maxlength: 300
        }
    });
    
   $('.voltage_data').on('blur', function(){
        var vl = $(this).val();
        if(vl.match(/\d\.\d$/)){
            $(this).val(vl+"V");
        }
        if(vl.match(/\d\.\dv$/)){
            var n_val = vl.replace('v', 'V');
            $(this).val(n_val);
        }
        validator.element( this );
    });
    $.validator.addMethod('voltage', function(value, element) {
        return this.optional(element) || value.match(/^(?=.*\d)\d{1,2}(\.\d?)?V$/);
    },
    'Voltage format should be XX.X');
    
    $.validator.addMethod('temprature', function(value, element) {
        return this.optional(element) || value.match(/^(?=.*\d)\d{1,2}(\.\d?)?$/);
    },
    'Temprature format should be XX.X');
    
    $('#form_battery_proceed').click(function(){
        if($('#battery_data_form').valid()){
            $('#battery_data_form').trigger('submit');
        } else{
            $("#summary").text('Some fields are missing. Please check both fault and rework screen');
            
            $('html, body').animate({scrollTop: $('#summary').offset().top -100 }, 'slow');
            setTimeout(function(){$("#summary").slideUp('slow');}, 5000);
        } 
    });
    
    var validator = $("#battery_data_form").validate({
        rules: {
                serial_number: {
                    required: true				
                },
                site_name: {
                    required: true				
                }
        },
        messages: {
                serial_number: {
                    required: "Serial number field is required"
                },
                site_name: {
                    required: "Site name required"				
                }
        }
    });
    
    $('#form_cbms_proceed').click(function(){
        if($('#cbms_data_form').valid()){
            $('#cbms_data_form').trigger('submit');
        } else{
            $("#summary").text('Some fields are missing. Please check both fault and rework screen');
            
            $('html, body').animate({scrollTop: $('#summary').offset().top -100 }, 'slow');
            setTimeout(function(){$("#summary").slideUp('slow');}, 5000);
        }
    });
    
    var cbms_validator = $("#cbms_data_form").validate({
        rules: {
                serial_number: {
                    required: true				
                },
                site_name: {
                    required: true				
                }
        },
        messages: {
                serial_number: {
                    required: "The serial number field is required"
                },
                site_name: {
                    required: "Site name required"				
                }
        }
    });
    
    $("#save_form_battery_proceed, #save_rework_battery_proceed").click(function(e){
        $('#save_type').val(1);
        var formData = new FormData($("#battery_data_form")[0]);
        var url = base_url+"home/save_battery_data";
        $('.save_loader').show();  
        setTimeout(function(){
        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            async: true,
            success: function (data) {
                $('.save_loader').hide();
                alert("Battery Data saved");
                window.location = base_url+'cases';
            },
            error: function(data){
                $('.save_loader').hide();
                alert("Something went wrong");
            },
            cache: false,
            contentType: false,
            processData: false
        });
        }, 200);
        e.preventDefault();
    });
    
    $("#save_form_cbms_proceed, #save_rework_cbms_proceed").click(function(e){
        $('#save_type').val(1);
        var formData = new FormData($("#cbms_data_form")[0]);
        var url = base_url+"home/save_cbms_data";
        $('.save_loader').show();
        setTimeout(function(){
        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            async: true,
            success: function (data) {
                $('.save_loader').hide();
                alert("CBMS Data saved");
                window.location = base_url+'cases';
            },
            error: function(data){
                $('.save_loader').hide();
                alert("Something went wrong");
            },
            cache: false,
            contentType: false,
            processData: false
        });
        }, 200);

        e.preventDefault();
    });
});

$(document).ready(function(){
    $('.right_swipe').on("touchstart", function(e){
            menuStartPosY = event.touches[0].pageY;
            menuStartPosX = event.touches[0].pageX;
            
        }).on("touchmove", function(e){
            if(event.touches[0].pageX < (menuStartPosX - 100)){
                $('.faultScreen').hide();
                $('.reworkScreen').slideDown();
                $('.form-bat-head').text($('.form-bat-head').data('rework'));
                $('.contentWrapper').removeClass('right_swipe').addClass('left_swipe');
            }
        });
        $('.left_swipe').live("touchstart", function(e){
            menuStartPosY = event.touches[0].pageY;
            menuStartPosX = event.touches[0].pageX;
            
        }).on("touchmove", function(e){
            if(event.touches[0].pageX > (menuStartPosX + 100)){
                $('.reworkScreen').hide();
                $('.faultScreen').slideDown();
                $('.form-bat-head').text($('.form-bat-head').data('fault'));
                $('.contentWrapper').removeClass('left_swipe').addClass('right_swipe');
            }
        });
        
    $('.right_swipe').on("MSPointerDown", function(e){
        menuStartPosX = e.originalEvent.pageX;
        menuStartPosY = e.originalEvent.pageY;
    }).on("MSPointerMove", function(e){
        if(e.originalEvent.pageX < (menuStartPosX - 100)){
            $('.faultScreen').hide();
            $('.reworkScreen').slideDown();
            $('.form-bat-head').text($('.form-bat-head').data('rework'));
            $('.contentWrapper').removeClass('right_swipe').addClass('left_swipe');
        }
    });
    
    $('.left_swipe').on("MSPointerDown", function(e){
        menuStartPosX = e.originalEvent.pageX;
        menuStartPosY = e.originalEvent.pageY;
    }).on("MSPointerMove", function(e){
        if(e.originalEvent.pageX > (menuStartPosX + 100)){
            $('.reworkScreen').hide();
            $('.faultScreen').slideDown();
            $('.form-bat-head').text($('.form-bat-head').data('fault'));
            $('.contentWrapper').removeClass('left_swipe').addClass('right_swipe');
        }
    });
    
    $("#download_form").validate({
        rules: {
                serial_number: {
                    required: true				
                }
        },
        messages: {
                serial_number: {
                    required: "Serial number field is required"
                }
        }
    });

    $('#download_proceed').click(function(){
        $("#download_form").trigger('submit');
        $('#cbms_battery_download').val('');
    });
     
});

var cities = ["Delhi","Mumbai","Gurgaon","Noida","Bangalore","Pune","Chennai","Hyderabad","Kolkata","Ahmedabad","Chandigarh","Agartala","Agra","Ajmer","Aligarh","Allahabad","Ambaji","Ambala","Amravati","Amritsar","Anand","Angamali","Aurangabad","Ballary","Bareilly","Belgaum","Bellur","Berhampur","Bharuch","Bhatinda","Bhavnagar","Bhopal","Bhubaneswar","Bhuj","Bikaner","Bilaspur","Bokaro","Calicut","Chandragiri","Channarayapatna","Chikkamagalur","Chittoor","Coimbatore","Coonoor","Cuttack","Dalhousie","Darjeeling","Davanageray","Dehradun","Dhanbad","Dharamsala","Dibrugarh","Durgapur","Erode","Gandhidham","Gandhinagar","Gangtok","Goa","Godhra","Gorakhpur","Greater Noida","Guntur","Guwahati","Gwalior","Haridwar","Hoshiarpur","Howrah","Hubli","Indore","Jabalpur","Jaipur","Jalandhar","Jammu","Jamnagar","Jamshedpur","Jhansi","Jodhpur","Jorhat","Junagadh","Kakinada","Kannur","Kanpur","Karnal","Kochi","Kodaikanal","Kolar","Kolhapur","Kota","Kottayam","Kovalam","Kumarakom","Kushalanagar","Lekkadi","Lonavala","Loni","Lucknow","Ludhiana","Maddur","Madurai","Mahabalipuram","Mangalore","Manipal","Mararikkulam","Mathura","Meerut","Mehasana","Mohali","Moradabad","Mount Abu","Munnar","Murthal","Muvattupuzha","Mysore","Nadiad","Nagercoil","Nagpur","Nainital","Nanded Waghala","Nashik","Nellore","Ooty","Palakkad","Panchkula","Panipat","Pathankot","Patiala","Patna","Pondicherry","Raipur","Rajkot","Ranchi","Rishikesh","Roorkee","Rourkela","Saharanpur","Salem","Sangli","Shillong","Shimla","Shirdi","Silchar","Siliguri","Sivakasi","Solan","Solapur","Sonipat","Srinagar","Surat","Suryapet","Thekkady","Thiruvananthapuram","Thrissur","Tiruchirappalli","Tirupati","Tiruppur","Tumkur","Udaipur","Vadodara","Vapi","Varanasi","Vellore","Vijayawada","Visakhapatnam","Vizianagaram","Warangal","Yamuna Nagar","Zirakpur"];
function get_matched_cities(val){
    val = val.toLowerCase();
    var matches = new Array();
    var ex_matches = new Array();
    $.each(cities, function(i, n){
        if(n.toLowerCase().indexOf(val) >= 0){
            if(n.toLowerCase().indexOf(val) == 0) 
                ex_matches.push(n);
            else
                matches.push(n);
        }
    });
    
    return $.merge(ex_matches, matches);
}
function show_matched_cities(city){
    if(city == ''){
        $("#suggestions").hide();
        return;
    }
    var matched_cities = get_matched_cities(city);
    var html = '';                
    $.each(matched_cities, function(i, matched_city){
        if(i > 5)
            return false;
        html +='<span>'+matched_city+'</span>';
    });
    $("#suggestions").html(html);
    $("#suggestions").show();
}

$(document).ready(function(){
   $('#suggest_city').keyup(function(e) {
        var city_val = $(this).val();
        show_matched_cities(city_val);
    }); 
    $('#suggestions span').live('click', function(){
        $('#suggest_city').val($(this).text());
        $("#suggestions").hide();
    });
    $('#suggest_city').on('blur', function(){
        setTimeout(function(){$("#suggestions").hide()}, 100);
    });
    $('#suggest_city').on('focus', function(){
        var city_val = $(this).val();
        show_matched_cities(city_val);
    });
    
    $('.remove_img').click(function(){
        var img = $(this).data('img');
        $('.current_img'+img).attr('src','');
        $('.current_img'+img).hide();
        $('#existing_image'+img).val('');
        $(this).hide();
    });
    
    $('.remove_curr').live('click', function(){
        var img = $(this).data('no');
        $('#list'+img).html('');
        $('.img_upload'+img).val('');
        $('.file'+img).val('');
        $(this).hide();
    });
});

$(document).ready(function(){   
  var file_no;
  $('.img_upload').on('change', function(evt){
      file_no = $(this).data('count');
      $('#list'+file_no).html(''); 
      $('.file'+file_no).val('');
      var files = evt.target.files;

    for (var i = 0, f; f = files[i]; i++) {
      if (!f.type.match('image.*')) {
        continue;
      }

      var reader = new FileReader();
      reader.onload = (function(theFile) {
        return function(e) {
          var span = document.createElement('span');
          span.innerHTML = ['<img class="thumb" src="', e.target.result,
                            '" title="', escape(theFile.name), '"/>'].join('');
          document.getElementById('list'+file_no).insertBefore(span, null);   
          $('#list'+file_no).append('<span class="remove_curr remove_curr_img'+file_no+'" data-no="'+file_no+'">Remove</span>')
          $('.current_img'+file_no).hide();
          $('.remove_img'+file_no).hide();
          $('.file'+file_no).val(escape(theFile.name));
        };
      })(f);
      
      reader.readAsDataURL(f);
    }
  });

});