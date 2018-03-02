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

    public function identifiers(){
        return $this->morphToMany('App\Identifier', 'identifiable');
    }

    /*CUSTOM METHOD*/

    /**
     * Upload a file and update File coloumn with file path value
     * @param  request()->file('file') $file File method form request()
     * @return string
     */
    public function addFile($coloumn, $file, $disk = 'local')
    {
        return $this->update([
            $coloumn => $this->uploadFile($file, $disk),
        ]);
    }
    
    public function uploadFile($file, $disk)
    {
        $path = $file->store($this->getStorageLocation(), $this->getStorageDisk($disk));

        return $path;
    }

    public function getStorageLocation($path = '')
    {
        return 'books'.$path;
    }

    public function getStorageDisk($disk)
    {
        if (!empty($disk)) {
            return $disk;
        }
        
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
