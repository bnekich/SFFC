<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Course;
use App\Http\Requests\CourseFormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class CourseService
{
    public function getCourses(array $filters = [], array $sort = []): LengthAwarePaginator
    {
        $query = Course::query();

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->join('persons', 'courses.instructor_id', '=', 'persons.id');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                    ->orWhere('first_name', 'like', "%$search%")
                    ->orWhere('last_name', 'like', "%$search%");
            });
        }

        $sort['field'] = $sort['field'] ?? 'title';
        $sort['direction'] = $sort['direction'] ?? 'asc';
        $query->orderBy($sort['field'], $sort['direction']);

        return $query->paginate(10);
    }

    public function createCourse(array $data): Course
    {
        return DB::transaction(function () use ($data) {
            return Course::create([
                'title' => $data['title'],
                'instructor_id' => $data['instructor_id'],
                'created_by' => auth()->id(),
                'updated_by' => auth()->id(),
            ]);
        });
    }

    public function updateCourse(Course $course, array $data): Course
    {
        return DB::transaction(function () use ($course, $data) {
            $course->update([
                'title' => $data['title'],
                'instructor_id' => $data['instructor_id'],
                'updated_by' => auth()->id(),
            ]);

            return $course;
        });
    }

    public function deleteCourse(Course $course): void
    {
        DB::transaction(function () use ($course) {
            $course->delete();
        });
    }
}
