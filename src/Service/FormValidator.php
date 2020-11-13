<?php


namespace App\Service;


class FormValidator
{
    private $fields = [];

    private $errors = [];

    public function checkFields()
    {
        foreach ($this->fields as $fieldType => $value) {
            if (empty($value)) {
                $this->addError($fieldType);
            }
        }
    }

    public function addError($fieldType)
    {
        $this->errors[$fieldType] = "Il faut remplir ce champ";
    }
    
    /**
     * @return mixed
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @param mixed $fields
     * @return FormValidator
     */
    public function setFields($fields)
    {
        $this->fields = $fields;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param mixed $errors
     * @return FormValidator
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;
        return $this;
    }




}