<?php

class UpdateCategoryRequest extends FormRequest {
public function authorize() {
return true;
}public function rules() {
$id = $this->route('category');
return [
'name' =>
"required|string|unique:categories,name,{$id}"
];
}
}
