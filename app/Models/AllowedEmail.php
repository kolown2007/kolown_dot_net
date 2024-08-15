<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllowedEmail extends Model
{
    use HasFactory;

      // Specify the table name if it's not the plural form of the model name
      protected $table = 'allowed_emails';

      // Define the fillable attributes
      protected $fillable = ['email'];
}
