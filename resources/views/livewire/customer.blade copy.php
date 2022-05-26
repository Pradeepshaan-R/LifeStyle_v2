<div>
    <div class="row">
        <div class="col-md-6 mb-4">

            <div class="form-outline">
                <label class="form-label" for="firstName">First Name</label>
                <input type="text" id="firstName" class="form-control form-control-lg" wire:model.defer="first_name" />
            </div>

        </div>
        <div class="col-md-6 mb-4">

            <div class="form-outline">
                <label class="form-label" for="lastName">Last Name</label>
                <input type="text" id="lastName" class="form-control form-control-lg" wire:model.defer="last_name" />
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4 d-flex align-items-center">

            <div class="form-outline datepicker w-100">
                <label for="birthdayDate" class="form-label">Birthday</label>
                <input type="text" class="form-control form-control-lg" id="birthdayDate" wire:model.defer="dob" />
            </div>

        </div>
        <div class="col-md-6 mb-4">

            <label class="mb-2 pb-1">Gender: </label>

            <select class="form-control" name='gender' id="gender" readonly="readonly" wire:model.defer="gender">
                <option value="">--Gender--</option>
                @foreach (App\Models\Customer::getEnum('Gender') as $gender)
                    <option value="{{ $gender }}" {{ old('gender') == $gender ? 'selected' : '' }}>
                        {{ $gender }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4 pb-2">

            <div class="form-outline">
                <label class="form-label" for="emailAddress">Email</label>
                <input type="email" id="emailAddress" class="form-control form-control-lg" wire:model.defer="email" />
            </div>

        </div>
        <div class="col-md-6 mb-4 pb-2">

            <div class="form-outline">
                <label class="form-label" for="phoneNumber">Phone Number</label>
                <input type="tel" id="phoneNumber" class="form-control form-control-lg" wire:model.defer="phone" />
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4 pb-2">

            <div class="form-outline">
                <label class="form-label" for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                    maxlength="100" minlength="5" required value="{{ old('password') }}"
                    wire:model.defer="password" />
            </div>

        </div>
        <div class="col-md-6 mb-4 pb-2">

            <div class="form-outline">
                <label class="form-label" for="confirm_password">Confirm
                    Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                    placeholder="Confirm Password" maxlength="100" minlength="5" required
                    value="{{ old('confirm_password') }}" wire:model.defer="confirm_password" />
            </div>

        </div>
    </div>

    <div class="mt-4 pt-2 text-light">
        <div class="text-right text-white">
            <button type="button" class="btn btn-secondary" wire:model="registerBack">Back</button>
            <button type="button" class="btn btn-info" wire:click="register">Submit</button>
        </div>
    </div>
</div>
