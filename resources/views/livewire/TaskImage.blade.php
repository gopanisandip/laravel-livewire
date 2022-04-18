
<!DOCTYPE html>
<html>
    <head>
        <title>Laravel Livewire Demo</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        @livewireStyles
    </head>
    <style>
        .search-container{
            margin-top:20px;
        }
    </style>
    <body>
        <?php $task = App\Models\Task::where('id',app('request')->route('id'))->first(); ?>
    <div class="container" style="margin-top:50px;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                  
                    <table class="table table-bordered mt-5">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>No. of Image</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->no_image }}</td>
                                <td>{{ $task->description }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                          
                
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="search" placeholder="Search..." wire:model="search">
                        <div class="input-group-append">
                            <button wire:click.prevent="SearchImage()" class="btn btn-primary">Search</button>
                        </div>
                      </div>
                
            </div>
            </div>
        </div>
    </div>

</body>
</html>