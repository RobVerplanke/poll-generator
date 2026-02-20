@extends('layouts.default')

@section('header')
  <h2>- Vote -</h2>
  <button class="btn btn-small" onclick="window.location='{{ url('/') }}'">Back</button>
@endsection

@section('maincontent')
  <div>
    <h2>{{ $poll->label }}</h2>
  </div>

  <form class="vote-options-form">
    <fieldset>

      @foreach ($poll->pollOptions as $option)
        <div class="vote-option">
          <input type="radio" name="option">
          <label for="option">{{ $option->text }}</label>
          <hr>
        </div>
      @endforeach
    </fieldset>
    <button class="btn" type="submit">Submit</button>
  </form>
@endsection
