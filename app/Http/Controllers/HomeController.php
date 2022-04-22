<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;
use Validator;
use Session;
use ImageResize;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect()->route('dashboard');
    }

    /** Lead List */
    public function dashboard()
    {
       
        if (auth()->user()->is_admin == 0) {
            $data = Lead::select('leads.*')
            ->leftJoin('users', 'users.id', '=', 'leads.user_id')
            ->where('is_admin', '!=', 1)
            ->limit(100)
            ->get();
        }
        else
        {
            $data = Lead::paginate(100);
        }
        return view('leads_list', compact('data'));
    }

    /** Add edit Form */
    public function addEditForm(Request $request)
    {

        if ($request->id) {
            $data['editLead'] = Lead::select('*')->where('id', $request->id)->first();
            return view('leads_form', compact('data'));
        }
        else
        {
            return view('leads_form');
        }
        
    }

    /** Lead Store or Update */
    public function store(Request $request)
    {
        if (!empty($request->lead_id)) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:50',
                'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
                'phone' => 'required|max:20',
            ]);
        }
        else{
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:50',
                'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
                'phone' => 'required|max:20',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);     
        }


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        /** Check Email exist */
        if (!empty($request->email)) {
            
            $checkExist = Lead::where('email', $request->email)->where('id', '!=', $request->lead_id)->count();
            
            if ($checkExist > 0) {
                Session::flash('message', 'Email already exist');
                Session::flash('alert-class', 'error');
                return redirect()->back();
            }
        }
        /** End check  */

        /** File upload */
        $fileName = '';
        if (!empty($request->file('image'))) {
            $file1 = $request->image;
            $data1 = "lead" . time() . "1.jpeg";
            $path1 = public_path('images/uploads/leads') . '/' . $data1;
            $base64Image1 = file_get_contents($file1);
            ImageResize::make($base64Image1)->save($path1);
        }
        /** End file */

        /** Edit form submit */
        if (!empty($request->lead_id)) {
            /** UPDATE */
            $lead = Lead::find($request->lead_id);
            $lead->name = $request->name;
            if (!empty($request->file('image'))) {
                $lead->image = $data1;
            }
            $lead->email = $request->email;
            $lead->phone = $request->phone;
            $lead->address = $request->address;
            $lead->notes = $request->notes;
            $lead->save();

            Session::flash('message', 'Updated Successfully!');
            Session::flash('alert-class', 'success');
            return redirect()->back();
        } else {
            /** add */
            $lead = new Lead();
            $lead->name = $request->name;
            $lead->email = $request->email;
            $lead->phone = $request->phone;
            $lead->address = $request->address;
            $lead->notes = $request->notes;
            $lead->image = $data1;
            $lead->user_id = auth()->user()->id;
            $lead->save();
            Session::flash('message', 'Added Successfully!');
            Session::flash('alert-class', 'success');
            return redirect()->back();
        }
    }

    /** Lead view */
    public function view(Request $request)
    {
        $data['editLead'] = Lead::select('*')->where('id', $request->id)->first();
        return view('lead_view', compact('data'));
    }

    public function delete(Request $request)
    {
        $lead = Lead::where('id',$request->id);
        $lead->delete();
        Session::flash('message', 'Deleted Successfully!');
        Session::flash('alert-class', 'success');
        return redirect('dashboard');
    }
}
