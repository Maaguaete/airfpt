
<?php $__env->startSection('title', 'Book A Ticket'); ?>
<?php $__env->startSection('content'); ?>
<div class="container bg-transparent" style="padding-top: 110px;">

    <!-- Start breadcrumb -->

    <nav class="booking_head_nav_breadcrumb">
        <a href="#" onclick="linkTabBackward(0);" class="breadcrumb_item booking_step">1<span class="shortNav">. Flights</span></a>
        <a href="#" onclick="linkTabBackward(1);" class="breadcrumb_item booking_step">2<span class="shortNav">. Passengers</span></a>
        <a href="#" onclick="linkTabBackward(2);" class="breadcrumb_item booking_step">3<span class="shortNav">. Add-ons</span></a>
        <a href="#" onclick="linkTabBackward(3);" class="breadcrumb_item booking_step">4<span class="shortNav">. Payment</span></a>
    </nav>
    <!-- End breadcrumb -->
    <form id="booking_form" role="form" action="<?php echo e(Route('airfpt.booking.postBooking')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo e(csrf_field()); ?>

        <div class="w-75 pr-2">
            <!-- One "booking_tab" for each booking_step in the form: -->

            <!-- 1. booking_tab 1: Select Flight -->
            <div class="booking_tab m-0 p-0" id="tab0">
                <?php echo $__env->make('airfpt.booking.tab1_select_flight', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <!-- .End booking_tab 1 -->

            <!-- 2. booking_tab: Input Passenger Details -->
            <div class="booking_tab m-0 p-0">
                <?php echo $__env->make('airfpt.booking.tab2_passenger_details', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

            <!-- 3. booking_tab: Add-ons -->
            <div class="booking_tab m-0 p-0">
                <?php echo $__env->make('airfpt.booking.tab3_add_ons', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <!-- 4. Payment -->
            <div class="booking_tab m-0 p-0 last_tab_payment">
                <?php echo $__env->make('airfpt.booking.tab4_payment', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

            <div class="overflow-hidden mt-2">
                <div class="d-flex justify-content-between">
                    <button onclick="nextPrev(-1)" class="btn btn-secondary font-weight-bolder" type="button" id="booking_prevBtn">
                        <li class="	fas fa-chevron-circle-left"></li> Previous
                    </button>

                    <button onclick="nextPrev(1)" class="btn btn-primary font-weight-bolder" type="button" id="booking_nextBtn">
                        Next <li class="fa fa-chevron-circle-right"></li>
                    </button>
                </div>
            </div>
        </div>
        <!-- Show Booking price Summary -->
        <div id="bookingsummary" class="rounded-top">
            <h4 class="font-weight-bold p-2 m-0 rounded-top text-warning text-center" style="background-color:rgb(23, 74, 146);">Itinerary Summary</h4>
            <?php echo $__env->make('airfpt.booking.summary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </form>
</div>

<script>
    $(document).ready(function() {
        var adl = sessionStorage.getItem("adl");
        var chd = sessionStorage.getItem("chd");
        var inf = sessionStorage.getItem("inf");

        $("#paxs").text((adl > 1 ? (adl + " Adults") : (adl + " Adult")) + (chd > 1 ? (", " + chd + " Children") : (chd == 1 ? (", " + chd + " Child") : "")) + (inf != 0 ? (", " + inf + " Infant" + (inf > 1 ? "s" : "")) : ""));

        for (let i = 1; i <= adl + chd + inf; i++) {
            setMonth(i);
        }
    });

    // MINIMUM AGE TO SET OF INFANT AND CHILDREN
    var inf_min_yr = new Date().getFullYear() - 2;
    var chd_min_yr = new Date().getFullYear() - 12;


    var currentTab = 0;
    showTab(currentTab);

    function linkTabBackward(tab) {
        let i = currentTab - tab;
        while (i-- > 0) {
            nextPrev(-1);
        }
    }
    // This function will figure out which tab to display
    function nextPrev(n) {
        // if (!checkInputRequired(n)) {
        //     $('#booking_nextBtn').prop( "disabled", true );
        //     return false;
        // }else{
        //     $('#booking_nextBtn').prop( "disabled", false );
        // }
        let tabs_arr = $(".booking_tab");
        if (n > 0) {
            if (!checkInputRequired(currentTab)) {
                // function alert

                return false;
            }
        }
        
        $(tabs_arr[currentTab]).css({
            'display': 'none'
        });
        currentTab += n;

        // if you have reached the end of the form...the form gets submitted:
        if (currentTab >= tabs_arr.length) {
            $("#booking_form").submit();
            return false;
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
    }

    function showTab(n) {

        let tabs_arr = $(".booking_tab");

        $(tabs_arr[n]).css({
            'display': 'block'
        });

        // If index 0 => prev Btn display: none, else display: inline.
        n == 0 ? ($('#booking_prevBtn').css('visibility', 'hidden')) : ($('#booking_prevBtn').css('visibility', 'visible'));
        n == (tabs_arr.length - 1) ? ($('#booking_nextBtn').html('Confirmed & Pay Now')) : ($('#booking_nextBtn').html('Next <li class="fa fa-chevron-circle-right"></li>'));

        fixStepIndicator(n);
        if (n == 3) {
            show_payment_tab();
        }
    }

    function checkInputRequired(n) {

        switch (n) {
            case 0:
                if (!$("input:radio[name='txt_ob_flight']").is(':checked')) {
                    alert('Please choose your outbound flight!');
                    return false;
                }
                if ($("input:radio[name='txt_ib_flight']").length) {
                    if (!$("input:radio[name='txt_ib_flight']").is(':checked')) {
                        alert('Please choose your inbound flight!');
                        return false;
                    }
                }
                break;
            case 1:
                if (!valid_details()) {
                    return false;
                }
                break;
            case 2:

                break;
            case 3:

                break;

        }
        return true;
    }

    function valid_details() {
        const specialChars = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;

        for (let i = 1; i <= adl + chd + inf; i++) {
            // Check Last name
            let last_name = $("#last_name" + i).val().trim();
            if (last_name == '') {
                $(".invalid-last_name" + i).html(
                    '<small >Last name required*</small>'
                );
                $("#last_name" + i).focus();
                return false;
            } else {
                $(".invalid-last_name" + i).empty();
            }
            if (specialChars.test(last_name)) {
                $(".invalid-last_name" + i).html(
                    '<small >Special character not allowed*</small>'
                );
                $("#last_name" + i).focus();
                return false;
            } else {
                $(".invalid-last_name" + i).empty();
            }
            // Check First name
            let first_name = $("#first_name" + i).val().trim();
            if (first_name == '') {
                $(".invalid-first_name" + i).html(
                    '<small >First name required*</small>'
                );
                $("#first_name" + i).focus();
                return false;
            } else {
                $(".invalid-first_name" + i).empty();
            }
            if (specialChars.test(last_name)) {
                $(".invalid-first_name" + i).html(
                    '<small >Special character not allowed*</small>'
                );
                $("#first_name" + i).focus();
                return false;
            } else {
                $(".invalid-first_name" + i).empty();
            }

            // Check Phone
            // Check DOB CHD
            if (i > adl) {
                let depart_date = new Date($("#ob_date").html());
                let dob = new Date();
                let y = parseInt($("#year" + i).val());
                // JavaScript counts months from 0 to 11. Month 10 is November
                let m = parseInt($("#month" + i).val());
                let d = parseInt($("#day" + i).val());
                if (isNaN(y) || isNaN(m) || isNaN(d)) {
                    $(".invalid-dob" + i).html('<small >Pls input Children DOB*</small>');
                    $(".invalid-dob" + i).focus();
                    return false;
                }

                dob.setFullYear(y + 12, m - 1, d - 1);
                dob.setHours(0);
                dob.setMinutes(0);
                dob.setSeconds(0);
                if (dob < depart_date) {
                    $(".invalid-dob" + i).html('<small >Children must be less than 12 yrs old on departure date*</small>');
                    $(".invalid-dob" + i).focus();
                    return false;
                } else {
                    $(".invalid-dob" + i).empty();
                }
            }
            // Check DOB INF
            if (i > adl + chd) {
                let depart_date = new Date($("#ob_date").html());
                let dob = new Date();
                let y = parseInt($("#year" + i).val());
                // JavaScript counts months from 0 to 11. Month 10 is November
                let m = parseInt($("#month" + i).val());
                let d = parseInt($("#day" + i).val());
                if (isNaN(y) || isNaN(m) || isNaN(d)) {
                    $(".invalid-dob" + i).html('<small >Pls input infant DOB*</small>');
                    $(".invalid-dob" + i).focus();
                    return false;
                }
                dob.setFullYear(y + 2, m - 1, d - 1);
                dob.setHours(0);
                dob.setMinutes(0);
                dob.setSeconds(0);
                if (dob < depart_date) {
                    $(".invalid-dob" + i).html('<small >Infant must be less than 02 yrs old on departure date*</small>');
                    $(".invalid-dob" + i).focus();
                    return false;
                } else {
                    $(".invalid-dob" + i).empty();
                }
            }

        }

        return true;
    }
    // This function removes the "active" class of all steps...
    function fixStepIndicator(n) {

        let steps_arr = $(".booking_step");
        for (i = 0, j = steps_arr.length; i < steps_arr.length; i++, j--) {
            if (i <= n) {
                $(steps_arr[i]).addClass('activated');
            }
            if (j > n) {
                $(steps_arr[j]).removeClass('activated');
            }

            $(steps_arr[i]).removeClass('text-warning');
        }

        $(steps_arr[n]).addClass('text-warning');
    }

    // DOB
    // 
    // 
    let isLeap = false;
    window.onload = function() {
        $("#booking_form").ready(function() {
            setYear();
        });
    }

    $("select[id*='year']").change(function() {
        let id = $(this).attr('id').replace(/year/g, '');
        checkDay(id);
    });

    $("select[id*='month']").change(function() {
        let id = $(this).attr('id').replace(/month/g, '');
        checkDay(id);
    });
    // Display Month in short-form
    $("select[id*='month']").blur(function() {
        let id = $(this).attr('id').replace(/month/g, '');
        let month = $("#month" + id).val();
        let str = $('option:selected', this).text();
        str = str.substring(0, 3);
        $(this).html('<option value="' + month + '">' + str + '</option>');
    });

    $("select[id*='day']").focus(function() {
        let id = $(this).attr('id').replace(/day/g, '');
        setDay(id);
    });

    function checkDay(id) { // Check the day is valid or not
        let isLeap = false;
        var year = $("#year" + id).val();
        if (year % 4 == 0) {
            if (year % 100 == 0) {
                if (year % 400 == 0)
                    isLeap = true;
                else
                    isLeap = false;
            } else
                isLeap = true;
        } else {
            isLeap = false;
        }

        let month = $("#month" + id).val();
        let day = $("#day" + id).val();
        if (month == 2) {
            if (isLeap) {
                if (day > 29) {
                    setDay(id);
                }
            } else {
                if (day > 28) {
                    setDay(id);
                }
            }
        } else if (month == 4 || month == 6 || month == 9 || month == 11) {
            if (day > 30) {
                setDay(id);
            }
        }


    }

    function setDay(id) { // Set the day to the first day of the month
        let isLeap = false;
        var year = $("#year" + id).val();

        if (year % 4 == 0) {
            if (year % 100 == 0) {
                if (year % 400 == 0)
                    isLeap = true;
                else
                    isLeap = false;
            } else
                isLeap = true;
        } else {
            isLeap = false;
        }

        $("#day" + id).html("");

        let month = $("#month" + id).val();
        let maxDay = 31;

        if (month == 2) {
            if (isLeap) {
                maxDay = 29;
            } else {
                maxDay = 28;
            }
        } else if (month == 4 || month == 6 || month == 9 || month == 11) {
            maxDay = 30;
        }
        $("#day" + id).append("<option value=''>Day</option>");
        for (let i = 1; i <= maxDay; i++)

            if (i < 10) {
                $("#day" + id).append("<option value='" + i + "'>0" + i + "</option>");
            } else {
                $("#day" + id).append("<option value='" + i + "'>" + i + "</option>");
            }
    }

    function setMonth(id) {
        $("#month" + id).html(
            '<option value="">Month</option>' +
            '<option value="1">January</option>' +
            '<option value="2">February</option>' +
            '<option value="3">March</option>' +
            '<option value="4">April</option>' +
            '<option value="5">May</option>' +
            '<option value="6">June</option>' +
            '<option value="7">July</option>' +
            '<option value="8">August</option>' +
            '<option value="9">September</option>' +
            '<option value="10">October</option>' +
            '<option value="11">November</option>' +
            '<option value="12">December</option>'
        );
    }

    function setYear() {

        for (let i = new Date().getFullYear(); i >= 1920; i--) {
            $("select[id*='year']").append("<option value='" + i + "'>" + i + "</option>");
        }
        $("select[id*='year']").filter(".inf_year").html("<option value=''>Year</option>");
        $("select[id*='year']").filter(".chd_year").html("<option value=''>Year</option>");
        for (let i = new Date().getFullYear(); i >= chd_min_yr; i--) {

            $("select[id*='year']").filter(".chd_year").append("<option value='" + i + "'>" + i + "</option>");
        }
        for (let i = new Date().getFullYear(); i >= inf_min_yr; i--) {

            $("select[id*='year']").filter(".inf_year").append("<option value='" + i + "'>" + i + "</option>");
        }
    }



    // function checkLeapYear(id) {

    //     var year = $("#year"+id).val();
    //     if (year % 4 == 0) {
    //         if (year % 100 == 0) {
    //             if (year % 400 == 0)
    //                 isLeap = true;
    //             else
    //                 isLeap = false;
    //         } else
    //             isLeap = true;
    //     } else {
    //         isLeap = false;
    //     }
    // }
    // End DOB


    // 
    // 
    // TRUNG - GROUP 1
    /* SEAT MAP start */
    var seatNOT = document.querySelectorAll('.seat-disabled_trung')
    seatNOT.forEach(item => {
        item.addEventListener("click", () => {
            alert("Cannot select this seat");
        })
    })
    var seatOK = document.querySelectorAll('.seat-available_trung')
    seatOK.forEach(item => {
        item.addEventListener("click", () => {
            item.classList.remove('seat-available_trung')
            item.classList.add('seat-selected_trung')
            var seatno = document.querySelector('.seatInput_trung')
            console.log(item.children[0].innerHTML);
            if (!seatno.value) {
                seatno.value = item.children[0].innerHTML
                seatno.className = "selected_trung"
            } else {
                var seatno2 = document.querySelector('.seatInput_trung')
                seatno2.value = item.innerHTML
            }
        })
    })
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('airfpt.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Myself\xampp\htdocs\airfpt\resources\views/airfpt/booking/booking.blade.php ENDPATH**/ ?>