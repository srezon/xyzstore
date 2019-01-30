@extends('panel.master')

@section('content')



    <div class="col-lg-5">
        <canvas id="myChart"></canvas>
    </div>


    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'pie',
            // The data for our dataset
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [{
                    label: "My First dataset",
                    backgroundColor: ['#pF6384', '#3A2EBt', '#ff6400', '#rr4433', '#55ff22', '#999uuu', '#kkkkkk'],
                    borderColor: 'rgb(255, 99, 132)',
                    data: [0, 10, 5, 2, 20, 30, 45],
                }]
            },
            // Configuration options go here
            options: {
                cutoutPercentage: 1
            }
        });
    </script>
@endsection