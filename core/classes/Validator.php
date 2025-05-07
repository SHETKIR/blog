<?php

class Validator {
    public $errors = [];
    
    protected $validatorList = ['required', 'min', 'max', 'email', 'match'];
    
    protected $data_items;
    
    protected $messages = [
        'required' => 'The :fieldname: field is required',
        'min' => 'The :fieldname: field must be at least :rulevalue: characters',
        'max' => 'The :fieldname: field must be a maximum :rulevalue: characters',
        'email' => 'The :fieldname: field must be a valid email address',
        'match' => 'The :fieldname: must matched with :rulevalue: field',
    ];
    
    public function validate($data = [], $rules = []): static {
        $this->data_items = $data;
        
        foreach ($data as $fieldname => $value) {
            if(in_array($fieldname, array_keys($rules))) {
                $this->checkValidator([
                    'fieldname' => $fieldname,
                    'value' => $value,
                    'rules' => $rules[$fieldname]
                ]);
            }
        }
        
        return $this;
    }
    
    protected function checkValidator($field): void {
        foreach($field['rules'] as $rule => $ruleValue) {
            if(in_array($rule, $this->validatorList)) {
                $isValid = call_user_func_array(callback: [$this, $rule], args: [$field['value'], $ruleValue]);
                
                if(!$isValid) {
                    $err_message = str_replace(
                        search: [':fieldname:', ':rulevalue:'],
                        replace: [$field['fieldname'], $ruleValue],
                        subject: $this->messages[$rule]
                    );
                    
                    $this->addError($field['fieldname'], $err_message);
                }
            }
        }
    }
    
    protected function addError($fieldname, $error): void {
        $this->errors[$fieldname][] = $error;
    }
    
    public function hasErrors(): bool {
        return !empty($this->errors);
    }
    
    public function listErrors($fieldname): string {
        $errorsList = '';
        
        if(isset($this->errors[$fieldname])) {
            $errorsList .= '<div class="invalid-feedback d-block" role class="list-unstyled">';
            foreach ($this->errors[$fieldname] as $errorMessage) {
                $errorsList .= "<li>{$errorMessage}</li>";
            }
            $errorsList .= "</ul></div>";
        }
        
        return $errorsList;
    }
    
    
    protected function required($value, $rulevalue): bool {
        return !empty($value);
    }
    
    protected function min($value, $rulevalue): bool {
        return stl($value) >= $rulevalue;
    }
    
    protected function max($value, $rulevalue): bool {
        return stl($value) <= $rulevalue;
    }
    
    protected function email($value, $rulevalue): mixed {
        return filter_var(value: $value, filter: FILTER_VALIDATE_EMAIL);
    }
    
    protected function match($value, $rulevalue): bool {
        return $value === $this->data_items[$rulevalue];
    }
} 