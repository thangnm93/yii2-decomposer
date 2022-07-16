if(typeof DecomposerConfigs === 'undefined') {
    var DecomposerConfigs = {
        "search": 'Search',
        "lengthMenu": 'Display _MENU_ records per page',
        "zeroRecords": 'No matching records found',
        "info": 'Showing _START_ to _END_ of _TOTAL_ entries',
        "infoEmpty": 'No records available',
        "infoFiltered": '(filtered from _MAX_ total records)',
        "paginate": {
            "first": 'First',
            "last": 'Last',
            "next": 'Next',
            "previous": 'Previous'
        }
    }
}
$(document).ready(function() {
    $('#decomposer').DataTable({
        'order': [[ 0, 'desc' ]],
        searchHighlight: true,
        "language": {
            "search": DecomposerConfigs.search,
            "lengthMenu": DecomposerConfigs.lengthMenu,
            "zeroRecords": DecomposerConfigs.zeroRecords,
            "info": DecomposerConfigs.info,
            "infoEmpty": DecomposerConfigs.infoEmpty,
            "infoFiltered": DecomposerConfigs.infoFiltered,
            "paginate": {
                "first": DecomposerConfigs.paginate.first,
                "last": DecomposerConfigs.paginate.last,
                "next": DecomposerConfigs.paginate.next,
                "previous": DecomposerConfigs.paginate.previous
            },
        }
    });
    let s = document.getElementById("txt-report").value;
    s = s.replace(/(^\s*)|(\s*$)/gi,"");
    s = s.replace(/[ ]{2,}/gi," ");
    s = s.replace(/\n /,"\n");
    document.getElementById("txt-report").value = s;
    $('#btn-report').on('click', function() {
        $("#report-wrapper").slideToggle();
    });
    $("#copy-report").on('click', function() {
        $("#txt-report").select();
        document.execCommand("copy");
    });
});
