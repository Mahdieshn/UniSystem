<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Course;
use App\Models\Professor;
use App\Models\Student;
use App\Models\Offering;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EnrollmentTest extends TestCase
{
    use RefreshDatabase; 
    public function test_student_cannot_enroll_beyond_capacity()
    {
        $this->withoutExceptionHandling(); 
        
        $course = Course::create(['name' => 'Math', 'code' => 'M1', 'unit_count' => 3]);
        $professor = Professor::create(['name' => 'Dr. Smith']);
        $student1 = Student::create(['name' => 'User 1', 'student_number' => '101']);
        $student2 = Student::create(['name' => 'User 2', 'student_number' => '102']);
        
       
        $offering = Offering::create([
            'course_id' => $course->id,
            'professor_id' => $professor->id,
            'term' => '4021',
            'capacity' => 1
        ]);

        $this->postJson('/api/enrollments', [
            'student_id' => $student1->id,
            'offering_id' => $offering->id,
        ])->assertStatus(201);

        $this->postJson('/api/enrollments', [
            'student_id' => $student2->id,
            'offering_id' => $offering->id,
        ])->assertStatus(400);
    }

    public function test_student_cannot_enroll_in_same_offering_twice()
    {
        $course = Course::create(['name' => 'Physics', 'code' => 'P1', 'unit_count' => 3]);
        $professor = Professor::create(['name' => 'Dr. Doe']);
        $student = Student::create(['name' => 'User 1', 'student_number' => '101']);
        $offering = Offering::create([
            'course_id' => $course->id,
            'professor_id' => $professor->id,
            'term' => '4021',
            'capacity' => 5
        ]);

        $this->postJson('/api/enrollments', [
            'student_id' => $student->id,
            'offering_id' => $offering->id,
        ])->assertStatus(201);

        $this->postJson('/api/enrollments', [
            'student_id' => $student->id,
            'offering_id' => $offering->id,
        ])->assertStatus(400);
    }
}