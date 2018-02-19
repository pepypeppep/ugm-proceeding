<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ReadyToPublish implements Rule
{
    public $message = [];

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
        $proceeding = Proceeding::find($value);

        $checklist = $this->checkList($proceeding);

        return;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }

    public function checkList()
    {
        
    }

    public function checkArticles()
    {
        
    }

    public function checkIdentifiers()
    {
        
    }

    public function setMessage($field, $message)
    {
        $this->message[$field] = $message;
    }
}
