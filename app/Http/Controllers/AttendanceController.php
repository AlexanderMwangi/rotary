<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;

class AttendanceController extends Controller
{
	private function dateConverter($originalvalue)
	{

		$newvalue = date('Y-m-d', strtotime($originalvalue));
		return $newvalue;

	}
	private function percentage($numerator,$denominator)
	{
		$percentage = ($numerator/$denominator)*100;
		return round($percentage,1);
	}

	public function home()
	{
		$data = DB::table('tbl_users')->orderBy('user_id')->get();
		return view('attendance_register',compact('data'));
	}

	public function postRegister()
	{
		$date = Input::get('date');
		$date = $this->dateConverter($date);	
		$weekNo = date("W", strtotime($date));

		if(isset($_POST['is_present']))
		{
	        if (is_array($_POST['is_present'])) 
	        {
	             foreach($_POST['is_present'] as $value)
	            {
			        $insert_data[] = array(
				        'user_id'  => $value,
				        'date'   => $date,
				        'week_number'   => $weekNo
				    );
				}
				DB::table('tbl_attendances')->insert($insert_data);

				DB::table('tbl_attendance_reports')->insert(['date'=>$date,'week_number'=>$weekNo]);
				
	        } 
	        else 
	        {
	            $value = $_POST['is_present'];
	            echo "none"; 	
	       	}

	       	if(isset($_POST['guests']))
			{
				DB::table('tbl_guests')->insert(['date'=>$date,'guests'=>$_POST['guests']]);

			}

			if(isset($_POST['members']))
			{
				DB::table('tbl_other_clubs')->insert(['date'=>$date,'members'=>$_POST['members']]);
			}
	   	}

	   	return redirect('attendance/reports');
	}

	public function reports()
	{
		$data = DB::table('tbl_attendance_reports')->orderBy('report_id')->get();
		return view('attendance_reports',compact('data'));
	}

	public function dateReport($id)
	{
		$dateQuery = DB::table('tbl_attendance_reports')->where('report_id', $id)->first();
		$date = $dateQuery->date;

		$rotarians = DB::table('tbl_attendances')->where('date',$date)->count();
		$totalRotarians = DB::table('tbl_users')->count();
		$guests = DB::table('tbl_guests')->where('date',$date)->value('guests');
		$otherClubs = DB::table('tbl_other_clubs')->where('date',$date)->value('members');
		$totalAttendance = $rotarians + $guests + $otherClubs;
		$absentRotarians = $totalRotarians - $rotarians;

		$guestsPercent = $this->percentage($guests,$totalAttendance);
		$rotariansPercent = $this->percentage($rotarians,$totalAttendance);
		$otherClubsPercent = $this->percentage($otherClubs,$totalAttendance);

		$absentRotariansPercent = $this->percentage($absentRotarians,$totalRotarians);
		$presentRotariansPercent = $this->percentage($rotarians,$totalRotarians);

		return view('date_report',['rotarians'=>$rotarians,'guests'=>$guests,'otherClubs'=>$otherClubs,'date'=>$date,'otherClubsPercent'=>$otherClubsPercent,'guestsPercent'=>$guestsPercent,'rotariansPercent'=>$rotariansPercent,'totalAttendance'=>$totalAttendance,'absentRotarians'=>$absentRotarians,'absentRotariansPercent'=>$absentRotariansPercent,'presentRotariansPercent'=>$presentRotariansPercent,'totalRotarians'=>$totalRotarians]);
	}
}

