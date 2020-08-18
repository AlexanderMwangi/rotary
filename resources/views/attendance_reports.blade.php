@extends('layout')
@section('title')
  Attendance Reports
@endsection

@section('content')

    <div class="panel panel-default">
      <div class="panel-heading">
       <h3 class="panel-title">Attendance Reports</h3>
      </div>
      <div class="panel-body">
       <div class="table-responsive">
        <table class="table table-bordered table-striped">
         <tr>
          <th>#</th>
          <th>Date</th>
          <th>Week</th>
          <th>View</th>
         </tr>
         @php($counter = 1)
         @foreach($data as $row)
         <tr>
          <td>{{ $counter}}</td>
          <td>{{ $row->date }}</td>
          <td>{{ $row->week_number }}</td>
          <td><a href="{{url('attendance/reports/'.$row->report_id)}}" class="btn btn-primary btn-xs"> View Report</a></td>
         </tr>
         @php($counter = $counter+1)
         @endforeach
        </table>
       </div>
      </div>
    </div>
@endsection
