<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Person;
use App\Http\Requests\CourseFormRequest;
use App\Services\CourseService;

class CourseController extends Controller
{
    protected CourseService $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    public function index(CourseFormRequest $request)
    {
        $this->logAction("Viewed Courses", "index", "Course");

        $filters = ['search' => $request->search];
        $sort = [
            'field' => $request->get('sort', 'title'),
            'direction' => $request->get('direction', 'asc')
        ];

        $courses = $this->courseService->getCourses($filters, $sort);
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        $this->logAction("Create Course", "create", "Course");
        $instructors = Person::all();
        return view('courses.create', compact('instructors'));
    }

    public function store(CourseFormRequest $request)
    {
        $this->logAction("Store Course", "store", "Course");
        $validatedData = $request->validated();

        try {
            $course = $this->courseService->createCourse($validatedData);
            return redirect()->route('course.show', $course)->with('success', 'Course created successfully.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Failed to create course: ' . $e->getMessage());
        }
    }

    public function show(Course $course)
    {
        $this->logAction("View Course", "show", "Course", $course->id);
        return view('courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        $this->logAction("Edit Course", "edit", "Course", $course->id);
        $instructors = Person::all();
        return view('courses.edit', compact('course', 'instructors'));
    }

    public function update(CourseFormRequest $request, Course $course)
    {
        $this->logAction("Update Course", "update", "Course", $course->id);
        $validatedData = $request->validated();

        try {
            $course = $this->courseService->updateCourse($course, $validatedData);
            return redirect()->route('course.show', $course)->with('success', 'Course updated successfully.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Failed to update course: ' . $e->getMessage());
        }
    }

    public function destroy(Course $course)
    {
        $this->logAction("Delete Course", "destroy", "Course", $course->id);
        try {
            $this->courseService->deleteCourse($course);
            return redirect()->route('course.index')->with('success', 'Course deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete course: ' . $e->getMessage());
        }
    }
}
