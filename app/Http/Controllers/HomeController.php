<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Tampilkan beranda publik
     */
    public function index(Request $request)
    {
        // Ambil program publik dengan pagination
        $programs = Program::public()
            ->with('categories', 'user')
            ->latest()
            ->paginate(9);
        
        // Ambil kategori untuk filter
        $categories = Category::whereHas('programs', function($query) {
            $query->where('is_public', true);
        })->get();
        
        // Statistik
        $stats = [
            'total_programs' => Program::public()->count(),
            'Berjalan_programs' => Program::public()->where('status', 'Berjalan')->count(),
            'total_categories' => $categories->count(),
        ];
        
        // Program terbaru
        $latest_programs = Program::public()
            ->with('categories')
            ->latest()
            ->take(3)
            ->get();
        
        return view('home', compact('programs', 'categories', 'stats', 'latest_programs'));
    }

    /**
     * Tampilkan detail program publik
     */
    public function showProgram(Program $program)
    {
        // Cek apakah program publik
        if (!$program->is_public) {
            abort(404);
        }
        
        // Increment views
        $program->incrementViews();
        
        // Load relations
        $program->load('categories', 'user');
        
        return view('home.program-show', compact('program'));
    }

    /**
     * Tampilkan tentang kami
     */
    public function about()
    {
        return view('about');
    }

    /**
     * Tampilkan kontak
     */
    public function contact()
    {
        return view('contact');
    }
}