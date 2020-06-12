@extends('layouts.main')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"><a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Sample pages</a> <a href="#" class="current">Calendar</a></div>
    <h1>Calendar</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box widget-calendar">
          <div class="widget-title"> <span class="icon"><i class="icon-calendar"></i></span>
            <h5>Calendar</h5>
            <div class="buttons"> <a id="add-event" data-toggle="modal" href="#modal-add-event" class="btn btn-inverse btn-mini"><i class="icon-plus icon-white"></i> Add new event</a>
              <div class="modal hide" id="modal-add-event">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">×</button>
                  <h3>Add a new event</h3>
                </div>
                <div class="modal-body">
                  <p>Enter event name:</p>
                  <p>
                    <input id="event-name" type="text" />
                  </p>
                </div>
                <div class="modal-footer"> <a href="#" class="btn" data-dismiss="modal">Cancel</a> <a href="#" id="add-event-submit" class="btn btn-primary">Add event</a> </div>
              </div>
            </div>
          </div>
          <div class="widget-content">
            <div id="external-events" class="panel-right">
              <h5>Drag Events to the calander</h5>
              <div id='external-events-list'>
                <div class='fc-event'>My Event 1</div>
                <div class='fc-event'>My Event 2</div>
                <div class='fc-event'>My Event 3</div>
                <div class='fc-event'>My Event 4</div>
                <div class='fc-event'>My Event 5</div>
              </div>
              <p>
                <input type='checkbox' id='drop-remove' />
                <label for='drop-remove'>remove after drop</label>
              </p>
            </div>

            <div id='calendar'>
              
            </div>

            <div style='clear:both'></div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<script src="js/matrix.js"></script>
<script src="js/fullcalendar4.js"></script>

<script src='fullcalendar-4.4.2/packages/core/main.js'></script>
<script src='fullcalendar-4.4.2/packages/interaction/main.js'></script>
<script src='fullcalendar-4.4.2/packages/bootstrap/main.js'></script>
<script src='fullcalendar-4.4.2/packages/daygrid/main.js'></script>
<script src='fullcalendar-4.4.2/packages/timegrid/main.js'></script>
<script src='fullcalendar-4.4.2/packages/list/main.js'></script>
@endsection