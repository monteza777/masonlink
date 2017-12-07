@extends('layout.master')
@section('title','MasonLink | Events List')

@section('body')

<div class=" col-md-12 well well-lg "><h3 class="text-center">
<div class="input-group">
Events List
@if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('District Secretary'))
<span class="input-group-addon">
<a href="/calendarEvents/create" class="btn btn-primary btn-sm">Add Event</a>
</span>
@endif      
</div>
</h3>

<div class="row table-responsive">
<table class="table table-bordered table-hover table-condensed">
  <thead>
    <th>No.</th>
    <th>Event Title</th>
    <th>Start Day</th>
    <th>End Day</th>
    <th>Action</th>
  </thead>
  <tbody>

  @foreach($events as $event)
    <tr class="eventid" data-eventid = "{{$event->id}}">
      <!-- <td class="text-center">{{$loop->index+1}}</td> -->
      <td>{{$event->id}}</td>
      <td>{{$event->title}}</td>
      <td>{{$event->start}}</td>
      <td>{{$event->end}}</td>
      <td>

      <ul class="list-unstyled list-inline">
          
        @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('District Secretary'))
          <li> <a href="#" class="response">{{Auth::user()->rsvps()->where('event_model_id', $event->id)->first() ? Auth::user()->rsvps()->where('event_model_id', $event->id)->first()->like == 1 ? 'You Go' : 'Go' : 'Go'}}</a>
               <a href="#" class="response">{{Auth::user()->rsvps()->where('event_model_id', $event->id)->first() ? Auth::user()->rsvps()->where('event_model_id', $event->id)->first()->like == 1 ? 'You Cant Go' : 'Can\'t Go' : 'Can\'t Go'}}</a>
          </li>
          
          <li> <a href="/calendarEvents">
           <span class="btn btn-warning btn-sm">View</span></a>
          </li>
          

          <li> <a href="{{'/calendarEvents/'.$event->id.'/edit'}}">
           <span class="btn btn-success btn-sm">Update Event</span></a>
          </li>

          <li>
           <form action="/calendarEvents/{{$event->id}}" method="post" class="form-group ">
            {{csrf_field()}}
             {{method_field('DELETE')}}
            <input type="submit" value="Delete" class="btn btn-danger btn-sm">
            </form>
          </li>
         @elseif(Auth::user()->hasRole('User'))
         <li> <a href="/calendarEvents">
           <span class="btn btn-warning btn-sm">View</span></a>
          </li>
          <li> <a href="{{'/calendarEvents/getResponse/'.$event->id.''}}">
           <span class="btn btn-primary btn-sm">Response</span></a>
          </li>

         @endif
      </ul>
      </td>
    </tr>   

   @endforeach

  </tbody>
</table>
<div class="text-center"> 
</div>
</div>
</div>
 <script>
    var token = '{{ Session::token() }}';
    var urlResponse= '{{ route('response')}}';
  </script>
  
@endsection