$(function() {
    'use strict';
  
    function initTable(id, status, display) {
        var dt_basic_table = $('#' + id);

        var dt_basic = dt_basic_table.DataTable({
            ajax: {
                url: mentorshipRoute,
                data: {status: status}
            },
            columns: [
                //{ data: '' },
                { data: 'DT_RowIndex' },
                //{ data: 'DT_RowIndex', name: 'Id' },
                { data: 'first_name', name: 'Name', render: function(data, type, row) {
                    return row.first_name + ' ' + row.second_name;
                } },
                { data: 'email', name: 'Email' },
                //{ data: 'contact_number', name: 'Contact' },
                { data: 'occupation', name: 'Occupation' },
                //{ data: 'designation', name: 'Designation' },
                //{ data: 'organization', name: 'Organization' },
                { data: 'programme_choice', name: 'Programme' },
                //{ data: 'linkedin', name: 'Linkedin' },
                { data: 'submitted_at', name: 'Submission Date' },
                { data: '' }
              ],
                columnDefs: [
              {
                // For Checkboxes
                targets: 0,
                orderable: false,
                responsivePriority: 1,
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
                targets: 3,
                searchable: false
            },
            
              {
                // Actions
                targets: -1,
                title: 'Actions',
                orderable: false,
                searchable: false,
                responsivePriority: 0,
                className: 'no-select',
                render: function(data, type, full, meta) {
                  return (
                    '<div class="d-flex">' +
                    '<a href="applications/'+ full['DT_RowIndex'] +'" class="btn btn-sm text-primary btn-icon"><i class="icon-base ti ri-eye-fill"></i></a>' +
                    '<a href="javascript:;" class="btn btn-sm text-primary btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="icon-base ti ri-more-2-fill"></i></a>' +
                      '<ul class="dropdown-menu dropdown-menu-end">' +
                      '<li><a href="javascript:;" class="dropdown-item action-mark" data-id=' + full['DT_RowIndex'] + '>Approve</a></li>' +
                      '<li><a href="javascript:;" class="dropdown-item action-mark" data-id='+full['DT_RowIndex']+'>Reject</a></li>' +
                    '<li><a href="javascript:;" class="dropdown-item">Archive</a></li>' +
                    '<div class="dropdown-divider"></div>' +
                    '<li><a href="javascript:;" class="dropdown-item text-danger delete-record" data-id='+full['DT_RowIndex']+'>Delete</a></li>' +
                    '</ul>' +
                    '</div>'
                  );
                }
              }
              ],
              language: {
                search: "",
                searchPlaceholder: "Type to search"
            },
            order: [[2, 'desc']],
            dom:
              '<"card-header"<"head-label text-center"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            displayLength: 7,
            lengthMenu: [7, 10, 25, 50, 75, 100],
              buttons: [
                  {
                      className: "btn btn-label-primary "+display+" me-2 btn-action btn-delete-selected",
                      text: "Approve",
                      action: function () {
                          const rows = dt_basic.rows({ selected: true });
                          if (rows.count() > 0) {
                              
                          } else { 
                              alert("No row selected.")
                          }
                      }
                  },
                  {
                    className: "btn btn-label-danger "+display+" me-2 btn-action btn-delete-selected",
                    text: "Reject",
                    action: function () {
                      const rows = e.rows({ selected: true });
                    }
                    },
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
              }
            ],
            select: {
                style: 'multi'
            }
          });
          $("#" + id +"_wrapper").find('.head-label').html('<h4 class="card-title mb-0">'+ status +' Submissions</h4>');
    }

    initTable('pending-table', 'Pending', 'd-block');
    initTable('approved-table', 'Approved', 'd-none');
    initTable('rejected-table', 'Rejected', 'd-none');

    $(document).on('click', ".action-mark", function () {
        alert($(this).data('id'));
    });
});