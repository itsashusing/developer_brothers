<div class="card-body p-2">
    <h5 class="mb-4">Add Money</h5>
    <form class="row g-3" method="POST" action="{{ route('users_lists') }}">
        @csrf
        <div class="col-md-12">
            <label for="amount" class="form-label">Amount</label>
            <input type="number" name="amount" class="form-control" id="amount"
                placeholder="Please enter amount" @required(true)>
        </div>
        <div class="col-md-12 form-group mt-4 d-flex justify-content-end">
            <div class="d-md-flex d-grid align-items-center gap-3">
                <button type="submit" value="{{ $request['param1'] }}" name="submit_add_money" class="btn btn-primary px-4">Submit</button>
            </div>
        </div>
    </form>
</div>
