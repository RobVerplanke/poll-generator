<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <title>Create new poll</title>
  </head>

  <body>

    <header>
      <p>Create new poll</p>
      <a class="btn" href={{ url('/') }}>Back</a>
    </header>

    <main>
      <form class="form-create" action="{{ route('polls.store') }}" method="POST">

        {{-- Prevent cross-site requests --}}
        @csrf

        {{-- Poll title --}}
        <div class="form-line">
          <label for="label">Title</label>
          <input type="text" name ="label" id="label" placeholder="Title of poll...">
        </div>

        {{-- Poll options --}}
        <div class="form-option-container"></div>
        <button type="button" class="btn" onclick="addPollOptions()"> + </button>

        {{-- Choose an end date --}}
        <div>
          <label for="ends_at">End date</label>
          <input type="date" name ="ends_at" id="ends_at">
        </div>

        <button type="submit" class="btn">Submit</button>

        <div class="error">

          @if ($errors->any())
            @foreach ($errors->all() as $error)
              <p>{{ $error }}</p>
            @endforeach
          @endif

        </div>

      </form>
    </main>

    <script src={{ asset('js/preloadOptions.js') }}></script>
  </body>

</html>
