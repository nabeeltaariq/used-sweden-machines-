<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Common;
use App\EventPicture;
use Illuminate\Support\Facades\Storage;


class Events extends Controller
{
    private $common = null;

    public function __construct(Common $common)
    {
        $this->common = $common;
    }

    public function AllEvents(){
        $allEvents = Event::all();
        return view("admin.events",["events" => $allEvents]);
    }

    public function new(){
        return view("admin.eventForm");
    }

    public function Remove($eventId){
        $event = Event::find($eventId);
        $eventPictures = EventPicture::where("eventId",$event)->get();
        foreach($eventPictures as $picture){
            Storage::delete("event/$picture->pictureurl");
            $picture->delete();
        }
        Storage::delete("event/$event->featuredImage");
        $event->delete();
        return redirect("/admin/news/events/browse");
    }

    public function Edit($id){
        $event = Event::find($id);
        $eventPicture = EventPicture::where("eventId",$id)->get();
        return view("admin.editEventForm",["event"=>$event,"pictures"=>$eventPicture]);
    }

    public function DeletePictures($id,Request $request){
        if($request->input("imageToRemove") != null){
            foreach($request->input("imageToRemove") as $image){
                $image = EventPicture::find($image);
                Storage::delete("event/$image->pictureurl");
                $image->delete();
            }
        }
        $event = Event::find($id);
        $eventPicture = EventPicture::where("eventId",$id)->get();
        return view("admin.editEventForm",["event"=>$event,"pictures"=>$eventPicture]);
    }

    public function SaveChanges($id,Request $request){
        $event = Event::find($id);
        $event->eventName = $request->input("eventTitle");
        $event->eventDescription = htmlentities($request->input("description"));
        $event->dateofevent = $request->input("dateOfEvent");
        if($request->file("featuredImage") != null){
            Storage::delete("event/$event->featuredImage");
            $path = $request->file("featuredImage")->store("event");
            $filename = $this->common->SimplifiedPath($path);
            $event->featuredImage = $filename;
        }
        
        $event->save();

        if($request->file("otherImages") != null){

            foreach($request->file("otherImages") as $image){
                $path = $image->store("event");
                $filename = $this->common->SimplifiedPath($path);
                $eventPicture = new EventPicture();
                $eventPicture->eventId = $event->eventId;
                $eventPicture->pictureurl = $filename;
                $eventPicture->save();
            }

        }



        $eventPicture = EventPicture::where("eventId",$id)->get();
        return view("admin.editEventForm",["event"=>$event,"pictures"=>$eventPicture,"message" => "Event Updated Successfully"]);
    }

    public function Save(Request $request){
        $event = new Event();
        $event->eventName = $request->input("eventTitle");
        $event->eventDescription = htmlentities($request->input("description"));
        $event->dateofevent = $request->input("dateOfEvent");

        $path = $request->file("featuredImage")->store("event");
        $path = $this->common->SimplifiedPath($path);
        $event->featuredImage = $path;
        $event->save();

        if($request->file("otherImages") != null){
            foreach($request->file("otherImages") as $image){
                $path = $image->store("event");
                $path = $this->common->SimplifiedPath($path);
                $eventPicture = new EventPicture();
                $eventPicture->pictureurl = $path;
                $eventPicture->eventId = $event->eventId;
                $eventPicture->save();
            }
        }

        return view("admin.eventForm",["message" => "Event Saved Successfully"]);

    }
}
