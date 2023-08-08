<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Major;

class MajorController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $majors = Major::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->latest('updated_at') // Sắp xếp theo thứ tự mới đến cũ
            ->paginate(5); // Hiển thị 5 dòng trên mỗi trang
    
        return view('admin.majors.index', compact('majors', 'search'));
    }
    


    public function create()
    {
        return view('admin.majors.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255|unique:majors',
        ]);

        Major::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.majors.index')->with('success', 'Major created successfully.');
    }

    public function edit(Major $major)
    {
        return view('admin.majors.edit', compact('major'));
    }

    public function update(Request $request, Major $major)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255|unique:majors,name,' . $major->id,
        ]);

        $major->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.majors.index')->with('success', 'Major updated successfully.');
    }

    public function destroy(Major $major)
    {
        $major->delete();
        return redirect()->route('admin.majors.index')->with('success', 'Major deleted successfully.');
    }
}
