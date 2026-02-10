<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <title>Poll Generator</title>
  </head>

  <body>
    <main class="layout">

      <header class="header">
        <a class="btn btn--secondary btn-small" href="{{ url('/create') }}">Create new poll</a>
      </header>

      <section class="card">
        <h2 class="section-title">Active polls</h2>

        <table class="table">
          <thead>
            <tr>
              <th>
                <a
                  href="{{ request()->fullUrlWithQuery(['open_sort' => 'id', 'open_direction' => $openPollsDirection === 'asc' ? 'desc' : 'asc']) }}">ID</a>
              </th>
              <th>
                <a
                  href="{{ request()->fullUrlWithQuery(['open_sort' => 'label', 'open_direction' => $openPollsDirection === 'asc' ? 'desc' : 'asc']) }}">Title</a>
              </th>
              <th>
                <a
                  href="{{ request()->fullUrlWithQuery(['open_sort' => 'votes', 'open_direction' => $openPollsDirection === 'asc' ? 'desc' : 'asc']) }}">Votes</a>
              </th>
              <th>
                <a
                  href="{{ request()->fullUrlWithQuery(['open_sort' => 'ends_at', 'open_direction' => $openPollsDirection === 'asc' ? 'desc' : 'asc']) }}">End
                  date</a>
              </th>
            </tr>
          </thead>
          <tbody>

            {{-- Iterate through all open polls --}}
            @foreach ($openPolls as $openPoll)
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

      <section class="overview">
        <div class="overview-header">
          <a class="btn btn--secondary" href="{{ url('/history') }}">
            Previous polls
          </a>
        </div>

        <div class="overview-content">
          <section class="card card--secondary">
            <table class="table">
              <thead>
                <tr>
                  <th><a
                      href="{{ request()->fullUrlWithQuery(['closed_sort' => 'id', 'closed_direction' => $closedPollsDirection === 'asc' ? 'desc' : 'asc']) }}">ID</a>
                  </th>
                  <th><a
                      href="{{ request()->fullUrlWithQuery(['closed_sort' => 'label', 'closed_direction' => $closedPollsDirection === 'asc' ? 'desc' : 'asc']) }}">Title</a>
                  </th>
                  <th>
                    <a
                      href="{{ request()->fullUrlWithQuery(['closed_sort' => 'votes', 'closed_direction' => $closedPollsDirection === 'asc' ? 'desc' : 'asc']) }}">Votes</a>
                  </th>
                  <th><a
                      href="{{ request()->fullUrlWithQuery(['closed_sort' => 'ends_at', 'closed_direction' => $closedPollsDirection === 'asc' ? 'desc' : 'asc']) }}">End
                      date</a></th>
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
    </main>
  </body>

</html>
