$(document).ready(function () {

    $('#checkAll').change(function () {
        $('.checkItem').prop("checked",$(this).prop("checked"));
        if ($('input[name="selected_id[]"]:checked').length >0){
            $('#deleteSelected').removeAttr('disabled');
        }  else{
            $('#deleteSelected').attr('disabled','disabled');

        }
    });


    $(function () {
        $('.checkItem').click(function () {
            if ($('input[name="selected_id[]"]:checked').length >0){
                $('#deleteSelected').removeAttr('disabled');
            }  else{
                $('#deleteSelected').attr('disabled','disabled');

            }
        });
    });


    $('#btn_submit_bulk_delete').click(function () {
        $('#bulkDeleteForm').submit();
    });






    /*
    Candidate
     */

    $('#checkAllCandidate').change(function () {
        $('.checkCandidateItem').prop("checked",$(this).prop("checked"));
        if ($('input[name="selected_id[]"]:checked').length >0){
            $('#deleteSelected').removeAttr('disabled');
            $('#btn_send_candidate_mail').removeAttr('disabled');
        }  else{
            $('#deleteSelected').attr('disabled','disabled');
            $('#btn_send_candidate_mail').attr('disabled','disabled');

        }
    });


    $(function () {
        $('.checkCandidateItem').click(function () {
            if ($('input[name="selected_id[]"]:checked').length >0){
                $('#deleteSelected').removeAttr('disabled');
                $('#btn_send_candidate_mail').removeAttr('disabled');
            }  else{
                $('#deleteSelected').attr('disabled','disabled');
                $('#btn_send_candidate_mail').attr('disabled','disabled');
            }
        });
    });

    $('#btn_delete_candidate').click(function () {
        $('#delete_candidate_form').submit();
    });




 let candidate_table=   $('#candidate_table').DataTable({
        "aLengthMenu": [
            [5, 10, 15, -1],
            [5, 10, 15, "All"]
        ],
        buttons: [
            // 'copy', 'csv', 'excel', 'pdf', 'print'
            'excel','pdf'
        ],
        "iDisplayLength": 10,
        "language": {
            search: ""
        }
    });

    candidate_table.column(5).visible(false);
    candidate_table.on('click','.edit',function () {

        $tr = $(this).closest('tr');

        if ($($tr).hasClass('child')){
            $tr = $tr.prev('.parent');
        }


        let data = candidate_table.row($tr).data();

//     console.log(data);

        $('#edit-name').val(data[2]);
        $('#edit-email').val(data[3]);
        $('#edit-phone_number').val(data[4]);



        $('#edit-candidate-form').attr('action', 'candidates/'+data[5]);
        $('#edit-candidate-info').modal('show');
        $('#candidate-tittle').text(data[2]);
    });
    /*
    End Candidates
     */



    /*
    Schedules
     */

    $('#checkAllSchedules').change(function () {
        $('.checkScheduleItem').prop("checked",$(this).prop("checked"));
        if ($('input[name="selected_schedule_id[]"]:checked').length >0){
            $('#deleteSelected').removeAttr('disabled');
        }  else{
            $('#deleteSelected').attr('disabled','disabled');

        }
    });


    $(function () {
        $('.checkScheduleItem').click(function () {
            if ($('input[name="selected_schedule_id[]"]:checked').length >0){
                $('#deleteSelected').removeAttr('disabled');
            }  else{
                $('#deleteSelected').attr('disabled','disabled');

            }
        });
    });

    $('#btn_delete_schedule').click(function () {
        $('#delete_schedule_form').submit();
    });

    /*
    End Schedule
     */



    /*
    Emails
     */

    $('#checkAllEmails').change(function () {
        $('.checkEmailItem').prop("checked",$(this).prop("checked"));
        if ($('input[name="selected_email_id[]"]:checked').length >0){
            $('#deleteSelectedEmail').removeAttr('disabled');
        }  else{
            $('#deleteSelectedEmail').attr('disabled','disabled');

        }
    });


    $(function () {
        $('.checkEmailItem').click(function () {
            if ($('input[name="selected_email_id[]"]:checked').length >0){
                $('#deleteSelectedEmail').removeAttr('disabled');
            }  else{
                $('#deleteSelectedEmail').attr('disabled','disabled');

            }
        });
    });

    $('#btn_delete_email').click(function () {
        $('#delete_email_form').submit();
    });



    /*
    Categories
     */


    let category_table=   $('#category_table').DataTable({
        "aLengthMenu": [
            [5, 10, 15, -1],
            [5, 10, 15, "All"]
        ],
        buttons: [
            // 'copy', 'csv', 'excel', 'pdf', 'print'
            'excel','pdf'
        ],
        "iDisplayLength": 10,
        "language": {
            search: ""
        }
    });

    category_table.column(2).visible(false);
    category_table.on('click','.new-category',function () {

      let  $tr = $(this).closest('tr');

        if ($($tr).hasClass('child')){
            $tr = $tr.prev('.parent');
        }


        let data = category_table.row($tr).data();

//     console.log(data);

        $('#category_id').val(data[2]);



        $('#edit-candidate-form').attr('action', 'candidates/'+data[2]);
        $('#edit-candidate-info').modal('show');
        $('#candidate-tittle').text(data[2]);
    });
});