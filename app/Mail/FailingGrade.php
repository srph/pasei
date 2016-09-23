<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use App\Grade;
use App\Subject;
use App\StudentParent;

class FailingGrade extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $student, Grade $grade, Subject $subject, StudentParent $parent)
    {
        $this->student = $student;
        $this->grade = $grade;
        // `$this->subject` is a method of `Mailable`
        $this->_subject = $subject;
        $this->parent = $parent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Pasay High School: Failing Grade Notification')
            ->view('mail.failing')
            ->with([
                'student'   => $this->student,
                'grade'     => $this->grade,
                'subject'   => $this->_subject,
                'parent'    => $this->parent
            ]);
    }
}
