<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class EventModel extends Model implements \MaddHatter\LaravelFullcalendar\Event
{

    protected $dates = ['start', 'end'];



    /**
     * Get the event's id number
     *
     * @return int
     */
    public function getId() {
		return $this->id;
	}

    /**
     * Get the event's title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Is it an all day event?
     *
     * @return bool
     */
    public function isAllDay()
    {
        return (bool)$this->allday;
    }

    /*
     * Get the start time
     *
     * @return DateTime*/
     
    public function getStart()
    {

        return $this->start;
    }

    /**
     * Get the end time
     *
     * @return DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }

    /*public function rsvp(){
        return $this->belongsToMany(rsvp::class);
    }*/

    public function users(){
        return $this->belongsTo('App\User');
    }

    public function rsvps(){
        return $this->hasMany('App\rsvp');
    }

}