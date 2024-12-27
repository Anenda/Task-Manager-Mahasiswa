<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        // Mulai dengan query dasar untuk mengambil proyek berdasarkan user yang login
        $query = Auth::user()->projects()->withCount([
            'tasks as to_do_tasks' => function ($query) {
                $query->where('status', 'to_do');
            },
            'tasks as in_progress_tasks' => function ($query) {
                $query->where('status', 'in_progress');
            },
            'tasks as completed_tasks' => function ($query) {
                $query->where('status', 'completed');
            }
        ]);

        // Jika ada parameter kategori di URL, filter proyek berdasarkan kategori tersebut
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        // Ambil hasil query yang telah disaring
        $projects = $query->get();

        // Ambil semua kategori untuk dropdown
        $categories = ['Kuliah', 'Proyek', 'Pekerjaan', 'Organisasi']; // Sesuaikan dengan kategori yang ada

        return view('projects.index', compact('projects', 'categories'));
    }

    public function create()
    {
        // Daftar kategori yang akan ditampilkan di dropdown
        $categories = ['Kuliah', 'Proyek', 'Pekerjaan', 'Organisasi'];
        return view('projects.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'status' => 'required|in:not_started,in_progress,completed',
            'budget' => 'nullable|numeric',
            'category' => 'required|string|max:255', // Validasi kategori
        ]);

        // dd($validated);

        // Simpan proyek dengan kategori yang dipilih secara eksplisit
        Auth::user()->projects()->create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'status' => $validated['status'],
            'budget' => $validated['budget'],
            'category' => $validated['category'], // Pastikan kategori tersimpan
        ]);

        // Redirect ke halaman index proyek setelah menyimpan
        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    public function show(Project $project)
    {
        // Menampilkan detail proyek beserta anggota tim
        $teamMembers = $project->users()->get();
        $users = User::all();
        return view('projects.show', compact('project', 'teamMembers', 'users'));
    }

    public function edit(Project $project)
    {
        // Daftar kategori untuk dropdown pada halaman edit
        $categories = ['Kuliah', 'Proyek', 'Pekerjaan', 'Organisasi'];
        return view('projects.edit', compact('project', 'categories'));
    }

    public function update(Request $request, Project $project)
    {
        // Validasi data yang diterima
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'status' => 'required|in:not_started,in_progress,completed',
            'budget' => 'nullable|numeric',
            'category' => 'required|string|max:255', // Validasi kategori
        ]);

        // Perbarui data proyek
        $project->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'status' => $validated['status'],
            'budget' => $validated['budget'],
            'category' => $validated['category'], // Pastikan kategori diperbarui
        ]);

        // Redirect ke halaman index proyek setelah mengupdate
        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        // Hapus proyek
        $project->delete();

        // Redirect ke halaman index proyek setelah dihapus
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }

    public function addMember(Request $request)
    {
        // Validasi input anggota tim
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'user_id' => 'required|exists:users,id',
        ]);

        // Temukan proyek dan tambahkan anggota tim
        $project = Project::find($request->project_id);
        $project->teamProjects()->attach($request->user_id);

        // Redirect kembali ke halaman sebelumnya
        return redirect()->back()->with('success', 'User added successfully.');
    }


}
