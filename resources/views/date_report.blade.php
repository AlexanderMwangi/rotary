@extends('layout')
@section('title')
  Attendance for {{$date}} 
@endsection

@section('content')

<ul class="nav nav-tabs" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#table" role="tab">Tables</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#graph" role="tab">Graphs</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active" id="table" role="tabpanel">
    <div class="panel panel-default">
          <div class="panel-heading">
           <!-- <h3 class="panel-title">Customer Data</h3> -->
          </div>
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped">
               <tr>
                <th>Total Representation</th>
                <th>Summary of Members</th>
                <th>% of attendance of the total</th>
               </tr>
               <tr>
                <td>Members in attendance</td>
                <td>{{ $rotarians }}</td>
                <td>{{ $rotariansPercent }}%</td>
               </tr>
               <tr>
                <td>Guests</td>
                <td>{{ $guests }}</td>
                <td>{{ $guestsPercent }}%</td>
               </tr>
               <tr>
                <td>Members from other Clubs</td>
                <td>{{ $otherClubs }}</td>
                <td>{{ $otherClubsPercent }}%</td>
               </tr>
               <tr>
                <td> <b> Total Attendance </b></td>
                <td> <b>{{ $totalAttendance }} </b></td>
                <td> <b>100% </b></td>
               </tr>
              </table>
            </div>
            <br>
            <h3 class="panel-title">RC RIDGEWAYS MEMBERS IN ATTENDANCE {{$date}} </h3><br>
            <div class="table-responsive">
              <table class="table table-bordered table-striped">
               <tr>
                <th>Members In Attendance</th>
                <th>Summary of Members</th>
                <th>% of attendance of the total</th>
               </tr>
               <tr>
                <td>Members in attendance</td>
                <td>{{ $rotarians }}</td>
                <td>{{ $presentRotariansPercent }}%</td>
               </tr>
               <tr>
                <td>Absent Members</td>
                <td>{{ $absentRotarians }}</td>
                <td>{{ $absentRotariansPercent }}%</td>
               </tr>
               <tr>
                <td> <b> Total RC Ridgeways Members </b></td>
                <td> <b>{{ $totalRotarians }} </b></td>
                <td> <b>100% </b></td>
               </tr>
              </table>
            </div>
          </div>
    </div>
  </div>
  <div class="tab-pane" id="graph" role="tabpanel"> 
    <div id="summary"></div>
    <br>
    <div id="ridgeways"></div>
  </div>
</div>

@endsection

@section('js')

<script>
  var rotariansPercent = {!! json_encode($rotariansPercent) !!};
  var guestsPercent = {!! json_encode($guestsPercent) !!};
  var otherClubsPercent = {!! json_encode($otherClubsPercent) !!};
  var presentRotariansPercent = {!! json_encode($presentRotariansPercent) !!};
  var absentRotariansPercent = {!! json_encode($absentRotariansPercent) !!};

  console.log(presentRotariansPercent,absentRotariansPercent);

  Highcharts.chart('summary', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Attendance Summary'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            }
        }
    },
    series: [{
        name: 'Attendance',
        colorByPoint: true,
        data: [{
            name: 'RC Ridgeways Members',
            y: rotariansPercent,
            sliced: true,
            selected: true
        }, {
            name: 'Guests',
            y: guestsPercent
        }, {
            name: 'Members from other Clubs',
            y: otherClubsPercent
        }]
    }]
});


  Highcharts.chart('ridgeways', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'RC Ridgeways Members'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            }
        }
    },
    series: [{
        name: 'Attendance',
        colorByPoint: true,
        data: [{
            name: 'Members Present',
            y: presentRotariansPercent,
        }, {
            name: 'Members Absent',
            y: absentRotariansPercent
        }]
    }]
});
            
</script>
@endsection



