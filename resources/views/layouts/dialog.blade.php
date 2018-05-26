@if(count($errors))
  <br>
  <div class="container">
    <div class="row form-body">
      <div class="col-md-12">
        @foreach ($errors->all() as $error)
          <div class="card-body mb-4 alert alert-danger card box-shadow">
            {{ $error }}
          </div>
        @endforeach
      </div>
    </div>
  </div>
@endif
@if (session('success'))
  <br>
  <div class="container">
    <div class="row form-body">
      <div class="col-md-12">
        <div class="card-body mb-4 alert alert-success card box-shadow">
          {{ session('success') }}
        </div>
      </div>
    </div>
  </div>
@endif
