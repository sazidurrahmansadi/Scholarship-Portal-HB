<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Scholarship;
use Illuminate\Http\Request;

class TenantScholarshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $scholarships = Scholarship::all();

        return view('tenant.manage_scholarships.manage_scholarships_index', [
            'scholarships' => $scholarships,
        ]);
        // dd($scholarships);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('tenant.manage_scholarships.manage_scholarships_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'scholarship_title' => 'required',
            'eligibility' => 'required',
            'amount' => 'required',
            'deadline' => 'required',
        ]);

        $scholarship = new Scholarship();


        $scholarship->tenant_id = session()->get('tenant_id');
        $scholarship->scholarship_title = $request->scholarship_title;
        $scholarship->eligibility = $request->eligibility;
        $scholarship->amount = $request->amount;
        $scholarship->deadline = $request->deadline;
        $scholarship->status = "ACTIVE";
        $scholarship->save();

        // return "SUCCESS";



        return redirect()->route('manage_scholarships_index')
            ->with('success', 'Scholarship created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($scholarship_id)
    {
        $scholarship = Scholarship::find($scholarship_id);

        return View('tenant.manage_scholarships.manage_scholarships_edit',[
            'scholarship' => $scholarship,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'scholarship_title' => 'required',
            'eligibility' => 'required',
            'amount' => 'required',
            'deadline' => 'required',
        ]);

        $scholarship = Scholarship::find($request->scholarship_id);

        $scholarship->scholarship_title = $request->scholarship_title;
        $scholarship->eligibility = $request->eligibility;
        $scholarship->amount = $request->amount;
        $scholarship->deadline = $request->deadline;
        // $scholarship->status = "ACTIVE";
        $scholarship->save();

        return redirect()->route('manage_scholarships_index')
            ->with('success', 'Scholarship created successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $validated = $request->validate([
            'scholarship_id_d' => 'required',
        ]);

        $scholarship_id = $request->scholarship_id_d;
        $scholarship =  TenantScholarship::find($scholarship_id);
        $scholarship->delete();

        return back()->with('success', 'Status Changed Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request)
    {
        $validated = $request->validate([
            'scholarship_id_u' => 'required',
        ]);

        $scholarship_id = $request->scholarship_id_u;
        $scholarship =  TenantScholarship::find($scholarship_id);

        if ($scholarship->status == "ACTIVE") {
            $scholarship->status = "INACTIVE";
        } else {
            $scholarship->status = "ACTIVE";
        }
        $scholarship->save();

        return back()->with('success', 'Status Changed Successfully');
    }
}