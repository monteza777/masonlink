<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EventModel;
use MaddHatter\LaravelFullcalendar\Event;
use Carbon\Carbon;
use App\rsvp;
class calendarEventController extends Controller
{

    public function index(){

    $events = EventModel::all();

    foreach ($events as $eve) {

      $events[] = \Calendar::event(
      $eve->title, //event title
      $eve->allDay, //full day event
      $eve->start->format('Y/m/d H:i:s'),
      $eve->end->format('Y-m-d H:i:s'),
      $eve->id // Event ID
      );
    }

	$calendar = \Calendar::addEvents($events) //add an array with addEvents
	    ->setOptions([ //set fullcalendar options
			'firstDay' => 1
		])->setCallbacks([ //set fullcalendar callback options (will not be JSON encoded)
	        // 'viewRender' => 'function() {alert("Callbacks!");}'
	    ]); 

    	return view('calendarevents.calendarevent',compact('calendar'));
    }

    public function show(){
        $events = EventModel::paginate(10);
        return view('calendarEvents.events_list',compact('events'));
    }   

    public function create()
    {
    	return view('calendarevents.calendarCreate');
        
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
            'eventTitle'=>'required',
            'startDay'=>'required'
            ]);

        $eventTitle = $request['eventTitle'];
        $fullDay = $request['fullDay'];
        $startDay = $request['startDay'];
        $endDay = $request['endDay'];

        $events = new EventModel();
        // db -> FORM NAME
        $events->title=$eventTitle;
        $events->allday=$fullDay;
        $events->start=$startDay;
        $events->end=$endDay;
     

        $events->save();
        return redirect('/calendarEvents');
    }

 
/*    public function store(Request $request) {
    $requestData = $request->all();
    $requestData['start_time'] .= ':00';
    $requestData['end_time'] .= ':00';
    $event = new Event($requestData);
    $event->save();
	}*/



 /*	public function show(Request request, $eventId) {
    $event = Event::findOrFail($eventId);
    $startTime = $event->start->format('Y-m-d H:i');
    $endTime = $event->end->format('Y-m-d H:i');
}*/
  
    public function edit($id)
    {
         $events = EventModel::find($id);
        return view('calendarevents.calendarEdit',compact('events'));
    }

    public function destroy($id)
    {
        $events = EventModel::find($id);
        $events->delete();
        return redirect('/calendarEvents/show');
    }

    public function update(Request $request, $id)
    {
        $eventUpdate = EventModel::find($id);
        $this->validate($request,['update_title'=>'required']);

        $eventUpdate->title = $request->update_title;
        $eventUpdate->start = $request->update_start;
        $eventUpdate->end = $request->update_end;
        $eventUpdate->save();
        session()->flash('message','Updated Succesful');
        return redirect('/calendarEvents/show');
    }

    public function getResponse($id){
      $events = EventModel::find($id);
        return view('calendarevents.respondents',compact('events'));
    }

    public function actionResponse(Request $request, $id){
        $actionResponse = $request['response'];
        
        $response = EventModel::find($id);

/*        $fields = Input::get('result'); */

        $response->rsvp('go')->detach();

        if($actionResponse == 1){
          $response->rsvp('go')->attach(0);
        }
        elseif($actionResponse == 0){
          $response->rsvp('go')->attach(1);
        }

        $response->save();
        session()->flash('message','Updated Succesful');
        return redirect('/calendarEvents/show');
    }

    public function eventResponseEvent(Request $request){
        $event_id = $request['eventId'];
        $is_response = $request['isResponse'] === 'true';
        $update = false;
        $event = EventModel::find($event_id);
        if(!$event){
            return null;
        }
        $user = Auth::user();
        $go = $user->rsvps()->where('event_model_id', $event_id)->first();
        if($go){
            $already_go = $go->response;
            $update = true;
            if ($already_go == $is_response){
                $go->delete();
                return null;
            }
        } else{
            $go = new rsvp();
        }
        $go->response = $is_response;
        $go->user_id = $user->id;
        $go->event_model_id = $event->id;
        if($update){
            $go->update();
        } else{
            $go->save();
        }
        return null;
    }
}
