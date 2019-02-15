<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nickname extends Model
{
    //
    /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $table = 'nicknames';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'character_id', 'name',
  ];

  /**
   * Get the character that owns to nickname.
   */
  public function character()
  {
      return $this->belongsTo('App\Character');
  }


}
