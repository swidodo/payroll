
<script>
    $(document).ready(function () {
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          
          var branch_id = $('#branch_id').val();
          getData(branch_id);
          function getData(branch_id){
              $('#report_contract').DataTable({
                  processing: true,
                  serverSide: true,
                  destroy: true,
                  ajax : {
                      "url" : 'get-report-contract',
                      "type": 'post',
                      "data" : {branch_id:branch_id}
                  },
                  columns: [
                    { data: 'no', name:'employee_id', render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                    }},
                    {
                        data: 'employee_id',
                        name: 'employee_id'
                    },
                    {
                        data: 'employee_name',
                        name: 'employee_name'
                    },
                    {
                        data: 'position_name',
                        name: 'position_name'
                    },
                    {
                        data: 'departement_name',
                        name: 'departement_name'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'company_doj',
                        name: 'company_doj'
                    },
                    {
                        data: 'company_doe',
                        name: 'company_doe'
                    },
                    {
                        data: null,
                        render : function(data,row,type){
                            var remain =data.remainder;
                            if(data.remainder > 0){
                                if (data.remainder <= 31 && data.status_contract =='AVAILABLE'){
                                    remain = '<span class="badge badge-warning  p-3 text-dark fw-bold">'+data.remainder+ ' DAY</span>'
                                }else if (data.remainder > 31 && data.status_contract =='AVAILABLE'){
                                    remain = '<span class="badge badge-success p-3 text-dark fw-bold">'+data.remainder+ ' DAY</span>'
                                }
                            }else if(data.remainder <= 0 && data.status_contract =='EXPIRED CONTRACT'){
                                remain = '<span class="badge badge-danger p-3 text-dark fw-bold">EXPIRED</span>'
                            }
                            return remain;
                        }                        
                    },
                ],
              });
          }
          $('#filter_report_contract').on('click',function(e){
              e.preventDefault();
              var branch_id = $('#branch_id').val();
              getData(branch_id);
          })
          
      });
  </script>