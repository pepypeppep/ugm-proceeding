<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /**
     * Guarded attribute
     * @var array
     */
    protected $guarded = ['id'];

    /*RELATIONSHIP SECTION*/

    public function author(){
        return $this->belongsToMany('App\User');
    }

    /*CUSTOM METHOD*/

    /**
     * Upload a file and update File coloumn with file path value
     * @param  request()->file('file') $file File method form request()
     * @return string
     */
    public function uploadAndUpdateFile($file)
    {
      $path = $file->store('books', 'local');

      return $this->update(['file' => $path]);
    }
}
