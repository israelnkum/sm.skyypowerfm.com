$(document).ready(function () {
    /**
     * Filter Adverts
     */
    $('#agency-order').change(function () {
        $.ajax({
            type: 'get',
            url: "filter-adverts",
            data: {
                id: $('#agency-order').val()
            },
            success: function (data) {
                data = $.parseJSON(data);
                console.log(data);
                $('#adverts-order').empty();
                $('#adverts-order').append($('<option>', {
                    value: '',
                    text : ''
                }));
                for(let count =0; count<data.length; count++){
                    $('#adverts-order').append($('<option>', {
                        value: data[count].id,
                        text : data[count].name
                    }));
                }
                /*  let html ='';
                  for(let count =0; count<data.length; count++){

                  }*/
                // $( ".last-visit-body"+i ).html(html);

            },
            error:function (error) {
                console.log(error);
            }
        });
    });


    /**
     * Filter Agency
     */
    $('#select-radio-station').change(function () {
        $('#adverts-order').empty();
        $('#adverts-order').append($('<option>', {
            value: '',
            text : ''
        }));
        $.ajax({
            type: 'get',
            url: "filter-agencies",
            data: {
                id: $('#select-radio-station').val()
            },
            success: function (data) {
                data = $.parseJSON(data);
                console.log(data);
                $('#agency-order').empty();
                $('#agency-order').append($('<option>', {
                    value: '',
                    text : ''
                }));
                for(let count =0; count<data.length; count++){
                    $('#agency-order').append($('<option>', {
                        value: data[count].id,
                        text : data[count].agency_name
                    }));
                }
            },
            error:function (error) {
                console.log(error);
            }
        });
    });



    /**
     * Filter Agency for Advertisement advert.blade.php
     */
    $('#station-advert').change(function () {
        $.ajax({
            type: 'get',
            url: "filter-agencies",
            data: {
                id: $('#station-advert').val(),
            },
            success: function (data) {
                data = $.parseJSON(data);
                console.log(data);
                $('#agencies_id-advert').empty();
                $('#agencies_id-advert').append($('<option>', {
                    value: '',
                    text : ''
                }));
                for(let count =0; count<data.length; count++){
                    $('#agencies_id-advert').append($('<option>', {
                        value: data[count].id,
                        text : data[count].agency_name
                    }));
                }
            },
            error:function (error) {
                console.log(error);
            }
        });
    });


    /*
    Taxes
     */
    let ids =[];
    // document.getElementById("demo").innerHTML = ids;
    let table = $('#taxes-table').DataTable( {
        columnDefs: [ {
            orderable: false,
            className: 'select-checkbox',
            targets:   0
        } ],
        select: {
            style:    'multi',
            selector: 'td:first-child'
        },
        order: [[ 1, 'asc' ]]
    });

    table.column(1).visible(false);

    $('#taxes-table tbody').on( 'click', 'td:first-child', function () {
        // $(this).toggleClass('selected');

        let  $tr = $(this).closest('tr');
        if ($($tr).hasClass('child')){
            $tr = $tr.prev('.parent');
        }
        let data = table.row($tr).data();

        // alert(data[1])

        if (!ids.includes(data[1])){
            ids.push(data[1]);
        }else{
            for( let i = 0; i < ids.length; i++){
                if ( ids[i] === data[1]) {
                    ids.splice(i, 1);
                }
            }
        }
        // document.getElementById("demo").innerHTML = ids;
        if (ids.length >0){
            $('#btn-delete-tax').removeAttr('disabled');
        }  else{
            $('#btn-delete-tax').attr('disabled','disabled');

        }
    } );

    $('#delete-tax-form').on('submit',function (e) {
        e.preventDefault();
        $.ajax({
            type: 'GET',
            url: "delete-tax",
            data: {selected:ids},
            success: function (response){
                console.log(response);
                table.rows( '.selected' ).remove().draw();
                showSuccessToast('Tax Deleted');
                $('#btn-delete-tax').attr('disabled','disabled');
            },
            error:function (error) {
                console.log(error);
            }
        });
    });

    function fetch_data(){
        $.ajax({
            type:"GET",
            url : "taxes",
            dataType : "json",
            success:function (data) {
                // fetch_data();

                /*let html ='';
                let i=1;
                for(let count =0; count<data.length; count++){
                    html +='<tr>';
                    html +='<td>'+ i +'</td>';
                    html +='<td data-id="'+data[count].id+'">'+data[count].name+'</td>';
                    html += '<td data-id="'+data[count].id+'">'+data[count].value+'</td>';
                    html += '<td><button type="button" class="btn btn-danger btn-xs delete" id="'+data[count].id+'">Delete</button></td></tr>';

                    i++;
                }

                $('#taxes-table > tbody').html(html);*/

            }
        })
    }

    table.on('click','.edit-tax',function () {

        let  $tr = $(this).closest('tr');

        if ($($tr).hasClass('child')){
            $tr = $tr.prev('.parent');
        }


        let data = table.row($tr).data();

//     console.log(data);

        $('#edit-tax-name').val(data[3]);
        $('#edit-tax-value').val(data[4]);


        $('#edit-taxes-form').attr('action', 'taxes/'+data[1]);
        $('#exampleModal-4').modal('show');
        $('#taxes-title').text(data[3]);
    });


    /*$('#tax-form').on('submit',function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: "taxes",
            data: $("#tax-form").serialize(),
            success: function (response){
                console.log(response);
               // fetch_data();
                $(window).bind("load", function() {
                    showSuccessToast('Tax Added');
                });

             //  location.reload();

               /!* $('#taxes-table').DataTable().ajax.reload();
                $('#tax-form').trigger("reset");*!/
            },
            error:function (error) {
                console.log(error);
            }
        });
    });*/

    //End Taxes

    /*
    Radio Stations Table
     */
    let radio_stations_ids =[];
    let radio_table = $('#radio-stations-table').DataTable( {
        columnDefs: [ {
            orderable: false,
            className: 'select-checkbox',
            targets:   0
        } ],
        select: {
            style:    'multi',
            selector: 'td:first-child'
        },
        order: [[ 1, 'asc' ]]
    });

    radio_table.column(1).visible(false);
    radio_table.on('click','.edit-radio-station',function () {

        let  $tr = $(this).closest('tr');

        if ($($tr).hasClass('child')){
            $tr = $tr.prev('.parent');
        }


        let data = radio_table.row($tr).data();

//     console.log(data);
        $('#edit-radio-name').val(data[2]);
        $('#edit-radio-address').val(data[3]);
        $('#edit-radio-location').val(data[4]);
        $('#edit-radio-phone_number').val(data[5]);
        $('#edit-radio-fax').val(data[6]);
        $('#edit-radio-prefix').val(data[7]);

        $('#edit-radio-station-form').attr('action', 'radio-stations/'+data[1]);
        $('#edit-radio-station-modal').modal('show');
        $('#radio-title').text(data[2]);
    });

    $('#radio-stations-table tbody').on( 'click', 'td:first-child', function () {
        // $(this).toggleClass('selected');

        let  $tr = $(this).closest('tr');
        if ($($tr).hasClass('child')){
            $tr = $tr.prev('.parent');
        }
        let data = radio_table.row($tr).data();

        // alert(data[1])

        if (!radio_stations_ids.includes(data[1])){
            radio_stations_ids.push(data[1]);
        }else{
            for( let i = 0; i < radio_stations_ids.length; i++){
                if ( radio_stations_ids[i] === data[1]) {
                    radio_stations_ids.splice(i, 1);
                }
            }
        }
        $("#selected_radio_stations").val(radio_stations_ids);

        if (radio_stations_ids.length >0){
            $('#btn-delete-radio').removeAttr('disabled');
        }  else{
            $('#btn-delete-radio').attr('disabled','disabled');

        }
    } );
    /** End Radio Stations*/





        //Users
    let user_ids =[];

    let users_table = $('#users-table').DataTable( {
        columnDefs: [ {
            orderable: false,
            className: 'select-checkbox',
            targets:   0
        } ],
        select: {
            style:    'multi',
            selector: 'td:first-child'
        },
        order: [[ 1, 'asc' ]]
    });

    users_table.column(1).visible(false);
    users_table.column(6).visible(false);



    $('#users-table tbody').on( 'click', 'td:first-child', function () {
        // $(this).toggleClass('selected');

        let  $tr = $(this).closest('tr');
        if ($($tr).hasClass('child')){
            $tr = $tr.prev('.parent');
        }
        let data = users_table.row($tr).data();

        // alert(data[1])

        if (!user_ids.includes(data[1])){
            user_ids.push(data[1]);
        }else{
            for( let i = 0; i < user_ids.length; i++){
                if ( user_ids[i] === data[1]) {
                    user_ids.splice(i, 1);
                }
            }
        }
        $("#user_ids").val(user_ids);

        if (user_ids.length >0){
            $('#btn-delete-users').removeAttr('disabled');
        }  else{
            $('#btn-delete-users').attr('disabled','disabled');

        }
    } );



    //Edit User info
    users_table.on('click','.btn-edit-user',function () {

        let  $tr = $(this).closest('tr');

        if ($($tr).hasClass('child')){
            $tr = $tr.prev('.parent');
        }

        let data = users_table.row($tr).data();

//     console.log(data);
        $('#edit-u-name').val(data[2]);
        $('#edit-u-email').val(data[4]);
        $('#edit-u-phone').val(data[5]);
        $('#edit-u-radio-stations_id').val(data[6]);
        $('#edit-u-role').val(data[8]);





        $('#edit-u-form').attr('action', 'users/'+data[1]);
        $('.edit-user-modal').modal('show');
        $('#edit-user-title').text(data[2]);
    });

    //End Users



    //Agencies
    let agency_ids =[];
    let agencies_table = $('#agency_table').DataTable( {
        columnDefs: [ {
            orderable: false,
            className: 'select-checkbox',
            targets:   0
        } ],
        select: {
            style:    'multi',
            selector: 'td:first-child'
        },
        order: [[ 1, 'asc' ]]
    });
    agencies_table.column(1).visible(false);
    agencies_table.column(8).visible(false);
    agencies_table.on('click','.edit-agency',function () {

        let  $tr = $(this).closest('tr');

        if ($($tr).hasClass('child')){
            $tr = $tr.prev('.parent');
        }

        let data = agencies_table.row($tr).data();

//     console.log(data);
        $('#edit-agency-name').val(data[2]);
        $('#edit-agency-address').val(data[3]);
        $('#edit-agency-fax').val(data[4]);
        $('#edit-agency-email').val(data[5]);
        $('#edit-agency-phone').val(data[6]);
        $('#edit-agency-discount').val(data[7]);
        $('#edit-agency-radio-station').val(data[8]);
        $('#edit-agency-contact-person').val(data[9]);




        $('#edit-agency-form').attr('action', 'agency/'+data[1]);
        $('.edit-agency-modal').modal('show');
        $('#agency-title').text(data[2]);
    });


    $('#agency_table tbody').on( 'click', 'td:first-child', function () {
        // $(this).toggleClass('selected');

        let  $tr = $(this).closest('tr');
        if ($($tr).hasClass('child')){
            $tr = $tr.prev('.parent');
        }
        let data = agencies_table.row($tr).data();

        // alert(data[1])

        if (!agency_ids.includes(data[1])){
            agency_ids.push(data[1]);
        }else{
            for( let i = 0; i < agency_ids.length; i++){
                if ( agency_ids[i] === data[1]) {
                    agency_ids.splice(i, 1);
                }
            }
        }
        $("#selected_agencies").val(agency_ids);

        if (agency_ids.length >0){
            $('#btn-delete-agency').removeAttr('disabled');
        }  else{
            $('#btn-delete-agency').attr('disabled','disabled');

        }
    } );



    /**
     * Adverts Table
     */
    let adverts_table = $('#advert_table').DataTable( {
        order: [[ 1, 'asc' ]]
    });

    adverts_table.column(0).visible(false);
    adverts_table.column(3).visible(false);
    adverts_table.column(6).visible(false);

    adverts_table.on('click','.edit-advert',function () {

        let  $tr = $(this).closest('tr');

        if ($($tr).hasClass('child')){
            $tr = $tr.prev('.parent');
        }

        let data = adverts_table.row($tr).data();

//     console.log(data);
        $('#edit-ad-name').val(data[1]);
        $('#edit-ad-station').val(data[6]).trigger('change');
        $('#edit-ad-agency').val(data[3]).trigger('change');




        $('#edit-advert-form').attr('action', 'adverts/'+data[0]);
        $('.edit-advert-modal').modal('show');
        $('#advert-title').text(data[1]);
    });
    /**
     * Programs Table
     */
    let program_ids =[];
    let program_table = $('#program_table').DataTable( {
        columnDefs: [ {
            orderable: false,
            className: 'select-checkbox',
            targets:   0
        } ],
        select: {
            style:    'multi',
            selector: 'td:first-child'
        },
        order: [[ 1, 'asc' ]]
    });
    program_table.column(1).visible(false);

    $('#program_table tbody').on( 'click', 'td:first-child', function () {
        // $(this).toggleClass('selected');

        let  $tr = $(this).closest('tr');
        if ($($tr).hasClass('child')){
            $tr = $tr.prev('.parent');
        }
        let data = program_table.row($tr).data();

        // alert(data[1])

        if (!program_ids.includes(data[1])){
            program_ids.push(data[1]);
        }else{
            for( let i = 0; i < program_ids.length; i++){
                if ( program_ids[i] === data[1]) {
                    program_ids.splice(i, 1);
                }
            }
        }
        $("#selected_programs").val(program_ids);

        if (program_ids.length >0){
            $('#btn-delete-program').removeAttr('disabled');
        }  else{
            $('#btn-delete-program').attr('disabled','disabled');

        }
    } );
    /**End programs table */


    /**
     * Play Commercial
     */
    for (let i =1; i<=1000; i++){
        $('#play-commercial-form'+i).on('submit',function (e) {
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: "play-commercials",
                data: $("#play-commercial-form"+i).serialize(),
                success: function (response){
                    document.getElementById('play'+i).play();
                    console.log(response);
                    // fetch_data();
                },
                error:function (error) {
                    console.log(error);
                }
            });
        });
    }

    /**
     * End Playing Commercial
     */

    /**
     * Invoice Amount Calculation
     */

    function calculateTotal() {
        let qty = parseFloat($('#qty').val());
        let unit_price = parseFloat($('#unit_price').val());
        let total = qty*unit_price;
        let vatValue=0;
        let taxableAmount =0;
        $("#total_price").val(qty * unit_price);

        //calculate for getfund
        if ($("#getfund").is(":checked")){
            let getfund_value = $("#getfund-value").val();
            let getFund = (getfund_value*total)/100;
            $("#getfund-amount").val(getFund);
            taxableAmount+=getFund;

        } else {
            $("#getfund-amount").val(0);
        }

        //calculate for NHIL
        if ($("#nhil").is(":checked")){
            let nhil_value = $("#nhil-value").val();

            let nhilValue = (nhil_value*total)/100;
            $("#nhil-amount").val(nhilValue);
            taxableAmount+=nhilValue;
        } else {
            $("#nhil-amount").val(0);
        }

        //calculate for VAT
        if ($("#vat").is(":checked")){
            let vat_value = $("#vat-value").val();
            vatValue = vat_value*(taxableAmount+total)/100;
            $("#vat-amount").val(vatValue);
        } else {
            $("#vat-amount").val(0);
        }

        $("#taxable-amt").val(taxableAmount+total);

        $("#total-amt").val(vatValue+total+taxableAmount);
    }

    $('.qty').keyup(calculateTotal);
    $('.unit_price').keyup(calculateTotal);
    $("#getfund").change(function(event){
        calculateTotal();
    });
    $("#nhil").change(function(event){
        calculateTotal();
    });
    $("#vat").change(function(event){
        calculateTotal();
    });





    let ordersTable = $('#orders-table').DataTable( {

    });

    let commercialsTable = $('#commercials_table').DataTable( {

    });
    $('#myInputTextField').keyup(function(){
        ordersTable.search($(this).val()).draw() ;
    })

    let invoice = $('#invoice_table').DataTable( {
        order: [[ 1, 'asc' ]]
    });
});
