<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JobVacancy as Job;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class JobApiController extends Controller
{
	/**
	 * @OA\Get(
	 *     path="/api/public/jobs",
	 *     tags={"Jobs (Public)"},
	 *     summary="Get all job listings (Public)",
	 *     description="Retrieve paginated job listings with optional search and filters",
	 *     @OA\Parameter(
	 *         name="keyword",
	 *         in="query",
	 *         description="Search keyword (searches in title, company, location)",
	 *         required=false,
	 *         @OA\Schema(type="string", example="developer")
	 *     ),
	 *     @OA\Parameter(
	 *         name="company",
	 *         in="query",
	 *         description="Filter by company name",
	 *         required=false,
	 *         @OA\Schema(type="string", example="Google")
	 *     ),
	 *     @OA\Parameter(
	 *         name="location",
	 *         in="query",
	 *         description="Filter by location",
	 *         required=false,
	 *         @OA\Schema(type="string", example="Jakarta")
	 *     ),
	 *     @OA\Parameter(
	 *         name="page",
	 *         in="query",
	 *         description="Page number",
	 *         required=false,
	 *         @OA\Schema(type="integer", example=1)
	 *     ),
	 *     @OA\Parameter(
	 *         name="per_page",
	 *         in="query",
	 *         description="Items per page",
	 *         required=false,
	 *         @OA\Schema(type="integer", example=10)
	 *     ),
	 *     @OA\Response(
	 *         response=200,
	 *         description="Paginated list of jobs",
	 *         @OA\JsonContent(
	 *             @OA\Property(property="current_page", type="integer", example=1),
	 *             @OA\Property(property="data", type="array",
	 *                 @OA\Items(
	 *                     @OA\Property(property="id", type="integer", example=1),
	 *                     @OA\Property(property="title", type="string", example="Software Engineer"),
	 *                     @OA\Property(property="description", type="string", example="We are looking for...\"),
	 *                     @OA\Property(property="location", type="string", example="Jakarta"),
	 *                     @OA\Property(property="company", type="string", example="Tech Corp"),
	 *                     @OA\Property(property="salary", type="integer", example=10000000),
	 *                     @OA\Property(property="logo", type="string", example="logos/company.jpg"),
	 *                     @OA\Property(property="created_at", type="string", example="2025-11-25T10:00:00.000000Z")
	 *                 )
	 *             ),
	 *             @OA\Property(property="total", type="integer", example=50),
	 *             @OA\Property(property="per_page", type="integer", example=10)
	 *         )
	 *     )
	 * )
	 */
	public function index(Request $req)
{
    $q = Job::query();

    if ($req->filled('keyword')) {
        $kw = $req->input('keyword');
        $q->where(function ($s) use ($kw) {
            $s->where('title', 'like', "%{$kw}%")
              ->orWhere('company', 'like', "%{$kw}%")
              ->orWhere('location', 'like', "%{$kw}%");
        });
    }

    if ($req->filled('company')) {
        $q->where('company', 'like', "%{$req->input('company')}%");
    }

    if ($req->filled('location')) {
        $q->where('location', 'like', "%{$req->input('location')}%");
    }

    $perPage = (int) $req->get('per_page', 10);
    $jobs = $q->orderBy('created_at', 'desc')->paginate($perPage);
    return response()->json($jobs);
}

	/**
	 * @OA\Get(
	 *     path="/api/public/jobs/{id}",
	 *     tags={"Jobs (Public)"},
	 *     summary="Get job details",
	 *     description="Retrieve single job details by ID",
	 *     @OA\Parameter(
	 *         name="id",
	 *         in="path",
	 *         description="Job ID",
	 *         required=true,
	 *         @OA\Schema(type="integer", example=1)
	 *     ),
	 *     @OA\Response(
	 *         response=200,
	 *         description="Job details",
	 *         @OA\JsonContent(
	 *             @OA\Property(property="id", type="integer", example=1),
	 *             @OA\Property(property="title", type="string", example="Software Engineer"),
	 *             @OA\Property(property="description", type="string", example="Job description..."),
	 *             @OA\Property(property="location", type="string", example="Jakarta"),
	 *             @OA\Property(property="company", type="string", example="Tech Corp"),
	 *             @OA\Property(property="salary", type="integer", example=10000000),
	 *             @OA\Property(property="logo", type="string", example="logos/company.jpg")
	 *         )
	 *     ),
	 *     @OA\Response(response=404, description="Job not found")
	 * )
	 */
	public function show(Job $job)
	{return response()->json($job);}

	/**
	 * @OA\Post(
	 *     path="/api/jobs",
	 *     tags={"Jobs (Admin)"},
	 *     summary="Create new job (Admin only)",
	 *     description="Create a new job vacancy",
	 *     security={{"bearerAuth":{}}},
	 *     @OA\RequestBody(
	 *         required=true,
	 *         @OA\JsonContent(
	 *             required={"title", "description", "location", "company"},
	 *             @OA\Property(property="title", type="string", example="Software Engineer"),
	 *             @OA\Property(property="description", type="string", example="We are looking for..."),
	 *             @OA\Property(property="location", type="string", example="Jakarta"),
	 *             @OA\Property(property="company", type="string", example="Tech Corp"),
	 *             @OA\Property(property="salary", type="integer", example=10000000),
	 *             @OA\Property(property="logo", type="string", example="logos/logo.jpg")
	 *         )
	 *     ),
	 *     @OA\Response(
	 *         response=201,
	 *         description="Job created successfully",
	 *         @OA\JsonContent(
	 *             @OA\Property(property="message", type="string", example="Created"),
	 *             @OA\Property(property="job", type="object")
	 *         )
	 *     ),
	 *     @OA\Response(response=403, description="Forbidden - Admin only"),
	 *     @OA\Response(response=422, description="Validation error")
	 * )
	 */
	public function store(Request $req)
	{
		// cek role admin
		if (!$req->user() || $req->user()->role !== 'admin') {
			return response()->json(['message' => 'Forbidden'], 403);
		}
		$data = $req->validate([
			'title' => 'required|string',
			'description' => 'required|string',
			'location' => 'required|string',
			'company' => 'required|string',
			'salary' => 'nullable|integer',
			'logo' => 'nullable|string',
		]);
		$job = Job::create($data);
		return response()->json(['message' => 'Created', 'job' => $job], 201);
    }

	/**
	 * @OA\Put(
	 *     path="/api/jobs/{id}",
	 *     tags={"Jobs (Admin)"},
	 *     summary="Update job (Admin only)",
	 *     description="Update existing job details",
	 *     security={{"bearerAuth":{}}},
	 *     @OA\Parameter(
	 *         name="id",
	 *         in="path",
	 *         description="Job ID",
	 *         required=true,
	 *         @OA\Schema(type="integer", example=1)
	 *     ),
	 *     @OA\RequestBody(
	 *         required=false,
	 *         @OA\JsonContent(
	 *             @OA\Property(property="title", type="string", example="Senior Software Engineer"),
	 *             @OA\Property(property="description", type="string", example="Updated description"),
	 *             @OA\Property(property="location", type="string", example="Bandung"),
	 *             @OA\Property(property="company", type="string", example="Tech Corp"),
	 *             @OA\Property(property="salary", type="integer", example=15000000)
	 *         )
	 *     ),
	 *     @OA\Response(
	 *         response=200,
	 *         description="Job updated successfully",
	 *         @OA\JsonContent(
	 *             @OA\Property(property="message", type="string", example="Updated"),
	 *             @OA\Property(property="job", type="object")
	 *         )
	 *     ),
	 *     @OA\Response(response=403, description="Forbidden - Admin only"),
	 *     @OA\Response(response=404, description="Job not found")
	 * )
	 */
	public function update(Request $req, Job $job)
	{
		if (!$req->user() || $req->user()->role !== 'admin') {
			return response()->json(['message' => 'Forbidden'], 403);
		}
		$data = $req->validate([
			'title' => 'sometimes|required|string',
			'description' => 'sometimes|required|string',
			'location' => 'sometimes|required|string',
			'company' => 'sometimes|required|string',
			'salary' => 'nullable|integer',
			'logo' => 'nullable|string',
		]);
		$job->update($data);
		return response()->json(['message' => 'Updated', 'job' => $job]);}

	/**
	 * @OA\Delete(
	 *     path="/api/jobs/{id}",
	 *     tags={"Jobs (Admin)"},
	 *     summary="Delete job (Admin only)",
	 *     description="Delete a job vacancy",
	 *     security={{"bearerAuth":{}}},
	 *     @OA\Parameter(
	 *         name="id",
	 *         in="path",
	 *         description="Job ID",
	 *         required=true,
	 *         @OA\Schema(type="integer", example=1)
	 *     ),
	 *     @OA\Response(
	 *         response=200,
	 *         description="Job deleted successfully",
	 *         @OA\JsonContent(
	 *             @OA\Property(property="message", type="string", example="Deleted")
	 *         )
	 *     ),
	 *     @OA\Response(response=403, description="Forbidden - Admin only"),
	 *     @OA\Response(response=404, description="Job not found")
	 * )
	 */
	public function destroy(Request $req, Job $job)
	{
		if (!$req->user() || $req->user()->role !== 'admin') {
			return response()->json(['message' => 'Forbidden'], 403);
		}
		$job->delete();
		return response()->json(['message' => 'Deleted']);
	}
}