$(document).ready( function() {
    $('#myTable').DataTable(
        {
            searching: false,
            paging: true,
            info: false,
            lengthChange: false,
            responsive: true
        }
    );
    $("#myTable_previous").html(`<i class="fas fa-angle-left curser-icon"></i>`);
    $("#myTable_next").html(`<i class="fas fa-angle-right curser-icon"></i>`);
} );

// document.getElementById('myTable_previous').innerHTML="<";