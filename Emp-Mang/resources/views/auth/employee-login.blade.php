<!-- resources/views/auth/employee-login.blade.php -->

<!DOCTYPE html>
<html>

<head>
    <title>Employee Login</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Employee Login</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('employee.login') }}">
                            @csrf

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>