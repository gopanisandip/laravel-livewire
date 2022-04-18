<!DOCTYPE html>
<html>
<head>
    <title>Laravel Livewire Demo</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    @livewireStyles
</head>
<body>
    <div class="container" style="margin-top:20px;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    {{-- <div class="card-header">
                        <h2>Laravel Livewire CRUD</h2>
                    </div> --}}
                    <div class="card-body">
                        @if (session()->has('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
                        @livewire('tasks')
                    </div>
                </div>
            </div>
        </div>
    </div>
    @livewireScripts
</body>
</html>