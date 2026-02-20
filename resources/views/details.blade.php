@extends('layouts.default')

@section('header')
  <h2>- Poll details -</h2>
  <button class="btn btn-small" onclick="window.location='{{ url('/') }}'">Back</button>
@endsection

@section('maincontent')
  <div>
    <h2>
      {{ $poll->label }}
    </h2>
  </div>

  <div>
    <canvas id="myChart"></canvas>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: @json($poll->pollOptions->pluck('text')),
        datasets: [{
          label: '# of Votes',
          data: @json($poll->pollOptions->pluck('votes_count')),
          backgroundColor: '#546e7a',
          borderColor: 'rgba(54, 162, 235, 1)',
          borderWidth: 1,
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              stepSize: 1,
              font: {
                weight: 'bold',
                size: 16
              }
            }
          },
          x: {
            ticks: {
              font: {
                weight: 'bold',
                size: 16
              }
            }
          }
        }
      }
    });
  </script>
@endsection
