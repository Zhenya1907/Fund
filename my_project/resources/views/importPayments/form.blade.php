<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Payments from CSV</title>
</head>
<body>

@if(session('success'))
    <div>
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('importPayments') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label for="csvFile">Choose a CSV file:</label>
    <input type="file" name="csvFile" id="csvFile" accept=".csv">

    <button type="submit">Import CSV</button>
</form>

</body>
</html>
