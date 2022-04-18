<div>

    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @elseif (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    {{-- {{ dd(app('request')->user()->role->name === 'Admin') }} --}}
    @if (app('request')->user()->role->name === 'Admin')
        @if ($updateMode)
            @include('livewire.update')
        @else
            @include('livewire.create')
        @endif
    @endif
    @if (app('request')->user()->role->name !== 'Admin')
        @livewire('logout')
    @endif
    <div class="card-header" style="margin-top:20px">
        <h4>Task List</h4>
    </div>
    <table class="table table-bordered mt-5">
        <thead>
            <tr>
                <th>Title</th>
                <th>No. of Image</th>
                <th>Description</th>
                <th width="150px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->no_image }}</td>
                    <td>{{ $post->description }}</td>
                    <td>
                        @if (app('request')->user()->role->name === 'Admin')
                            <button wire:click="edit({{ $post->id }})" class="btn btn-primary btn-sm">Edit</button>
                            <button wire:click="delete({{ $post->id }})"
                                class="btn btn-danger btn-sm">Delete</button>
                        @else
                            @if ($post->worked_done_at === null && $post->worked_by !== null)
                                <button wire:click="Starttask({{ $post->id }})" id="{{ $post->id }}"
                                    class="btn btn-primary btn-sm" disabled>
                                    Countinue
                                </button>
                            @elseif ($post->worked_done_at === null)
                                <button wire:click="Starttask({{ $post->id }})" id="{{ $post->id }}"
                                    class="btn btn-primary btn-sm">
                                    Start Task
                                </button>
                            @else
                                Task Done.
                            @endif
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
