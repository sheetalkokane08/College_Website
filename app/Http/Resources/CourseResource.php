<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'description' => $this->description,
            'credits' => $this->credits,
            'department_id' => $this->department_id,
            'faculty_id' => $this->faculty_id,
            'department' => new DepartmentResource($this->whenLoaded('department')),
            'faculty' => new FacultyResource($this->whenLoaded('faculty')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
