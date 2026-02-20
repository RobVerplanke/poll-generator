@extends('layouts.default')

@section('header')
  <h2>- Create new poll -</h2>
  <button class="btn btn-small" onclick="window.location='{{ url('/') }}'">Back</button>
@endsection

@section('maincontent')
  <form class="form-create" action="{{ route('polls.store') }}" method="POST">

    {{-- Prevent cross-site requests --}}
    @csrf

    {{-- Poll title --}}
    <div class="form-line">
      <label for="label">Title</label>
      <input type="text" name ="label" id="label" placeholder="Title of poll..." value={{ old('label') }}>
    </div>

    {{-- Poll options --}}
    <div class="form-option-container"></div>
    <button type="button" class="btn btn-small" onclick="addPollOptions()"> + Add</button>

    {{-- Choose an end date --}}
    <div>
      <label for="ends_at">End date</label>
      <input type="date" name ="ends_at" id="ends_at" value={{ old('ends_at') }}>
    </div>

    {{-- Error messages --}}
    <div class="error">
      @if ($errors->any())
        <p>Error:</p>
        @foreach (array_unique($errors->all()) as $error)
          <p>- {{ $error }}</p>
        @endforeach
      @endif
    </div>

    {{-- Submit button --}}
    <button type="submit" class="btn">Submit</button>

  </form>
@endsection


{{-- Remember old values, prevents value reset after submit with error(s) --}}
<script>
  window.oldOptions = @json(old('options', []));
</script>
<script src={{ asset('js/loadOptions.js') }}></script>

</html>
