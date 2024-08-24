<div class="page-header">
    <h1 class="page-title">Dealer Form</h1>
    
</div>
<form method="POST" action="{{ isset($dealer['id']) ? route('dealer.update', $dealer['id']) : route('dealer.store') }}">
    @csrf
    @if(isset($dealer['id']))
        @method('PUT')
    @endif

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="dealer_code">Dealer Code:</label>
                <input type="text" class="form-control" id="dealer_code" name="dealer_code" value="{{ old('dealer_code', $dealerCode ?? '') }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="dealer_name">Dealer Name:</label>
                <input type="text" class="form-control" id="dealer_name" name="dealer_name" value="{{ old('dealer_name', 'palwasha') }}" required>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="contact_name">Contact Name:</label>
                <input type="text" class="form-control" id="contact_name" name="contact_name" value="{{ old('contact_name') }}" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">Contact Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="address_1">Address 1:</label>
                <input type="text" class="form-control" id="address_1" name="address_1" value="{{ old('address_1') }}" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="address_2">Address 2:</label>
                <input type="text" class="form-control" id="address_2" name="address_2" value="{{ old('address_2') }}" required>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="zip_code">Zip Code:</label>
                <input type="text" class="form-control" id="zip_code" name="zip_code" value="{{ old('zip_code') }}" required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="state">State:</label>
                <input type="text" class="form-control" id="state" name="state" value="{{ old('state') }}" required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}" required>
            </div>
        </div>
    </div>

    <!-- More form fields as needed -->

    <button type="submit" class="btn btn-primary">Save Changes</button>
</form>
