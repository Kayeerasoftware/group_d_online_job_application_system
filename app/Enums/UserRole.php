<?php

namespace App\Enums;

enum UserRole: string
{
    case Seeker = 'seeker';
    case Employer = 'employer';
    case Admin = 'admin';
    case Regulator = 'regulator';
}
