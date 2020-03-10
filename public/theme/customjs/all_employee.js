<script>
$(document).ready( function(){
  $('#all-employee').DataTable({
    //    "paging": true,
    //   // "lengthChange": false,
    // // "searching": false,
    //   "ordering": true,
    // "info": true,
    // "autoWidth": false,
    // scrollX:'50vh',
    // scrollY:'50vh',
    // scrollCollapse: true,
      "info": true,
      "autoWidth": false,
      scrollX:'50vh', 
      scrollY:'50vh',
      scrollCollapse: true,
      fixedColumns:   {
        leftColumns: 2
    }
  });
});

</script>
<script src="{{ asset('theme/plugins/datatables-fixedcolumns/js/dataTables.fixedColumns.min.js') }}"></script>