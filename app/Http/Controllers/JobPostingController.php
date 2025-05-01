<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobPosting;

class JobPostingController extends Controller
{
    //Ilanları listeleme
    public function index(Request $request)
    {
        $query = JobPosting::query();
    
        if ($request->filled('is_active')) {
            $query->where('is_active', $request->input('is_active'));
        }
    
        $jobPostings = $query->latest()->get();
    
        return view('job_postings.index', compact('jobPostings'));
    }

    // Yeni ilan formu gosterme    
    public function create()
    {
        return view('job_postings.create');
    }

    //Yeni ilanı kaydetme
    public function store(Request $request)
    {
        // 1. Doğrulama
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            //'is_active' => 'sometimes|boolean',  // << burada "nullable" yerine "sometimes"
        ]);
    
        // 2. Kaydet
        JobPosting::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'location' => $validated['location'],
            'is_active' => $request->boolean('is_active') // checkbox işaretli mi
            
        ]);

    
        // 3. Listeye yönlendir
        return redirect()->route('job-postings.index')->with('success', 'İlan başarıyla eklendi.');
       
    }

    // Belirli bir ilanı gösterme.
    public function show(string $id)
    {
        $jobPosting = JobPosting::findOrFail($id);
        return view('job_postings.show', compact('jobPosting'));
    }

    // Ilan duzenleme formu 
    public function edit(JobPosting $jobPosting)
    {
        return view('job_postings.edit', compact('jobPosting'));
    }

    // Guncellenen ilanı kaydetme  
    public function update(Request $request, JobPosting $jobPosting)
    {
        $validated = $request->validate([
          'title' => 'required|string|max:255',
          'description' => 'required|string',
          'location' => 'required|string|max:255',
           // 'is_active' => 'boolean',
        ]);

         // Checkbox işaretlenmediyse false gönder
         $validated['is_active'] = $request->has('is_active');

         $jobPosting->update($validated);

        return redirect()->route('job-postings.index')->with('success', 'İlan güncellendi!');
    }

    //Ilan çöp kutusuna taşı
   
    public function destroy(string $id)
    {
        $jobPosting = JobPosting::findOrFail($id);
        $jobPosting->delete(); // Soft delete yapılır

        return redirect()->route('job-postings.index')->with('success', 'İlan silindi (soft delete).');
    }


    //soft delete

    public function trash()
    {
        // Soft delete yapılmış ilanlar
        $jobPostings = JobPosting::onlyTrashed()->get();
    
        return view('job_postings.trash', compact('jobPostings'));
    }
        
    public function restore($id)
    {
        $jobPosting = JobPosting::onlyTrashed()->findOrFail($id);
            $jobPosting->restore();
    
        return redirect()->route('job-postings.trash')->with('success', 'İlan başarıyla geri yüklendi!');
    }

    
    public function forceDelete($id)
    {
        $jobPosting = JobPosting::onlyTrashed()->findOrFail($id);
            $jobPosting->forceDelete();
    
        return redirect()->route('job-postings.trash')->with('success', 'İlan kalıcı olarak silindi!');
    }
}
