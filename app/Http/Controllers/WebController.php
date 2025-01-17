<?php

namespace App\Http\Controllers;

use App\Models\BloodGroup;
use App\Models\Daira;
use App\Models\User;
use App\Models\Wilaya;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class WebController extends Controller
{

    /**
     * Home page
     *
     */
    public function homePage()
    {
        return view('pages.home');
    }

    /**
     * Donors page
     *
     */
    public function donorsPage()
    {
        return view('pages.donors');
    }

    /**
     * donors search page
     *
     */
    public function donorsSearch(Request $request)
    {
        $validated = validator($request->all(), [
            'blood_group' => ['required', 'exists:blood_groups,id'],
            'wilaya' => ['required', 'exists:wilayas,id'],
            'daira' => ['required', 'exists:dairas,id'],
        ])->validate();

        // Get Blood-group, Wilaya and Daira names to be shown on front end
        $searchedBloodGroup = BloodGroup::select('bloodGroup')->find($validated['blood_group'])->bloodGroup;
        $searchedWilaya = Wilaya::select(LaravelLocalization::getCurrentLocale() === 'ar' ? 'arName as name' : 'name')->find($validated['wilaya'])->name;
        $searchedDaira = Daira::select(LaravelLocalization::getCurrentLocale() === 'ar' ? 'arName as name' : 'name')->find($validated['daira'])->name;

        $donors = User::select('phone')
            ->where('blood_group_id', $validated['blood_group'])
            ->where('wilaya_id', $validated['wilaya'])
            ->where('daira_id', $validated['daira'])
            ->where('readyToGive', 1)
            ->inRandomOrder()
            ->paginate(10);


        $data = [
            "searchedBloodGroup" => $searchedBloodGroup,
            "searchedWilaya" => $searchedWilaya,
            "searchedDaira" => $searchedDaira,
            "donors" => $donors,
        ];
        return view('pages.donors', $data);
    }

    /**
     * about page
     *
     */
    public function aboutPage()
    {
        return view('pages.about');
    }

    /**
     * user dashboard
     *
     */
    public function dashboard()
    {
        return view('pages.dashboards.user');
    }

}
