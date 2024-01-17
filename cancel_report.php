<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<!-- Buttons CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.0/css/buttons.dataTables.min.css">

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<!-- Buttons JS -->
<script src="https://cdn.datatables.net/buttons/2.3.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.0/js/buttons.print.min.js"></script>
<style>
    /* .dt-buttons{
        float: right !important;
    } */
</style>


<div class="wrapper">
    <div class="container-fluid">
        <div class="main-content">
            <div class="page-content">
                <!-- start page title -->
                <div class="row">
                    <div class="col-md-12 col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Cancel Report</h4>
                                <div class="row">
                                    <div class="col-md-12">
                                        <form id="cancelReportForm">
                                            <div class="row">
                                                <div class="col-md-1 d-flex justify-content-center align-items-center">
                                                    <label for="startDate">From Date</label>
                                                </div>
                                                <div class="col-md-1 d-flex justify-content-center align-items-center">
                                                    <input type="text" class="form-control" id="startDate" name="startDate" required>
                                                </div>
                                                <div class="col-md-1 d-flex justify-content-center align-items-center">
                                                    <label for="endDate">To Date</label>
                                                </div>
                                                <div class="col-md-1">
                                                    <input type="text" class="form-control" id="endDate" name="endDate" required>
                                                </div>
                                                <div class="col-md-1 d-flex justify-content-center align-items-center">
                                                    <label for="query_cancel">Cancel Reason</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <select name="query_cancel" class="form-control" required>
                                                        <option value="" disabled="" selected="">Select a Cancel Reason</option>
                                                        <option value="Booked With Someone Else">Booked With Someone Else</option>
                                                        <option value="Work visa enquiry">Work visa enquiry</option>
                                                        <option value="Enquired by mistake">Enquired by mistake</option>
                                                        <option value="Language barrier">Language barrier</option>
                                                        <option value="Low budget">Low budget</option>
                                                        <option value="Travel Plan Cancelled">Travel Plan Cancelled</option>
                                                        <option value="Customer not responding">Customer not responding</option>
                                                        <option value="Invalid Conatct details" selected="">Invalid Conatct details</option>
                                                        <option value="Don't have passport">Don't have passport</option>
                                                        <option value="Duplicate query">Duplicate query</option>
                                                        <option value="No firm plans">No firm plans</option>
                                                        <option value="Propasal send but plan cancelled">Propasal send but plan cancelled</option>
                                                        <option value="Propasal send but brand trust issue">Propasal send but brand trust issue</option>
                                                        <option value="Propasal send but not responsding">Propasal send but not responsding</option>
                                                        <option value="Customer does not have visa documents(Europe only)">Customer does not have visa documents(Europe only)</option>
                                                        <option value="Test query">Test query</option>
                                                        <option value="No plan">No plan</option>
                                                        <option value="Customer not interested">Customer not interested</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 text-center">
                                                    <button type="submit" class="btn btn-secondary btn-lg waves-effect waves-light" style="padding: 6px 10px;"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                                                </div>
                                                <div class="col-md-2 text-center">
                                                    <button class="btn btn-secondary btn-lg waves-effect waves-light" style="padding: 6px 10px;" onclick="downloadExcel()">Download</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <br />
                            <div class="table-responsive" _style="margin: -50px 0px">
                                <table border="1" bordercolor="#CCCCCC" class="table table-hover mb-0" id="cancelReason" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Query ID</th>
                                            <th>Agent Name</th>
                                            <th>Cancel Reason</th>
                                            <th>Cancel Date</th>
                                        </tr>
                                    </thead>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>

            </div><!--end col-->
            <!-- end row -->
        </div>
        <!-- End Page-content -->
    </div>
</div>
</div>
<script>
    $(function() {
        $("#startDate").datepicker({
            dateFormat: 'dd-mm-yy'
        });

        $("#endDate").datepicker({
            dateFormat: 'dd-mm-yy'
        });

    });
</script>
<script>
    let dataTable = null;

    document.addEventListener("DOMContentLoaded", () => {
        initializeDataTable(); // Initialize DataTable on page load
        //document.querySelector('.buttons-csv span').textContent = 'Download';
        // Attach event listener to the form
        const form = document.getElementById('cancelReportForm'); // Replace with your form's ID
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            getCancelReport(this); // Pass the form to the function
        });
    });

    function initializeDataTable() {
        dataTable = $('#cancelReason').DataTable({
            // dom: 'Bfrtip',
            // buttons: ['csv'],
            "processing": true,
            "serverSide": true,
            "searching": false,
            "lengthChange": false,
            "ordering": false,
            "ajax": {
                "url": "report/cancel.php",
                "type": "POST",
                "data": function(d) {
                    d.draw = d.draw || 0;
                    d.start = d.start || 0;
                    d.length = d.length || 10;
                }
            },
            "columns": [{
                    "data": 'id'
                },
                {
                    "render": function(data, type, row) {
                        return `${row.firstName} ${row.lastName}`;
                    }
                },
                {
                    "data": 'query_cancel'
                },
                {
                    "data": 'updateDate',
                    "render": function(data, type, row) {
                        const originalDate = new Date(row.updateDate);
                        const formattedDate = `${originalDate.toLocaleDateString('en-US', { day: 'numeric', month: 'short', year: 'numeric' })} ${originalDate.toLocaleTimeString('en-US')}`;
                        return formattedDate;
                    }
                }
            ]
        });
    }

    function getCancelReport(form) {
        const formData = new FormData(form);
        const data = {};

        // Extracting data from the form
        formData.forEach(function(value, key) {
            data[key] = value;
        });

        // Constructing the URL with query parameters
        const url = 'report/cancel.php'; // Your base URL
        const queryParams = new URLSearchParams(data).toString(); // Convert form data to query string

        dataTable.ajax.url(`${url}?${queryParams}`).load();
    }

    function downloadExcel() {
        // Make an AJAX request to the PHP file that generates the Excel file
        // Replace 'generate_excel.php' with the actual PHP file path
        let xhr = new XMLHttpRequest();
        xhr.open('GET', 'report/download_cancel_report.php', true);
        xhr.responseType = 'blob';

        xhr.onload = function() {
            if (this.status === 200) {
                // Create a temporary link element to trigger the download
                let blob = new Blob([this.response], {
                    type: 'application/vnd.ms-excel'
                });
                let link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = 'cancel_report.csv'; // Set the file name
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
        };

        xhr.send();
    }
</script>