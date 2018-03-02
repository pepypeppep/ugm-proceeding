<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Article extends Model
{
	use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];
    protected $touches = ['proceeding'];

    /*
    RELATIONSHIP SECTION
     */
    public function proceeding(){
    	return $this->belongsTo('App\Proceeding');
    }

    public function author(){
    	return $this->hasMany('App\Author');
    }

    public function indexation(){
        return $this->hasOne('App\Indexation');
    }

    public function identifiers(){
        return $this->morphToMany('App\Identifier', 'identifiable');
    }

    /*
    CUSTOM METHOD SECTION
     */
    public function setKeywords()
    {
        return explode(',', $this->keywords);
    }
    
    /**
     * get article's identifiers. Merged from proceeding's and article's identifier
     * @return string ISSN, ISBN, DOI
     */
    public function getIdentifiers(){
        $articleIdentifiers = $this->article_identifier()->get(['type', 'code'])->mapWithKeys(function ($item)
        {
           return [[
            'type' => $item['type'],
            'id' => $item['code'],
           ],];
        });
        
        $identifiers = collect([$this->proceeding->identifiers, $articleIdentifiers])->collapse();

        return $identifiers;
    }
     /**
      * Generate file link and type
      * @return array PDF|DOAJ|SCOPUS
      */
    public function getFile()
    {
        if ($this->indexed) {
            return [
                'type' => $this->indexation->type,
                'link' => $this->indexation->link,
            ];
        }

        return [
            'type' => 'PDF',
            'link' => Storage::url($this->file),
        ];
    }

    /**
     * Remove old file
     * @return [type] [description]
     */
    public function removeOldFile()
    {
        if (Storage::exists($this->file)) {
            Storage::delete($this->file);

            return true;
        }

        return false;
    }

    /**
     * Upload a file and update File coloumn with file path value
     * @param  request()->file('file') $file File method form request()
     * @return string
     */
    public function uploadAndUpdateFile($file)
    {
      $path = $file->store('proceedings/'.$this->proceeding_id.'/articles');

      return $this->update(['file' => $path]);
    }

    /*
    CUSTOM ATTRIBUTE SECTION
     */
    
    /**
     * get indexed attribute based on indexation existance
     * @return bool
     */
    public function getIndexedAttribute(){
        return $this->indexation()->count() == 1;
    }
        
        
}
