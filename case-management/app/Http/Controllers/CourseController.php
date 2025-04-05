<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Requests\CourseFormRequest;

class CourseController extends Controller
{
    public function index(CourseFormRequest $request)
    {
        $this->logAction("Viewed Courses", "index", "Course");

        $query = Course::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->join('persons', 'courses.instructor_id', '=', 'persons.id');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                    ->orWhere('first_name', 'like', "%$search%")
                    ->orWhere('last_name', 'like', "%$search%");
            });
        }

        $sort = $request->get('sort', 'title');
        $direction = $request->get('direction', 'asc');
        $query->orderBy($sort, $direction);

        $courses = $query->paginate(10);

        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseFormRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseFormRequest $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }
}
