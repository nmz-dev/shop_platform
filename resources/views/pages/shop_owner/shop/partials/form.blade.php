<form action="{{ !$shop ? route('shop.store') : route('shop.update')}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method($shop ? 'PUT' : 'POST')
    <div class="row mt-2">
        <div class="col-md-6">
            <label for="name">Name *</label>
            <input type="text" id="name" name="name" value="{{old('name', $shop->name ?? "")}}" minlength="3" maxlength="50" class="form-control " {{ $shop ? 'readonly' : ''}} required>
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="description">Description</label>
            <input type="text" id="description" name="description" value="{{old('description', $shop->description ?? "")}}" class="form-control">
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-md-6">
            <label for="profile_pic">Profile Picture</label>
            <input type="file" accept="image/*" id="profile_pic" name="profile_pic" value="{{ old('profile_pic', $shop->profile_pic ?? "") }}" class="form-control">
            @error('profile_pic')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="social_links">Social Links</label>
            <input type="text" id="social_links" name="social_links" value="{{ old('social_links', $shop->social_link ?? "") }}" class="form-control">
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-md-6">
            <label for="street">Street</label>
            <input type="text" id="street" name="street" value="{{ old('street', $shop->street ?? "") }}" class="form-control">
        </div>
        <div class="col-md-6">
            <label for="unit">Unit</label>
            <input type="text" id="unit" name="unit" value="{{ old('unit', $shop->unit ?? "") }}" class="form-control">
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-md-6">
            <label for="phone">Phone *</label>
            <input type="tel" id="phone" name="phone" value="{{ old('phone', $shop->phone ?? "") }}" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label for="postal_code">Postal Code *</label>
            <input type="text" id="postal_code" name="postal_code" value="{{ old('postal_code', $shop->postal_code ?? "") }}" class="form-control" required>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-md-12">
            <label for="address">Address *</label>
            <input type="text" id="address" name="address" value="{{ old('address', $shop->postal_code ?? "") }}" class="form-control" required>
        </div>
    </div>

    <div class="mt-3">
        <small class="text-muted">All field with * are Required</small>
    </div>
    <div class="d-grid gap-2 mt-3">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>
