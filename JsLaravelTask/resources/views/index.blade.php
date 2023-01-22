<!DOCTYPE html>
<html>
<head>
    <title>Datatables AJAX pagination with Search and Sort in Laravel 9</title>

    <!-- Meta -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">

    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/bs4/jq-3.6.0/dt-1.13.1/r-2.4.0/sb-1.4.0/datatables.min.css"/>

    <script type="text/javascript"
            src="https://cdn.datatables.net/v/bs4/jq-3.6.0/dt-1.13.1/r-2.4.0/sb-1.4.0/datatables.min.js"></script>

</head>
<body>

<table id='empTable' width='100%' border="1" style='border-collapse: collapse;'>
    <thead>
    <tr>
        <td>S.no</td>
        <td>Username</td>
        <td>Name</td>
        <td>Email</td>
    </tr>
    </thead>
</table>

<!-- Script -->
<script src="{{ mix('js/app.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {

        // DataTable
        $('#empTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('getEmployees')}}",
            columns: [
                {data: 'id'},
                {data: 'username'},
                {data: 'name'},
                {data: 'email'},
            ]
        });

    });
</script>
</body>
</html>
