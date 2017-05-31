@extends('dashboard.base')

@section('body')
<div class="section">
	<div class="form-col">
		<div class="section-title">Assign A Trainer</div>
		<div class="section-body">
			<a href="{{ route('assigned.trainer.index') }}">
  				<button class="btn btn-active">Assigned Trainer view</button>
		   </a>
		    <form action="{{ route('assign.trainer.store') }}" method="POST" >
				<div class="form-group">
					<label class="control-label">Select course</label>
					<select name="course_id" id="course" class="select2">
						<option>--Select Course--</option>
						@foreach($courses as $course)
						@if($course->status == 3)
						<option value="{{$course->course_id}}">{{$course->course_name}}</option>
						@endif
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label class="control-label" disable>Select Unit</label>
					<select name="unit" id="unit" class="select2">
						<option value="">--Course Unit--</option>
					</select>
				</div>
				<div class="form-group">
					<label class="control-label">Select Subunit</label>
					<select name="subunit" id="submit" class="select2">
						<option value="">--Course Subunit--</option>
					</select>
				</div>
				<div class="form-group">
					<label class="control-label">Start date</label>
					<input type="date" id="startDate" name="class_startDate" class="form-control" placeholder="">
				</div>
				<div class="form-group">
					<label class="control-label">End date</label>
					<input type="date" id="endDate" name="class_endDate" class="form-control" placeholder="">
				</div>
				<div class="form-group">
					<label class="control-label">Select Trainer</label>
					<select name="trainer_id" class="select2" >
						<option>--Select Trainer--</option>
						@foreach($users as $user)
						<option value="{{$user->userId}}">{{$user->firstName}} {{$user->lastName}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group" style="text-align: left;">
			        <label class="control-label">Schedule</label>
			        <div class="container" id="fields">
	        			<div class="row">
					        <div class="col-md-4">
					            <select class="select2" name="weekday[1]" id="weekday1">
					                <option value="MONDAY">Monday</option>
					                <option value="TUESDAY">Tuesday</option>
					                <option value="WEDNESDAY">Wednesday</option>
					                <option value="THURDSAY">Thursday</option>
					                <option value="FRIDAY">Friday</option>
					                <option value="SATURDAY">Saturday</option>
					            </select>
				            </div>
				            <div class="col-md-3">
				            	<input type="time" name="class_time[1]" class="form-control" placeholder="">
							</div>
							<div class="col-md-1">
								<div id="addField" class="btn btn-primary" style="margin: 1.2em;">
									Add
								</div>
							</div>
						</div>
					</div>
		        </div>
			<input type="submit" value="Assign" class="btn btn-primary" onclick="DateCheck();" >
				{{ csrf_field() }}
			</form>

		</div>
	</div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="course_id"]').on('change', function() {
            var ID = $(this).val();
            if(ID) {
                $.ajax({
                    url: '/unit/ajax/'+ID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {

                        
                        $('select[name="unit"]').empty();
                        $('select[name="unit"]').append('<option value="">"--Course Unit--"</option>');
                        $.each(data, function(key, value) {
                            $('select[name="unit"]').append('<option value="'+ value.id +'">'+ value.heading +'</option>');
                        });

                    }
                });
            }else{
                $('select[name="unit"]').empty();
            }
        });
    });

    $(document).ready(function() {
        $('select[name="unit"]').on('change', function() {
            var ID = $(this).val();
            if(ID) {
                $.ajax({
                    url: '/subunit/ajax/'+ID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {

                        
                        $('select[name="subunit"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="subunit"]').append('<option value="'+ value.id +'">'+ value.subheading +'</option>');
                        });

                    }
                });
            }else{
                $('select[name="subunit"]').empty();
            }
        });
    });

$(document).ready(function(){
	var fieldNumber = 1;
    $("#addField").click(function(e){
    	fieldNumber += 1;
    	var newField = "<div class='row' id='field"+fieldNumber+"'><div class='col-md-4'> <select class='select2' name='weekday["+fieldNumber+"]' id='weekday"+fieldNumber+"'> <option value='monday'>Monday</option> <option value='tuesday'>Tuesday</option> <option value='wednesday'>Wednesday</option> <option value='thursday'>Thursday</option> <option value='friday'>Friday</option> <option value='saturday'>Saturday</option> </select> </div> <div class='col-md-3'>	<input type='time' name='class_time["+fieldNumber+"]' class='form-control' placeholder=''>	</div><div class='col-md-1'>	<div class='removeWeekday btn btn-danger' id='removeFieldBtn"+fieldNumber+"' style='margin: 1.2em;'>	-	</div>	</div></div>";

    	$("#fields").append(newField);
    	if(fieldNumber >= 8) {
    		$("#addField").hide();
    	}
	});  
	$(document).on('click', ".removeWeekday", function(e) {
	    var thisFieldNumber = e.target.id.charAt(e.target.id.length-1);
	    $("#field"+thisFieldNumber).remove();
	    fieldNumber -= 1;
	});
});

function DateCheck()
{
  var StartDate= document.getElementById('startDate').value;
  var EndDate= document.getElementById('endDate').value;
  var eDate = new Date(EndDate);
  var sDate = new Date(StartDate);
  if(StartDate!= '' && StartDate!= '' && sDate> eDate)
    {
    alert('End date should be greater than Start date');
    event.returnValue = false;
    }
}
</script>
@endsection