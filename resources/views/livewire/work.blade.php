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
            <div>
                
                @if ($decodedResponse ? $decodedResponse['data'] : '')
                <div class="row">
                    @foreach ($decodedResponse['data'] as $data)
                    {{-- <?php dd($data['id']) ?> --}}
                        <div class="col-md-4 form-group">
                            <img src="{{ $data['assets']['preview']['url'] }}" alt="">
                            <input type="checkbox" name="image_checked" wire:model="selectedImages" value="{{ $data['id'] }}">
                        </div>
                    @endforeach
                </div>
                @if (session()->has('error'))
                    <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
                <div class="btn-task-end">
                    <button wire:click.prevent="TaskEnd()" class="btn btn-primary" >Task End</button>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
</div>
<style>
    .form-group img {
        height: 200px;
        width: 200px;
    }
    button, input, optgroup, select, textarea {
        margin: revert;
    }
</style>
