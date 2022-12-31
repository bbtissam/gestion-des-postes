<div class="col-md-6 ">
    <div class="my-2">
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>
    <form wire:submit.prevent="register">
        <h3>Register</h3>
        <hr>
    <div class="mb-3">
        <input type="text" name="name" wire:model="name" placeholder="Name" class="form-control" autocomplete="off">
        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
    <div class="mb-3">
        <input type="email" name="email" wire:model="email" class="form-control" placeholder="email" autocomplete="off">
        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
    <div class="mb-3">
        <input type="password" name="password" wire:model="password"  class="form-control" autocomplete="off">
        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
    <div class="mb-2">
      
        <button class="btn btn-primary" type="submit">Register</button>
    </div>
    </form>
</div>