<?php

namespace App\Rules;

use App\Proceeding;
use Illuminate\Contracts\Validation\Rule;

class ReadyToPublish implements Rule
{
    private $message;
    private $checks;


    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $checklist = $this->runChecks($value);

        return $checklist;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->getMessage();
    }

    /**
     * Run proceeding ready to publish check
     * @param  integer $proceedingId
     * @return boolean
     */
    public function runChecks($proceedingId)
    {
        $proceeding = $this->getProceeding($proceedingId);

        $check['published'] = $this->checkStatus($proceeding->status);
        $check['cover'] = $this->checkCover($proceeding->front_cover);
        $check['introduction'] = $this->checkIntroduction($proceeding->introduction);
        $check['identifiers'] = $this->checkIdentifiers($proceeding->identifiers);
        $check['articles'] = $this->checkArticles($proceeding->article);
        $check['subjects'] = $this->checkSubjects($proceeding->subject);

        return collect($check)->values()->search(false) === false;
    }

    /**
     * Get proceeding record
     * @param  integer $id
     * @return Illuminate\Database\Eloquent\Model
     */
    public function getProceeding($id)
    {
        return Proceeding::findOrFail($id);
    }

    public function checkCover($cover)
    {
        if (empty($cover)) {
            $this->setMessage('cover');

            return false;
        }

        return true;
    }

    /**
     * check proceeding status
     * @param  string $status
     * @return boolean
     */
    public function checkStatus($status)
    {
        if ($status == 'published') {
            $this->setMessage('status', 'This Proceeding has already published!');

            return false;
        }

        return true;
    }

    /**
     * Check introduction value
     * @param  string $introduction
     * @return boolean
     */
    public function checkIntroduction($introduction = null)
    {
        if (empty($introduction)) {
           $this->setMessage('introduction');

           return false;
        }

        return true;
    }

    /**
     * Check identifiers existense
     * @param  Illuminate\Support\Collection $identifiers
     * @return boolean
     */
    public function checkIdentifiers($identifiers)
    {
        if ($identifiers->where('type', 'issn')->isNotEmpty()) {
            return true;
        } elseif ($identifiers->where('type', 'print_isbn')->isNotEmpty() && $identifiers->where('type', 'online_isbn')->isNotEmpty()) {
            return true;
        }

        $this->setMessage('identifiers');

        return false;
    }

    public function checkArticles($articles)
    {
        if ($articles->isEmpty()) {
            $this->setMessage('articles');

            return false;
        }

        return true;
    }

    /**
     * Check article validation. NOT USED BY NOW
     * @param  Illuminate\Support\Collection $articles
     * @return boolean
     */
    public function checkArticlesAdvanced($articles)
    {
        $empty = collect([
            'doi' => collect(),
            'link' => collect(),
            'authors' => collect(),
        ]);

        foreach ($articles as $article) {
            if (empty($article->article_identifier->first())) {
                $empty['doi']->push($article->id);
            }

            if (!empty($article->indexation)) {
                if (empty($article->indexation->link)) {
                    $empty['link']->push($article->id);
                }
            }

            if ($article->author->isEmpty()) {
                $empty['authors']->push($article->id);
            }
        }

        $validated = true;

        foreach ($empty as $key => $value) {
            if ($value->isNotEmpty()) {
                $this->setMessage($key, $key.' on article '.$value->implode('; ').' is Empty');

                $validated = false;
            }
        }

        return $validated;
    }

    /**
     * Check proceeding at least has one subject
     * @param  Illuminate\Support\Collection $subjects
     * @return boolean
     */
    public function checkSubjects($subjects)
    {
        if ($subjects->isEmpty()) {
            $this->setMessage('Subjects');

            return false;
        }

        return true;
    }

    /**
     * set message value
     * @param string $field
     * @param string $message
     */
    public function setMessage($field, $message = null)
    {
        if (empty($message)) {
            $message = $field." is empty!";
        }

        $this->message[$field] = $message;
    }

    /**
     * get message body
     * @return string
     */
    public function getMessage()
    {
        return collect($this->message)->values()->implode('. ');
    }

}
