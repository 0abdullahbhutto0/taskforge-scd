<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::with('creator')->latest()->simplePaginate(3); //Pagination task
        return view('announcements.index', ['announcements' => $announcements]);
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
