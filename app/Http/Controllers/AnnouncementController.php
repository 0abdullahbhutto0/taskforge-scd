<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\User;
use App\Models\ManagerEmployeeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole() === 'Employee') {
            $managerIds = ManagerEmployeeModel::where('employee_id', $user->id)->pluck('manager_id')->toArray();
            $adminIds = User::whereHas('roles', function($q) { $q->where('name', 'Admin'); })->pluck('id')->toArray();
            
            $allowedIds = array_unique(array_merge($managerIds, $adminIds));
            
            $announcements = Announcement::whereIn('created_by', $allowedIds)->with('creator')->latest()->simplePaginate(3);
            return view('announcements.index', ['announcements' => $announcements]);
        } elseif ($user->hasRole() === 'Admin') {
            $adminIds = User::whereHas('roles', function($q) { $q->where('name', 'Admin'); })->pluck('id')->toArray();
            $managerIds = User::whereHas('roles', function($q) { $q->where('name', 'Manager'); })->pluck('id')->toArray();

            $publicAnnouncements = Announcement::whereIn('created_by', $adminIds)->with('creator')->latest()->simplePaginate(3, ['*'], 'public_page');
            $teamAnnouncements = Announcement::whereIn('created_by', $managerIds)->with('creator')->latest()->simplePaginate(3, ['*'], 'team_page');

            return view('announcements.index', [
                'publicAnnouncements' => $publicAnnouncements,
                'teamAnnouncements' => $teamAnnouncements
            ]);
        } else {
            $announcements = Announcement::with('creator')->latest()->simplePaginate(3);
            return view('announcements.index', ['announcements' => $announcements]);
        }
    }

    public function create()
    {
        Auth::user();
        if(Auth::user()->hasRole() !== 'Admin' && Auth::user()->hasRole() !== 'Manager') {
            abort(403, 'Unauthorized action.');
        }
        return view('announcements.create');
    }

    public function store(Request $request)
    {
        Auth::user();
        if(Auth::user()->hasRole() !== 'Admin' && Auth::user()->hasRole() !== 'Manager') {
            abort(403, 'Unauthorized action.');
        }else{
            $attributes = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
        ]);

        Announcement::create([
            'title' => $attributes['title'],
            'content' => $attributes['content'],
            'created_by' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Announcement created successfully');
        }
    }

    public function destroy($id)
    {
        $announcement = Announcement::findOrFail($id);
        $announcement->delete();
        
        return redirect()->back()->with('success', 'Announcement deleted successfully');
    }
}
