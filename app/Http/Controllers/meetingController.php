<?php


namespace App\Http\Controllers;
use App\meeting_reports;
use Illuminate\Http\Request;
use PDF;
use Session;


class meetingController extends Controller
{
    public function uoindex()
    {

        $search = \Request::get('search');
        $reportsLists = meeting_reports::where([
            ['official','=','0'],
            ['report_title', 'like', '%'.$search.'%'],
            ])
        ->orderBy('created_at','desc')
        ->paginate(10);
        $meetingOnlyTrashed = meeting_reports::onlyTrashed()->get();

        $data = [
            'reportsLists' => $reportsLists,
            'meetingOnlyTrashed' => $meetingOnlyTrashed,
        ];
        return view('meeting.unofficial_index_meeting_report')->with($data);
    }

    public function uocreate(){

        return view('meeting.unofficial_create_meeting_report');

    }
    
    public function uostore(Request $request)
    {
         // $resource = financial_report::create($request->all());

         $this->validate($request,
            [
            'rep_content'=>'required|max:10000',
            'rep_title'=>'required'
            
            ]);

        $rContent = $request['rep_content'];
        $rTitle = $request['rep_title'];
        $repId = $request['id'];


        $mReport = new meeting_reports();
        // db -> FORM NAME
        $mReport->report_content=$rContent;
        $mReport->report_title=$rTitle;
        $mReport->official=0;
        $mReport->save();
        Session::flash('success','The Meeting Report was successfully saved!!');
        // return redirect()->route('finanReportShow', $resource->id);
        return redirect()->route('meetingController');

    }

    public function deleteUo($id){
        $meeting = meeting_reports::find($id);
        $meeting->delete();
        return redirect()->route('meetingController');
    }

    ///////////// end of Unofficial Report //////
    public function edit($id)
    {
        $mReport = meeting_reports::find($id);
        return view('meeting.edit_meeting_report',compact('mReport'));
    }

    public function update(Request $request, $id)
    {
        $mReportUpdate = meeting_reports::find($id);
        $rContent = $request['rContent'];
        $rTitle = $request['rTitle'];

        $mReportUpdate->report_title = $rTitle;
        $mReportUpdate->report_content = $rContent;
      
        $mReportUpdate->save();
        Session::flash('updated','The Meeting Report has been updated!!');

        if($mReportUpdate->official == 1){
        return redirect()->route('meetingControllerOr');
        }else{
        return redirect()->route('meetingController');
        }

    }

    public function destroy($id) {
        $flight = meeting_reports::where('id', $id)->forcedelete();
        Session::flash('destroy','The Meeting Report has been deleted!');
        return redirect()->route('meetingController');
    }

    public function show($id){

        $showReport = meeting_reports::find($id);
        return view('meeting.show_meeting_report',compact('showReport'));
    }

    public function showSoftDelete($id){

        $showReport = meeting_reports::withTrashed()->find($id);
        return view('meeting.show_meeting_report',compact('showReport'));
    }

    public function pdf($id){

        $showReport = meeting_reports::find($id);
        $pdf = PDF::loadView('meeting.pdf_meeting_report',compact('showReport'));
        return $pdf->download('Meeting_Report.pdf');
    }


   public function indexmeetingOr()
    {
        $search = \Request::get('search');
        $reportsLists = meeting_reports::where([
            ['official','=','1'],
            ['report_title', 'like', '%'.$search.'%'],
            ])
        ->orderBy('created_at','desc')
        ->paginate(2);

        $meetingOnlyTrashed = meeting_reports::onlyTrashed()->get()
                            ->where('official','1');

        $data = [
            'reportsLists' => $reportsLists,
            'meetingOnlyTrashed' => $meetingOnlyTrashed,
        ];
        return view('meeting.official_index_meeting_report')->with($data);
    }

    public function officialcreate(){
        return view('meeting.official_create_meeting_report');
    }

    public function officialstore(Request $request)
    {
         // $resource = financial_report::create($request->all());

         $this->validate($request,
            [
            'rep_content'=>'required|max:10000',
            'rep_title'=>'required'
            
            ]);

        $rContent = $request['rep_content'];
        $rTitle = $request['rep_title'];
        $repId = $request['id'];


        $mReport = new meeting_reports();
        // db -> FORM NAME
        $mReport->report_content=$rContent;
        $mReport->report_title=$rTitle;
        $mReport->official=1;
        $mReport->save();
        Session::flash('success','The Meeting Report was successfully saved!!');
        // return redirect()->route('finanReportShow', $resource->id);
        return redirect()->route('meetingControllerOr');

    }
    public function archive($id){
        $meeting = meeting_reports::find($id);
        $meeting->delete();
        Session::flash('archived','The Meeting Report has been archived!!');
        return redirect()->route('meetingControllerOr');
    }
    
    public function trashes(){
        $reportsLists = meeting_reports::onlyTrashed()->get()
        ->where('official','1');
        return view('meeting.trash_meeting_reports',compact('reportsLists'));
    }

    public function restore($id){
        meeting_reports::withTrashed()->find($id)->restore();
        return redirect()->route('meetingControllerOr');
    }
    public function restoreall(){
        meeting_reports::onlyTrashed()->restore();
        return redirect()->route('meetingControllerOr');
    }
}
