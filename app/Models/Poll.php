<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Poll extends Model {

protected $fillable = ['label', 'ends_at'];

  // Get data of all open polls
  public static function active() {
    return self::where('ends_at', '>', now())->latest();
  }

  // Get data of all closed polls
  public static function closed() {
    return self::where('ends_at', '<=', now())->latest();
  }   

  // Get total amount of votes per poll
  public function totalVotes() {
    return $this->pollOptions()->sum('votes_count');
  }
  
  // Create relation between polls and poll options
  public function pollOptions(): Hasmany {
    return $this->hasMany(PollOption::class);
  }
}

