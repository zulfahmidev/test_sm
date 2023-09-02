<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApproverController extends Controller
{
    public function index(Request $request) {
        $approvers = User::where(function($query) use ($request) {
            if ($search = $request->search) {
                $query->orWhere('fullname', 'LIKE', "%$search%");
                $query->orWhere('username', 'LIKE', "%$search%");
            }
        })
        ->where('role', 'approver')
        ->latest()->paginate(10);

        return view('approver.index', compact('approvers'));
    }

    public function show(User $approver) {

        return view('approver.show', compact('approver'));
    }

    public function create() {
        return view('approver.create');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'fullname' => 'required|string',
            'position' => 'required|string',
            'username' => ['required', 'string', 'max:255', 'unique:users,username', 'alpha_dash'],
            'password' => 'required',
        ]);
        
        User::create([
            'fullname' => strtolower(trim($request->fullname)),
            'position' => strtolower(trim($request->position)),
            'username' => strtolower(trim($request->username)),
            'password' => Hash::make(trim($request->password)),
            'role' => 'approver',
        ]);

        return redirect()->route('approver.index');
    }

    public function edit(User $approver) {
        return view('approver.edit', compact('approver'));   
    }

    public function update(Request $request, User $approver) {
        $this->validate($request, [
            'fullname' => 'required|string',
            'position' => 'required|string',
            'username' => ['required', 'string', 'max:255', 'unique:users,username,'.$approver->id, 'alpha_dash'],
        ]);
        
        $approver->update([
            'fullname' => strtolower(trim($request->fullname)),
            'position' => strtolower(trim($request->position)),
            'username' => strtolower(trim($request->username)),
            'role' => 'approver',
        ]);
        if ($request->password) {
            $approver->update([
                'password' => Hash::make(trim($request->password))
            ]);
        }

        return redirect()->route('approver.index');
    }

    public function destroy(User $approver) {
        $approver->delete();

        return redirect()->route('approver.index');
    }
}
