@extends('layout')
@section('title')
  Attendance Register
@endsection
@section('links')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
@endsection

@section('content')
   <form method="post" enctype="multipart/form-data" action="{{ url('/attendance/post') }}">
    {{ csrf_field() }}
    <div class="row">
        <div class="form-group col-md-4"> <!-- Date input -->
          <label class="control-label" for="date">Date</label>
          <input class="form-control" id="date" name="date" placeholder="dd-mm-yyyy" type="text" required="required" />
        </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
       <h3 class="panel-title">RC Ridgeways Rotarians</h3>
      </div>
      <div class="panel-body">
         <div class="table-responsive">
          <table class="table table-bordered table-striped">
           <tr>
            <th>#</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Attendance</th>
           </tr>
           @php($counter = 1)
           @foreach($data as $row)
           <tr>
            <td>{{ $counter}}</td>
            <td>{{ $row->first_name }}</td>
            <td>{{ $row->last_name }}</td>
            <td><input type="checkbox" name="is_present[]" value="{{$row->user_id}}" data-toggle="toggle" data-on="Present" data-off="Absent"></td>
           </tr>
           @php($counter = $counter+1)
           @endforeach
          </table>
         </div>
          <div class="row">
            <div class="form-group col-md-4">
              <label for="inputGuests">No. of Guests</label>
              <input type="number" class="form-control" id="inputGuests" name="guests" required="required">
            </div>
            <div class="form-group col-md-4">
              <label for="inputMembers">No. of Members from other clubs</label>
              <input type="number" class="form-control" id="inputMembers" name="members" required="required">
            </div>
          </div>
          <div class="form-row">
            <input type="submit" class="btn btn-primary" value="Submit">
          </div>
      </div>
    </div>
  </form>
@endsection
@section('js')
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<script>
    $(document).ready(function(){
      var date_input=$('input[name="date"]'); //our date input has the name "date"
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
        format: 'dd-mm-yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
      };
      date_input.datepicker(options);
    })
</script>
@endsection

