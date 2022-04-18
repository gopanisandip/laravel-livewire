@livewire('logout')

 <div class="card-header" style="margin-bottom: 30px;">
    <h4 >Create Form</h4>
</div>
<form>    

    <div class="row">
        <div class="form-group col">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" placeholder="Enter Title" wire:model="title">
            @error('title') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="form-group col">
        <label for="no_image">No.of Images:</label>

           <input type="number" class="form-control" id="no_image" placeholder="Enter Number of Images" wire:model="no_image">
        @error('no_image') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
      </div>
    <div class="form-group">
        <label for="description">Description:</label>
        <textarea type="text" class="form-control" id="description" wire:model="description" placeholder="Enter Description"></textarea>
        @error('description') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <button wire:click.prevent="store()" class="btn btn-success">Save</button>
</form>