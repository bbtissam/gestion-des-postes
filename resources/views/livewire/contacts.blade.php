<div class="container">
    <div class="row my-4">
        <div class="col-md-6 mx-auto">
            <div class="my-2">

                

                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
            </div>

           
            
            <form wire:submit.prevent="addContact" >
            <div class="mb-3">
                <input type="text" name="name" wire:model="name" placeholder="Name" class="form-control" autocomplete="off"/>
                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <input type="text" name="phone" wire:model="phone" class="form-control" placeholder="Phone" autocomplete="off"/>
                @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <input type="file" name="photo" wire:model="photo" wire:loading.remove class="form-control" autocomplete="off"/>
                @error('photo') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="my-2" >
            @if ($photo)
            Photo Preview:
            <img src="{{ $photo->temporaryUrl() }}" width="60" height="60">
            @endif
            </div>
            <div class="mb-2" >
               
                @if ($editing)
                <div>
                <button class="btn btn-warning" type="button" wire:click="updateContact">Update</button>
                <button class="btn btn-danger" type="button" wire:click="cancelUpdate">Cancel</button>
                </div>
                @else
                <button type="submit" class="btn btn-primary">Add</button>
                @endif
                
            </div>
            </form>
            
            <ul class="list-group">
                @foreach ($contactsList as $contact)
                    <li class="list-group-item fw-bold">
                        <div>
                    @if($contact->photo)
                    <img width="60" height="60" src="{{asset("storage/photos/".$contact->photo)}}"/>
                    @endif    
                    <i class="fas fa-user me-2"></i>{{$contact["name"]}}
                    <i class="fas fa-phone me-2"></i>{{$contact["phone"]}}
                        </div>
                    <div class="de-flex float-end">

                        

                        <button class="btn btn-sm btn-warning" wire:click="getContact({{$contact->id}})">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" wire:click="deleteContact({{$contact->id}})">
                            <i class="fas fa-trash"></i>
                        </button>

                       
                    </div>
                    </li>
                @endforeach
            </ul>
            <div class="my-2">
                {{ $contactsList->links() }}

            </div>

</div>
</div>
</div>