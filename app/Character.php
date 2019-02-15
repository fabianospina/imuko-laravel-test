<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $table = 'characters';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'title', 'name', 'image', 'flat', 'description',
  ];

  /**
   * Get the nicknames records associated with the character.
   */
  public function nicknames()
  {
      return $this->hasMany('App\Nickname');
  }

  /**
   * Get the nicknames records associated with the character as string.
   */
  public function humanNicknames()
  {
      $out = [];
      foreach($this->nicknames as $nick){
        $out[] = $nick->name;
      }
      
      return json_encode($out);
  }


}
