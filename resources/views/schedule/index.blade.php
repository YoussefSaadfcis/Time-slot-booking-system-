<html>

<head>
    <title>Laravel 10 Datatables Date Range Filter</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
</head>

<body>
@include("alert.success");
    <div class="container">
        <h1 class="text-center text-success mt-5 mb-5"><b>All schedules </b></h1>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col col-9"><b>Sample Data</b></div>
                    <div class="col col-3">
                        <div id="daterange" class="float-end"
                            style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%; text-align:center">
                            <i class="fa fa-calendar"></i>&nbsp;
                            <span></span>
                            <i class="fa fa-caret-down"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="daterange_table">
                    <thead>
                        <tr>
                            <th>date</th>
                            <th>data</th>
                            <th>service</th>
                            <th>branch</th>
                            <th>Actions</th> <!-- New column for the delete button -->
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
    $(function() {

        var start_date = moment().subtract(1, 'year');

        var end_date = moment().add(1, 'year');

        $('#daterange span').html(start_date.format('DD-MM-YYYY') + ' - ' + end_date.format('DD-MM-YYYY'));

        $('#daterange').daterangepicker({
            startDate: start_date,
            endDate: end_date
        }, function(start_date, end_date) {
            $('#daterange span').html(start_date.format('DD-MM-YYYY') + ' - ' + end_date.format(
                'DD-MM-YYYY'));

            table.draw();
        });

        var table = $('#daterange_table').DataTable({
            processing: true,
            serverSide: true,
            lengthMenu: [5, 10, 25, 50, 100],
            ajax: {
                url: "{{ route('schedule.index') }}",
                data: function(data) {
                    data.from_date = $('#daterange').data('daterangepicker').startDate.format(
                        'YYYY-MM-DD');
                    data.to_date = $('#daterange').data('daterangepicker').endDate.format(
                        'YYYY-MM-DD');
                }
            },
            columns: [{
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'data',
                    name: 'data'
                },
                {
                    data: 'service.name',
                    name: 'service.name'
                },
                {
                    data: 'branch.name',
                    name: 'branch.name'
                },
                {
                    // New column for the delete button
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        var deleteFormAction = "{{ route('schedule.destroy', ':id') }}";
                        deleteFormAction = deleteFormAction.replace(':id', row.id);

                        return '<form action="' + deleteFormAction + '" method="POST">' +
                            '@csrf' +
                            '@method('DELETE')' +
                            '<button type="submit" class="btn btn-danger" onclick="return confirm(\'Are you sure you want to delete this schedule?\')">Delete</button>' +
                            '</form>';
                    }
                }
            ]
        });

    });
</script>

</html>
