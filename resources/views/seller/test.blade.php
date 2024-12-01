<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notify Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5 text-center">
        <h2>Notify Admin</h2>
        <div class="d-flex justify-content-center">
            <form action="{{ route('test-notify') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Notify Admin</button>
            </form>
        </div>
    </div>
</body>
</html>