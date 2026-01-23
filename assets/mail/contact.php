<?php
if (!$_POST) exit;

// Simple email validation
function isEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Get form data
$name     = trim($_POST['name']);
$email    = trim($_POST['email']);
$phone    = trim($_POST['phone']);
$comments = trim($_POST['comments']);

// Validate fields
if ($name == '') {
    echo json_encode(['status'=>'error','message'=>'You must enter your name.']); exit();
} 
if ($email == '') {
    echo json_encode(['status'=>'error','message'=>'You must enter email address.']); exit();
} 
if (!isEmail($email)) {
    echo json_encode(['status'=>'error','message'=>'You must enter a valid email address.']); exit();
} 
if ($phone == '') {
    echo json_encode(['status'=>'error','message'=>'Please fill all fields!']); exit();
}
if ($comments == '') {
    echo json_encode(['status'=>'error','message'=>'You must enter your comments.']); exit();
}

// Email configuration
$to      = "fahadkhan3551@gmail.com"; // your Gmail
$subject = "Portfolio Contact Form: $name";

// Email body
$body = "You have been contacted by $name.\n\n";
$body .= "Email: $email\n";
$body .= "Phone: $phone\n";
$body .= "Message:\n$comments\n";

// Headers
$headers = "From: noreply@yourdomain.com\r\n"; // Use your domain here
$headers .= "Reply-To: $email\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Send email
if (mail($to, $subject, $body, $headers)) {
    // Return JSON response for AJAX
    echo json_encode([
        'status' => 'success',
        'message' => "Thank you $name, your message has been sent successfully!"
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => "Oops! Something went wrong, please try again later."
    ]);
}
exit();
?>
