<!DOCTYPE html>
<html>

<head>
    <title>Laravel Livewire Demo</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @livewireStyles
</head>
<style>
    .search-container {
        margin-top: 20px;
    }
</style>

<body>

    <div class="card-body">
        {{-- @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif --}}
        @livewire('staffwork')
    </div>
    @livewireScripts
</body>

</html>
