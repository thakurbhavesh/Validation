# Install Command

composer require wixel/gump


Uses


$gump = new GUMP();

// set validation rules
$gump->validation_rules([
    'username'    => 'required|alpha_numeric|max_len,100|min_len,6',
    'password'    => 'required|max_len,100|min_len,6',
    'email'       => 'required|valid_email',
    'gender'      => 'required|exact_len,1|contains,m;f',
    'credit_card' => 'required|valid_cc'
]);

// set field-rule specific error messages
$gump->set_fields_error_messages([
    'username'      => ['required' => 'Fill the Username field please, its required.'],
    'credit_card'   => ['extension' => 'Please enter a valid credit card.']
]);

// set filter rules
$gump->filter_rules([
    'username' => 'trim|sanitize_string',
    'password' => 'trim',
    'email'    => 'trim|sanitize_email',
    'gender'   => 'trim',
    'bio'      => 'noise_words'
]);

// on success: returns array with same input structure, but after filters have run
// on error: returns false
$valid_data = $gump->run($_POST);

if ($gump->errors()) {
    var_dump($gump->get_readable_errors()); // ['Field <span class="gump-field">Somefield</span> is required.'] 
    // or
    var_dump($gump->get_errors_array()); // ['field' => 'Field Somefield is required']
} else {
    var_dump($valid_data);
}
