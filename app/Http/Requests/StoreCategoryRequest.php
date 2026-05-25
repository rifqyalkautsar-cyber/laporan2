<?php
class StoreCategoryRequest extends FormRequest {
public function authorize() {
return true;
}public function rules() {
return [
'name' => 'required|string|unique:categories,name'
];
}public function messages() {
return [
'name.unique' => 'Nama kategori sudah ada.'
];
}
}
 