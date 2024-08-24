<?php

return [
    ...array_fill_keys([
        'MISSING_CREDENTIALS', 'ACCOUNT_NOT_ACTIVATED', 'INSUFFICIENT_CREDIT', 'INVALID_CREDENTIALS',
        'COUNTRY_NOT_ENABLED', 'COUNTRY_NOT_ENABLED', 'TOO_MANY_RECIPIENTS', 'NOT_ENOUGH_PERMISSION_TO_LIST_ID',
        'INTERNAL_ERROR', 'INVALID_LANG', 'INVALID_VOICE', 'SUBJECT_REQUIRED', 'INVALID_MEDIA_FILE',
        'SOMETHING_IS_WRONG', 'REGISTRATION_NEEDED'], 'Message not sent'),
    'SUCCESS' => "Message added to queue",
    'INVALID_RECIPIENT' => "The :user mobile number is invalid",
    'THROTTLED' => "Identical message recently sent to the same recipient. Please try again in a few seconds",
    'INVALID_SENDER_ID' => "Invalid Sender ID. Please ensure Sender ID is no longer than 11 characters (if alphanumeric), and contains no spaces",
    'ALREADY_EXISTS' => "The resource you're trying to add already exists",
    'EMPTY_MESSAGE' => "Message is empty",
    'MISSING_REQUIRED_FIELDS' => "Some required fields are missing",
    'INVALID_SCHEDULE' => "The schedule specified is invalid. Use a unix timestamp e.g. 1429170372",
];
