<div>
    <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label text-lg-right text-sm-start">Email</label>
        <div class="col-sm-4">
            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required
                value="{{ old('email') }}" wire:model.defer="email" />
            @error('email')
                <span class="text-danger error">{{ $message }}</span>
            @enderror
        </div>

        <label for="username" class="col-sm-2 col-form-label text-lg-right">User Name</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="username" name="username" placeholder="User Name" required
                value="{{ old('username') }}" wire:model.defer="username" />
            @error('username')
                <span class="text-danger error">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="password" class="col-sm-2 col-form-label text-lg-right text-sm-start">Password</label>
        <div class="col-sm-4">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                maxlength="100" minlength="5" required value="{{ old('password') }}" wire:model.defer="password" />
            @error('password')
                <span class="text-danger error">{{ $message }}</span>
            @enderror
        </div>

        <label for="confirm_password" class="col-sm-2 col-form-label text-lg-right">Confirm
            Password</label>
        <div class="col-sm-4">
            <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                placeholder="Confirm Password" maxlength="100" minlength="5" required
                value="{{ old('confirm_password') }}" wire:model.defer="confirm_password" />
            @error('confirm_password')
                <span class="text-danger error">{{ $message }}</span>
            @enderror
        </div>
    </div>


    <div class="text-right text-white"><a class="btn btn-info" wire:click="accountNext" id="next">Next</a>
    </div>
</div>
