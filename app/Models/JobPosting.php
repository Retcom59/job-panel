<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobPosting extends Model
{
      // İlişkili olduğu tablo
      protected $table = 'job_postings';

    
      protected $fillable = [
          'title', 
          'description',
          'location',
          'is_active'
      ];
  
      // Varsayılan değerler
      protected $attributes = [
          'is_active' => true
      ];
}
