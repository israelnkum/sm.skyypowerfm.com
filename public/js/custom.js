$(document).ready(function () {
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

    //End Radio Stations





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
    users_table.column(5).visible(false);



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
        $('#edit-u-email').val(data[3]);
        $('#edit-u-phone').val(data[4]);
        $('#edit-u-radio-stations_id').val(data[5]);
        $('#edit-u-role').val(data[7]);





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

});