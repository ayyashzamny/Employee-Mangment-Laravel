<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Leave</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .btn {
            margin-top: 10px;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Request Leave</h2>
        <form id="leaveRequestForm" method="POST">
            @csrf
            <div class="form-group">
                <label for="employee_id">Employee ID:</label>
                <input type="text" class="form-control" id="employee_id" name="employee_id" required>
            </div>
            <div class="form-group">
                <label for="leave_type_id">Leave Type:</label>
                <select class="form-control" id="leave_type_id" name="leave_type_id" required>
                    <option value="1">Medical Leave</option>
                    <option value="2">Casual Leave</option>
                </select>
            </div>
            <div class="form-group">
                <label for="request_leave_date_from">Request Leave Date From:</label>
                <input type="date" class="form-control" id="request_leave_date_from" name="request_leave_date_from"
                    required>
            </div>
            <div class="form-group">
                <label for="request_leave_date_to">Request Leave Date To:</label>
                <input type="date" class="form-control" id="request_leave_date_to" name="request_leave_date_to"
                    required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Custom JS -->
    <script src="{{ asset('js/leaveRequest.js') }}"></script>
</body>

</html>