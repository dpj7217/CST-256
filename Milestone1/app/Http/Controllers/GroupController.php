<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Group;
use Intervention\Image\ImageManagerStatic as Image;

class GroupController extends Controller
{
    public function index() {
        return view('groups/groups', [
            'user' => \Auth::user(),
            'userGroups' => \Auth::user()->groups,
            'groups' => Group::latest()->get()
        ]);
        //TODO Attach groups based on tags of user
    }

    public function create() {
        return view('groups/create');
    }

    public function edit($group_id) {
        return view('groups/edit', [
            'group' => Group::where('id', $group_id)->first()
        ]);
    }

    public function store(Request $request) {
        request()->validate(
        //rules
        [
            'name' => ['required', 'max:255', 'unique:groups,name'],
            'bio' => ['required'],
            'profileImage' => ['required'],
            'bannerImage' => ['required']
        ],
        //messages
        [
            'name.required' => "The 'Group Name' field is required",
            'name.max' => "The 'Name' input has a max character value of 255",
            'name.unique' => "That group already exists. Try a different name",
            'bio.required' => "The 'Group Bio' field is required",
            'profileImage.required' => "The 'Profile Image' field is required",
            'bannerImage.required' => "The 'Banner Image' field is required",
        ]
        );

        $isPublic = 0;
        if (request('isPublic'))
            $isPublic = 1;

        $nameArr = explode(' ', request('name'));
        $fileName = "";
        foreach($nameArr as $part) {
            $fileName = $fileName . '_' . $part ;
        }

        $group = Group::create([
            'user_id' => \Auth::user()->id,
            'name' => request('name'),
            'bio' => request('bio'),
            'profileImage' => 'images/groups/' . $fileName . '_profileImg.jpg',
            'bannerImage' => 'images/groups/' . $fileName . '_bannerImg.jpg',
            'isPublic' => $isPublic,
            'isActive' => 1,
            'isJoinable' => 1
        ]);


        $profileImage = $request->file('profileImage');
        $profileImage = Image::make($profileImage->getRealPath());
        $profileImage->resize(100, null, function($constraint) {$constraint->aspectRatio();})->encode('jpg', 100);
        \Storage::disk('public')->put('images/groups/' . $fileName . '_profileImg.jpg', $profileImage);

        $bannerImage = $request->file('bannerImage');
        $bannerImage = Image::make($bannerImage->getRealPath());
        $bannerImage->resize(1115, null, function($constraint) {$constraint->aspectRatio();})->encode('jpg', 100);
        \Storage::disk('public')->put('images/groups/' . $fileName . '_bannerImg.jpg', $bannerImage);

        \Auth::User()->groups()->attach($group->id);

        return redirect('/groups');
    }


    public function show($group_id) {
        return view('groups/view', [
            'group' => Group::where('id', $group_id)->first(),
            'user' => \Auth::user(),
            'followers' => Group::where('id', $group_id)->first()->users
        ]);
    }


    public function change(Request $request, $group_id) {
        $group = Group::where('id', $group_id)->first();
        $group->name = "";

        $group->save();

        request()->validate(
            //rules
            [
                'name' => ['max:255', 'nullable', 'unique:groups,name'],
            ],
            //messages
            [
                'name.max' => "The 'Name' field can only have 255 characters",
                'name.unique' => "That Group name already exists. Try a different one.",
            ]
        );

        $isPublic = 0;
        if(request('isPublic'))
            $isPublic = 1;

        $group->isPublic = $isPublic;


        $group->name = request('name');
        $group->bio = request('bio');

        if(request('profileImage')) {
            $nameArr = explode(' ', request('name'));
            $fileName = "";
            foreach($nameArr as $part) {
                $fileName = $fileName . '_' . $part ;
            }

            $profileImage = $request->file('profileImage');
            $profileImage = Image::make($profileImage->getRealPath());
            $profileImage->resize(100, null, function($constraint) {$constraint->aspectRatio();})->encode('jpg', 100);
            \Storage::disk('public')->put('images/groups/' . $fileName . '_profileImg.jpg', $profileImage);
        }

        if(request('bannerImage')) {
            $nameArr = explode(' ', request('name'));
            $fileName = "";
            foreach($nameArr as $part) {
                $fileName = $fileName . '_' . $part ;
            }

            $bannerImage = $request->file('bannerImage');
            $bannerImage = Image::make($bannerImage->getRealPath());
            $bannerImage->resize(1115, null, function($constraint) {$constraint->aspectRatio();})->encode('jpg', 100);
            \Storage::disk('public')->put('images/groups/' . $fileName . '_bannerImg.jpg', $bannerImage);
        }


        $group->save();

        return redirect('/group/' . $group_id . '/view');
    }


    public function delete($group_id) {
        $group = Group::where('id', $group_id)->first();
        $group->delete();

        return redirect('/groups');
    }

    public function leave($group_id) {
        $group = Group::where('id', $group_id)->first();

        $group->users()->detach(\Auth::user()->id);

        return redirect('/groups');
    }

    public function join($group_id){
        $group = Group::where('id', $group_id)->first();

        $group->users()->attach(\Auth::user()->id);

        return redirect('/group/' . $group_id . '/view');
    }
}
