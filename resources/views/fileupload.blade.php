<!DOCTYPE html>
<html>
<head>
    <title>Import Excel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
</head>
<body>

<div class="container">
    <div class="card mt-4">
        <div class="card-header">
            Laravel 6 Import
        </div>
        <div class="card-body">
            <form action="{{ url('import') }}" method="POST" name="importform"
               enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control">
                <br>
                <button type="submit" class="btn btn-success">Import File</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>