<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MailchimpController extends Controller
{
private $mailchimp;

public function __construct(\Mailchimp $mailchimp)
{
  $this->mailchimp = $mailchimp;
}

public function handle(Request $request)
{
  $email = $request->get('email');
  $this->mailchimp->lists->subscribe(
      env('MAILCHIMP_LIST_ID'),
      ['email' => $email],
      null,
      null,
      false
  );

}
}
