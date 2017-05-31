@extends('layouts.base')

@section('body')
<script src="https://player.vimeo.com/api/player.js"></script>
<div class="container"> 
    <div class="row"> <!-- Row for video and document -->
        <div class="col-lg-7"> 
            <p class="sessionTitle">{{ $course->course_name }} — Lesson {{ $lesson->number }}</p>
            <iframe src="https://player.vimeo.com/video/76979871" width="640" height="480" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
   
        </div>
        <div class="col-lg-5">
            <div class="document-panel">
            <div class="panel panel-default">
                <div class="panel-heading">Documents and Reference links</div>
                <div class="panel-body">
                    @foreach($lessonDocuments as $lessonDocument)
                    <a href="{{ route('lesson.get_file', $lessonDocument->id) }}">
                        <img src="/images/document.png"><label>{{ $lessonDocument->title }}</label>
                    </a>
                    @endforeach
                     <div class="refer-link"><label><a href="">Reference Link</a></label></div>
                </div>
            </div>
            </div>
        </div>
    </div> <!-- End Row -->
    <div class="panel-section"> <!-- Discussion panel and Feedback panel -->
        <div class="accordion-section">
            <div class="course-accordion">
                <div class="titleRow">
                    <p class="title">Assignment</p>
                </div> 
                <div class='accordion-section'>
                </div>
            </div>
        </div>
        <div class="accordion-section">
            <div class="course-accordion">
                <div class="titleRow">
                    <p class="title">Online Exam</p>
                </div> 
                <div class='accordion-section'></div>
            </div>
        </div>
        <div class="accordion-section">
            <div class="course-accordion">
                <div class="titleRow">
                    <p class="title">Discussion</p>
                </div> 
                <div class='accordion-section'>
                    <label><i class="fa fa-user-circle"></i> Pratap Bera</label>
                    <label><i class="fa fa-envelope"></i> What is Adobe Photoshop??</label>
                    <label><i class="fa fa-clock-o"></i> 10:30 am 05/05/17</label>
                    <hr>
                    <label><i class="fa fa-user-circle"></i> Bilguun</label>
                    <label><i class="fa fa-envelope"></i> What is Adobe Photoshop??</label>
                    <label><i class="fa fa-clock-o"></i> 10:30 am 05/05/17</label>
                    <hr>
                    <form action="" method="POST">
                    <input type="text" class="form-control" name="message">
                    <button class="btn btn-success">Send</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="accordion-section">
            <div class="course-accordion">
                <div class="titleRow">
                    <p class="title">Feedback</p>
                </div> 
                <div class='accordion-section'>
                    <form action="" method="POST">
                        <div class="feedback-control">
                        <label>Was This Information Helpful?</label>
                        <input type="radio" value="1" name="information_status"><label1>Yes</label1>
                        <input type="radio" value="0" name="information_status"><label1>No</label1>
                        </div>
                        <div class="feedback-control">
                        <label>Please Type Your Suggestion</label>
                        <textarea rows="4" name="suggestion"></textarea>
                        </div>
                        <center><button class="btn btn-success">Send</button></center>
                    </form>
                </div>
            </div>
        </div>
    </div> <!-- End panel section -->
</div> <!-- End container -->
<div class="next-prev">
    <a href="#" class="previous">&laquo; Previous</a>
    <a href="#" class="next">Next &raquo;</a>
</div>

<script>
    var iframe = document.querySelector('iframe');
    var player = new Vimeo.Player(iframe);

    player.on('play', function() {
        console.log('played the video!');
    });

    player.getVideoTitle().then(function(title) {
        console.log('title:', title);
    });
</script>
@endsection