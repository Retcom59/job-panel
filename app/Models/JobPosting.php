<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobPosting extends Model
{
    use SoftDeletes; //soft delete özelliği

      // İlişkili olduğu tablo
      protected $table = 'job_postings';

      // Toplu atamaya açık alanlar (PDF'de istenen)
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
