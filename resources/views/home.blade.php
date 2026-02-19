@extends('layouts.default')

@section('header')
  <h1>- Poll generator -</h1>
@endsection

{{-- Arrow down SVG --}}
<svg style="display: none;" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
  <symbol id="arrow-down" viewBox="0 -4.5 20 20">
    <title>arrow_down [#339]</title>
    <desc>Created with Sketch.</desc>
    <defs>
    </defs>
    <g id="Page-1" stroke="none" stroke-width="0" fill-rule="evenodd">
      <g id="Dribbble-Light-Preview" transform="translate(-180.000000, -6684.000000)">
        <g id="icons" transform="translate(56.000000, 160.000000)">
          <path
            d="M144,6525.39 L142.594,6524 L133.987,6532.261 L133.069,6531.38 L133.074,6531.385 L125.427,6524.045 L124,6525.414 C126.113,6527.443 132.014,6533.107 133.987,6535 C135.453,6533.594 134.024,6534.965 144,6525.39"
            id="arrow_down-[#339]">
          </path>
        </g>
      </g>
    </g>
</svg>

{{-- Arrow up SVG --}}
<svg style="display: none;" version="1.1" xmlns="http://www.w3.org/2000/svg"
  xmlns:xlink="http://www.w3.org/1999/xlink">
  <symbol id="arrow-up" viewBox="0 -4.5 20 20">
    <title>arrow_up [#340]</title>
    <desc>Created with Sketch.</desc>
    <defs>
    </defs>
    <g id="Page-1" stroke="none" stroke-width="0" fill-rule="evenodd">
      <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g id="Dribbble-Light-Preview" transform="translate(-140.000000, -6683.000000)" fill="#000000">
          <g id="icons" transform="translate(56.000000, 160.000000)">
            <path
              d="M84,6532.61035 L85.4053672,6534 L94.0131154,6525.73862 L94.9311945,6526.61986 L94.9261501,6526.61502 L102.573446,6533.95545 L104,6532.58614 C101.8864,6530.55736 95.9854722,6524.89321 94.0131154,6523 C92.5472155,6524.40611 93.9757869,6523.03486 84,6532.61035"
              id="arrow_up-[#340]">
            </path>
          </g>
        </g>
      </g>
</svg>

@section('maincontent')
  <button class="btn btn--secondary" onClick="window.location='{{ route('polls.create') }}'">Create new
    poll</button>

  {{-- Overview of active polls --}}
  <section class="card">
    <h2 class="section-title">Active polls</h2>

    <table class="table">
      <thead>
        <tr>
          <th>
            <div class="table-header">
              <a
                href="{{ request()->fullUrlWithQuery(['open_sort' => 'id', 'open_direction' => $openPollsDirection === 'asc' ? 'desc' : 'asc']) }}">ID
                <svg class="sort-arrow">
                  <use href="#arrow-down" />
                </svg>
              </a>
            </div>
          </th>
          <th>
            <div class="table-header">
              <a
                href="{{ request()->fullUrlWithQuery(['open_sort' => 'label', 'open_direction' => $openPollsDirection === 'asc' ? 'desc' : 'asc']) }}">Title
                <svg class="sort-arrow">
                  <use href="#arrow-down" />
                </svg>
              </a>
            </div>
          </th>
          <th>
            <div class="table-header">
              <a
                href="{{ request()->fullUrlWithQuery(['open_sort' => 'votes', 'open_direction' => $openPollsDirection === 'asc' ? 'desc' : 'asc']) }}">Votes
                <svg class="sort-arrow">
                  <use href="#arrow-down" />
                </svg>
              </a>
            </div>
          </th>
          <th>
            <div class="table-header">
              <a
                href="{{ request()->fullUrlWithQuery(['open_sort' => 'ends_at', 'open_direction' => $openPollsDirection === 'asc' ? 'desc' : 'asc']) }}">End
                date
                <svg class="sort-arrow">
                  <use href="#arrow-down" />
                </svg>
              </a>
            </div>
          </th>
        </tr>
      </thead>
      <tbody>

        {{-- Iterate through all open polls --}}
        @foreach ($openPolls as $openPoll)
          {{-- <tr data-url="{{ route('poll.show', $poll->id) }}"> --}}
          <tr>
            <td>{{ $openPoll->id }}</td>
            <td>{{ $openPoll->label }}</td>
            <td>{{ $openPoll->totalVotes() }}</td>
            <td>{{ $openPoll->ends_at }}</td>
          </tr>
        @endforeach

      </tbody>
    </table>
  </section>

  {{-- Overview of closed polls --}}
  <section class="overview">
    <div class="overview-header">
      <button type="button" class="btn btn--secondary" onclick="toggleHistoryVisibility()">
        Previous polls
        <svg class="sort-arrow sort-arrow--secondary">
          <use href="#arrow-down" />
        </svg>
      </button>
    </div>

    <div class="overview-content hidden">
      <section class="card card--secondary">
        <table class="table">
          <thead>
            <tr>
              <th>
                <div class="table-header">
                  <a
                    href="{{ request()->fullUrlWithQuery(['closed_sort' => 'id', 'closed_direction' => $closedPollsDirection === 'asc' ? 'desc' : 'asc']) }}">ID
                    <svg class="sort-arrow">
                      <use href="#arrow-down" />
                    </svg>
                  </a>
                </div>
              </th>
              <th>
                <div class="table-header">
                  <a
                    href="{{ request()->fullUrlWithQuery(['closed_sort' => 'label', 'closed_direction' => $closedPollsDirection === 'asc' ? 'desc' : 'asc']) }}">Title
                    <svg class="sort-arrow">
                      <use href="#arrow-down" />
                    </svg>
                  </a>
                </div>
              </th>
              <th>
                <div class="table-header">
                  <a
                    href="{{ request()->fullUrlWithQuery(['closed_sort' => 'votes', 'closed_direction' => $closedPollsDirection === 'asc' ? 'desc' : 'asc']) }}">Votes
                    <svg class="sort-arrow">
                      <use href="#arrow-down" />
                    </svg>
                  </a>
              </th>
              <th>
                <div class="table-header">
                  <a
                    href="{{ request()->fullUrlWithQuery(['closed_sort' => 'ends_at', 'closed_direction' => $closedPollsDirection === 'asc' ? 'desc' : 'asc']) }}">End
                    date
                    <svg class="sort-arrow">
                      <use href="#arrow-down" />
                    </svg>
                  </a>
                </div>
              </th>
            </tr>
          </thead>
          <tbody>

            {{-- Iterate through all closed polls --}}
            @foreach ($closedPolls as $closedPoll)
              <tr>
                <td>{{ $closedPoll->id }}</td>
                <td>{{ $closedPoll->label }}</td>
                <td>{{ $closedPoll->totalVotes() }}</td>
                <td>{{ $closedPoll->ends_at }}</td>
              </tr>
            @endforeach

          </tbody>
        </table>
      </section>

    </div>
  </section>
@endsection
