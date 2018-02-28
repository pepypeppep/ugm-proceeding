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
      $path = $file->store($this->getStorageLocation(), $this->getStorageDisk());

      return $this->update(['file' => $path]);
    }

    public function getStorageLocation()
    {
        return 'books';
    }

    public function getStorageDisk()
    {
        return 'local';
    }

    public function hasAuthor($userId = null)
    {
        if (empty($userId)) {
            return false;
        }

        return $this->author()->where('user_id', $userId)->get()->isNotEmpty();
    }
}
