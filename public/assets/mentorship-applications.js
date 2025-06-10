$(function () { 
    var dt_applications_table = $('.datatables-applications');

    if (dt_applications_table.length) { 
        var dt_applications = dt_applications_table.DataTable({
            ajax: "{{ route('mentorship.applications') }}",
            columns: [
                { data: '' },
                { data: 'DT_RowIndex' },
                { data: 'DT_RowIndex', name: 'Id' },
                { data: 'first_name', name: 'Name', render: function(data, type, row) {
                    return row.first_name + ' ' + row.second_name;
                } },
                { data: 'email', name: 'Email' },
                { data: 'contact_number', name: 'Contact' },
                { data: 'occupation', name: 'Occupation' },
                { data: 'programme_choice', name: 'Programme' },
                { data: 'is_eligible', name: 'Status' },
                { data: '' }
            ],
            columnDefs: [
                {
                    // For Checkboxes
                    targets: 0,
                    orderable: false,
                    responsivePriority: 3,
                    searchable: false,
                    checkboxes: true,
                    render: function() {
                      return '<input type="checkbox" class="dt-checkboxes form-check-input">';
                    },
                    checkboxes: {
                      selectRow: true,
                      selectAllRender: '<input type="checkbox" class="form-check-input">'
                    }
                },
                {
                    // Actions
                    targets: -1,
                    title: 'Actions',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, full, meta) {
                      return (
                        '<div class="d-inline-block">' +
                        '<a href="javascript:;" class="btn btn-sm text-primary btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="icon-base ti tabler-dots-vertical-rounded"></i></a>' +
                        '<ul class="dropdown-menu dropdown-menu-end">' +
                        '<li><a href="javascript:;" class="dropdown-item">Details</a></li>' +
                        '<li><a href="javascript:;" class="dropdown-item">Archive</a></li>' +
                        '<div class="dropdown-divider"></div>' +
                        '<li><a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a></li>' +
                        '</ul>' +
                        '</div>' +
                        '<a href="javascript:;" class="btn btn-sm text-primary btn-icon item-edit"><i class="icon-base ti tabler-pencil"></i></a>'
                      );
                    }
                  }
                ],
                order: [[2, 'desc']],
                dom:
                  '<"card-header"<"head-label text-center"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                displayLength: 7,
                lengthMenu: [7, 10, 25, 50, 75, 100],
                buttons: [
                  {
                    extend: 'collection',
                    className: 'btn btn-label-primary dropdown-toggle me-2',
                    text: '<i class="icon-base ti tabler-show me-1"></i>Export',
                    buttons: [
                      {
                        extend: 'print',
                        text: '<i class="icon-base ti tabler-printer me-1" ></i>Print',
                        className: 'dropdown-item',
                        exportOptions: { columns: [3, 4, 5, 6, 7] }
                      },
                      {
                        extend: 'csv',
                        text: '<i class="icon-base ti tabler-file me-1" ></i>Csv',
                        className: 'dropdown-item',
                        exportOptions: { columns: [3, 4, 5, 6, 7] }
                      },
                      {
                        extend: 'excel',
                        text: 'Excel',
                        className: 'dropdown-item',
                        exportOptions: { columns: [3, 4, 5, 6, 7] }
                      },
                      {
                        extend: 'pdf',
                        text: '<i class="icon-base ti tabler-file-text me-1"></i>Pdf',
                        className: 'dropdown-item',
                        exportOptions: { columns: [3, 4, 5, 6, 7] }
                      },
                      {
                        extend: 'copy',
                        text: '<i class="icon-base ti tabler-copy me-1" ></i>Copy',
                        className: 'dropdown-item',
                        exportOptions: { columns: [3, 4, 5, 6, 7] }
                      }
                    ]
                  },
                  {
                    text: '<i class="icon-base ti tabler-plus me-1"></i> <span class="d-none d-lg-inline-block">Add New Record</span>',
                    className: 'create-new btn btn-primary'
                  }
          ],
          select: {
            // Select style
            style: 'multi'
          }
        })
    }
})