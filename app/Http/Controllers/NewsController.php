<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store', 'edit', 'update', 'destroy']);
        $this->middleware('is_admin')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    public function index()
    {
        $news = News::with('user')->latest()->get();
        return view('news.index', compact('news'));
    }

    public function create()
    {
        return view('news.create');
    }

    public function store(Request $request)
    {
        Log::info('Données reçues dans NewsController::store', $request->all());

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        try {
            News::create([
                'title' => $request->title,
                'description' => $request->description,
                'user_id' => Auth::id(),
            ]);
            return redirect()->route('news.index')->with('success', 'Nouvelle ajoutée avec succès.');
        } catch (\Exception $e) {
            Log::error('Erreur dans NewsController::store', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return redirect()->back()->with('error', 'Une erreur est survenue lors de l\'ajout.')->withInput();
        }
    }

    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }

    public function edit(News $news)
    {
        return view('news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        Log::info('Données reçues dans NewsController::update', $request->all());

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        try {
            $news->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);
            return redirect()->route('news.index')->with('success', 'Nouvelle mise à jour avec succès.');
        } catch (\Exception $e) {
            Log::error('Erreur dans NewsController::update', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la mise à jour.')->withInput();
        }
    }

    public function destroy(News $news)
    {
        try {
            $news->delete();
            return redirect()->route('news.index')->with('success', 'Nouvelle supprimée avec succès.');
        } catch (\Exception $e) {
            Log::error('Erreur dans NewsController::destroy', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la suppression.');
        }
    }
}